<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public function removeItem($id)
    {
        if (\Cart::session(auth()->user()->id)->isEmpty()) {
            return;
        }

        \Cart::session(auth()->user()->id)->remove($id);
    }

    public function clear()
    {
        if (\Cart::session(auth()->user()->id)->isEmpty()) {
            return;
        }

        \Cart::session(auth()->user()->id)->clear();
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
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
