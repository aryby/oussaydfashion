<?php

namespace App\Livewire;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Cart extends Component
{
    public $refreshKey = 0;

    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $street;
    public $notes;

    public function removeItem($id)
    {
        if (\Cart::session(auth()->user()->id)->isEmpty()) {
            return;
        }

        \Cart::session(auth()->user()->id)->remove($id);
        $this->refreshKey++;
    }

    public function clear()
    {
        if (\Cart::session(auth()->user()->id)->isEmpty()) {
            return;
        }

        \Cart::session(auth()->user()->id)->clear();
        $this->refreshKey++;
    }

    public function updateQuantity($id, $quantity)
    {
        // Ensure quantity is at least 1
        $quantity = max(1, (int) $quantity);
        
        \Cart::session(auth()->user()->id)->update($id, [
            'quantity' => [
                'value' => $quantity,
            ],
        ]);
        $this->refreshKey++;
    }

    public function incrementQuantity($id)
    {
        $cart = \Cart::session(auth()->user()->id);
        $item = $cart->get($id);
        
        if ($item) {
            $cart->update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $item->quantity + 1,
                ],
            ]);
            $this->refreshKey++;
        }
    }

    public function decrementQuantity($id)
    {
        $cart = \Cart::session(auth()->user()->id);
        $item = $cart->get($id);
        
        if ($item && $item->quantity > 1) {
            $cart->update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $item->quantity - 1,
                ],
            ]);
            $this->refreshKey++;
        }
    }

    public function placeOrder(OrderService $orderService, UserService $userService)
    {
        $user = Auth::user();

        // Prepare order data
        $orderData = [
            'first_name' => $this->first_name ?? $user->first_name,
            'last_name' => $this->last_name ?? $user->last_name,
            'email' => $this->email ?? $user->email,
            'phone_number' => $this->phone_number ?? ($user->info->phone_number ?? 'NO_PHONE'),
            'street' => $this->street ?? ($user->info->address ?? 'NO_STREET'),
            'notes' => $this->notes,
            'payment_method' => 'cash',
        ];

        // Validate required fields for guests
        if (Str::startsWith($user->email, 'guest_')) {
            $this->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:20',
                'street' => 'required|string|max:255',
            ]);
        }
        // For non-guests, we allow checkout even without profile info - they'll use default values

        // Update user info if guest
        $userService->updateGuestUserWithOrderInfo($orderData);

        // Create order
        $order = $orderService->store($orderData);

        if (!$order) {
            session()->flash('error', 'An error occurred during checkout.');
            return;
        }

        // Handle cash payment
        $order->update([
            'payment_status' => PaymentStatus::PENDING->value,
            'payment_method' => 'Cash on Delivery',
            'transaction_id' => 'COD-' . $order->id
        ]);

        // Clear cart
        \Cart::session($user->id)->clear();

        // Redirect to orders page with success message
        return redirect()->route('account.orders')->with('success', 'Order placed successfully!');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
