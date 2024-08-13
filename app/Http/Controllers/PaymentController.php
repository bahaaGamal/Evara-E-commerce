<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Cart;

class PaymentController extends Controller
{
     public function success ($order) {
        Cart::instance('cart')->destroy();
        return view('myfatoorah.payment_status.success', ['order' => Order::find($order)]);
    }

     public function failed ($order) {
        return view('myfatoorah.payment_status.failed', ['order' => Order::find($order)]);
    }
}
