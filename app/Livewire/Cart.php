<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $refreshKey = 0;

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

    public function render()
    {
        return view('livewire.cart');
    }
}
