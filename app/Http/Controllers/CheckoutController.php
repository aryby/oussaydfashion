<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailsRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function get(Request $request)
    {
        if ($request->query('payment_type') == 'paypal') {
            return view('site.pages.paypal_checkout');
        } else if ($request->query('payment_type') == 'card') {
            return view('site.pages.paymob_checkout');
        } else if ($request->query('payment_type') == 'cash') {
            return view('site.pages.paycash_checkout');
        } else {
            return back()->with('payment_type_warning', 'payment type specified is not available at the moment.');
        }
    }

    public function placePaymobOrder(StoreOrderDetailsRequest $request)
    {
        $user = Auth::user();
        if ($user && Str::startsWith($user->email, 'guest_')) {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email') ?? $user->email; // Assuming email might be provided in billing form
            $user->password = bcrypt(Str::random(10));
            $user->save();
            Auth::login($user); // Re-login the user to refresh session data
        }

        $order = $this->orderService->store($request->validated());

        if ($order) {
            $paymentToken = PayMobPaymentController::handlePayment($order);
            return view('site.pages.paymob_iframe', ['token' => $paymentToken]);
        }

        return back()->with('message', 'An error occured during checkout.');
    }

    public function placePayCashOrder(StoreOrderDetailsRequest $request)
    {
        $user = Auth::user();
        if ($user && Str::startsWith($user->email, 'guest_')) {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email') ?? $user->email;
            $user->password = bcrypt(Str::random(10));
            $user->save();
            Auth::login($user); // Re-login the user to refresh session data
        }

        $order = $this->orderService->store($request->validated());

        if ($order) {
            return PayCashPaymentController::handlePayment($order);
        }

        return back()->with('message', 'An error occured during checkout.');
    }

    public function placePayPalOrder(StoreOrderDetailsRequest $request)
    {
        $user = Auth::user();
        if ($user && Str::startsWith($user->email, 'guest_')) {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email') ?? $user->email;
            $user->password = bcrypt(Str::random(10));
            $user->save();
            Auth::login($user); // Re-login the user to refresh session data
        }

        $order = $this->orderService->store($request->validated());

        if ($order) {
            return PayPalPaymentController::handlePayment($order);
        }

        return back()->with('message', 'An error occured during checkout.');
    }
}
