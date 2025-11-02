<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;




use App\Models\Product;
use Illuminate\Http\Request;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;

class BuyNowController extends Controller
{
    public function orderNowForm(Product $product)
    {
        return view('site.pages.order_now', compact('product'));
    }

    public function orderNowSubmit(Product $product, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
        ]);

        // Split name into first and last name (simple)
        $names = explode(' ', $validated['name'], 2);
        $firstName = $names[0];
        $lastName = $names[1] ?? '';

        // Générer un numéro de commande unique
        $orderNumber = 'ORD-' . strtoupper(uniqid());

        // Déterminer l'utilisateur (connecté ou guest)
        if (Auth::check()) {
            $user = Auth::user();
            // Si l'utilisateur a saisi un email différent, on le met à jour
            if (!empty($validated['email']) && $validated['email'] !== $user->email) {
                $user->email = $validated['email'];
                $user->save();
            }
        } else {
            // On cherche un guest par téléphone, sinon on le crée
            $guestEmail = !empty($validated['email']) ? $validated['email'] : ('guest_' . preg_replace('/\D/', '', $validated['phone']) . '@guest.local');
            $user = User::where('email', $guestEmail)->first();
            if (!$user) {
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $guestEmail,
                    'password' => bcrypt(uniqid()),
                ]);
            } else {
                // Mettre à jour les infos guest si besoin
                $user->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                ]);
            }
        }

        $order = \App\Models\Order::create([
            'number' => $orderNumber,
            'user_id' => $user->id,
            'status' => \App\Enums\OrderStatus::PENDING,
            'payment_status' => \App\Enums\PaymentStatus::PENDING,
            'grand_total' => $product->sale_price > 0 ? $product->sale_price : $product->unit_price,
            'payment_method' => 'cash',
            'currency' => config('settings.currency_symbol.value', 'MAD'),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone_number' => $validated['phone'],
            'street' => $validated['address'],
            'apartment' => '',
            'floor' => '',
            'building' => '',
            'city' => '',
            'country' => '',
            'state' => '',
            'postal_code' => '',
            'notes' => '',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'qty' => 1,
            'price' => $product->sale_price > 0 ? $product->sale_price : $product->unit_price,
        ]);

        // Notifier l'admin par email
        $adminEmail = config('mail.admin_email', env('MAIL_FROM_ADDRESS', 'admin@example.com'));
        if ($adminEmail) {
            Notification::route('mail', $adminEmail)->notify(new NewOrderNotification($order));
        }
        return redirect()->route('products.show', $product->slug)->with('success', __('Order placed successfully!'));
    }
}