<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingRate;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index(){
        $cartItems = Cart::instance('cart')->content();
        $shippings = ShippingRate::all();

        return view('site.cart', compact('cartItems','shippings'));
    }

    public function addToCart(Request $request){
        $product = Product::findOrFail($request->id);
        Cart::instance('cart')->add($product->id, $product->title, $request->quantity, $product->price) ->associate('App\Models\Product');
        // return redirect()->back()->with('message', 'Success! Item has been added successfully!');
        return redirect()->route('cart.index');
    }

    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('cart.index');
    }

    public function removeItem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index');
    }

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index');
    }
}
