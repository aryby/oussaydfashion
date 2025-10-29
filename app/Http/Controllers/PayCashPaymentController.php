<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PayMob\Facades\PayMob;

class PayCashPaymentController extends Controller
{
    public static function handlePayment(Order $order)
    {
        $order->update([
            'payment_status' => PaymentStatus::PENDING->value,
            'payment_method' => 'Cash on Delivery',
            'transaction_id' => 'COD-' . $order->id
        ]);

        return redirect()->route('checkout.success', $order->number);
    }


}
