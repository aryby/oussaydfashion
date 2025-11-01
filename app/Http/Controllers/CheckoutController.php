<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailsRequest;
use App\Services\OrderService;
use App\Services\UserService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        private OrderService $orderService,
        private UserService $userService
    ) {
    }

    public function get(Request $request)
    {
        $paymentType = $request->query('payment_type');

        return match ($paymentType) {
            'paypal' => view('site.pages.paypal_checkout'),
            'card' => view('site.pages.paymob_checkout'),
            'cash' => view('site.pages.paycash_checkout'),
            default => back()->with('payment_type_warning', 'Payment type specified is not available at the moment.'),
        };
    }

    public function placePaymobOrder(StoreOrderDetailsRequest $request)
    {
        $validated = $request->validated();
        $this->userService->updateGuestUserWithOrderInfo($validated);

        $order = $this->orderService->store($validated);

        if (!$order) {
            return back()->with('message', 'An error occurred during checkout.');
        }

        $paymentToken = PayMobPaymentController::handlePayment($order);
        return view('site.pages.paymob_iframe', ['token' => $paymentToken]);
    }

    public function placePayCashOrder(StoreOrderDetailsRequest $request)
    {
        $validated = $request->validated();
        $this->userService->updateGuestUserWithOrderInfo($validated);

        $order = $this->orderService->store($validated);

        if (!$order) {
            return back()->with('message', 'An error occurred during checkout.');
        }

        return PayCashPaymentController::handlePayment($order);
    }

    public function placePayPalOrder(StoreOrderDetailsRequest $request)
    {
        $validated = $request->validated();
        $this->userService->updateGuestUserWithOrderInfo($validated);

        $order = $this->orderService->store($validated);

        if (!$order) {
            return back()->with('message', 'An error occurred during checkout.');
        }

        return PayPalPaymentController::handlePayment($order);
    }
}
