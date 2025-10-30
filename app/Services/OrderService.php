<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function store(array $request)
    {
        $order = DB::transaction(function () use ($request) {
            $order = Order::create([
                'number'            =>  'ORD-' . strtoupper(uniqid()),
                'user_id'           =>  Auth::id(),
                'grand_total'       =>  config('settings.shipping_cost.value') > 0 ? \Cart::session(Auth::id())->getSubTotal() + intval(config('settings.shipping_cost.value')) : \Cart::session(Auth::id())->getSubTotal(),
                'status'            =>  OrderStatus::PENDING->value,
                'payment_status'    =>  PaymentStatus::PENDING->value,
                'first_name'        =>  $request['first_name'],
                'last_name'         =>  ($request['last_name'] ?? 'Maroc '),
                'apartment'         =>  ($request['apartment'] ?? 'Maroc '),
                'floor'             =>  ($request['floor'] ?? 'Maroc '),
                'street'            =>  $request['street'],
                'building'          =>  ($request['building'] ?? 'Maroc '),
                'city'              =>  ($request['city'] ?? 'Maroc '),
                'country'           =>  ($request['country'] ?? 'Maroc '),
                'state'             =>  ($request['state'] ?? 'Maroc '),
                'postal_code'       =>  ($request['postal_code'] ?? 'Maroc '),
                'phone_number'      =>  ($request['phone_number'] ?? 'Maroc '),
                'notes'             =>  ($request['notes'] ?? 'Maroc ')
            ]);

            foreach (\Cart::session(auth()->id())->getContent()->toArray() as $item) {
                $orderItem = new OrderItem([
                    'product_id'    =>  $item['associatedModel']['id'],
                    'name'          =>  $item['associatedModel']['name'],
                    'description'   =>  $item['associatedModel']['description'],
                    'attributes'    =>  $item['attributes'],
                    'price'         =>  $item['price'],
                    'qty'           =>  $item['quantity']
                ]);

                $order->items()->save($orderItem);
            }

            return $order;
        });

        return $order;
    }
}
