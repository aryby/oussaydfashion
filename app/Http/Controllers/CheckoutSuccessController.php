<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class CheckoutSuccessController extends Controller
{
    public function __invoke(Order $order): RedirectResponse
    {
        \Cart::session(auth()->id())->clear();
        
        $user = $order->customer;
        if ($user) {
            \Illuminate\Support\Facades\Auth::login($user);
        }
        
        return to_route('account.orders')
            ->with('success', 'Order #' . $order->number . ' has been placed successfully!');
    }
}
