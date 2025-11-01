<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class CheckoutResponseController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        \Cart::session(auth()->id())->clear();
        return to_route('account.orders');
    }
}
