<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use Cart;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\ShippingRate;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function store(){
        $cart = Cart::instance('cart')->content();
        $user = auth()->user();

        $totalPrice = session()->get('cart_total');
        // dd(session()->get('address.postal_code'));

        $order = new Order();

        $order->user_id = $user->id;
        $order->total_price = $totalPrice;
        $order->address = session()->get('address.address');
        $order->country = session()->get('address.country');
        $order->city = session()->get('address.city');
        $order->phone = session()->get('address.phone');
        $order->postal_code = session()->get('address.postal_code');
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


    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return redirect()->back()->withErrors(['coupon_code' => 'This coupon is either expired, used up, or invalid.']);
        }

        if ($coupon->users()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already used this coupon.');
        }

        $oldTotal = session()->get('cart_total');


        $discount = $coupon->calculateDiscount($oldTotal);
        $newTotal = $oldTotal - $discount;


        session()->put('total_befor_discount',round($oldTotal,2));
        session()->put('cart_total',round($newTotal,2));

        $coupon->users()->attach(auth()->id());
        $coupon->decrement('usage_limit');

        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }

    public function calculateShipping(ShippingRequest $request)
    {
        $validated = $request->validated();

        $country = $validated['country'];
        $city = $validated['city'];
        $address = $validated['address'];
        $postcode = $validated['postal_code'];

        $shippingRate = ShippingRate::where('country', $country)
                                    ->where('city', $city)
                                    ->where('postcode', $postcode)
                                    ->first();


        if ($shippingRate) {
            $total = Cart::instance('cart')->total();
            $shippingCost = $total * ($shippingRate->rate / 100);
            $cartTotal = $total + $shippingCost;

            session()->put('address',$request->validated());
            session()->put('shipping_cost',round($shippingCost,2));
            session()->put('cart_total',round($cartTotal,2));


            return back()->with('success', 'Shipping rate is ' . $shippingRate->rate . '%');
        } else {
            return back()->with('error', 'No shipping rate available for the selected location.');
        }
    }

}
