<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function store(){
        $cart = Cart::instance('cart')->content();
        $user = auth()->user();

        $totalPrice =str_replace(',', '', Cart::instance('cart')->total());


        $order = new Order();

        $order->user_id = $user->id;
        $order->total_price = $totalPrice;
        $order->save();

        foreach ($cart as $item) {
            $order->products()->attach($item->id, [
                'quantity' => $item->qty,
                'price' => $item->price
            ]);
        }

        $orderId = $order->id;

        return redirect("myfatoorah/?oid=$orderId");
    }
}
