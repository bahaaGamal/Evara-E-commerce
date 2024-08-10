<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class WishlistController extends Controller
{
    public function getWishlistedProducts()
    {
        $items = Cart::instance("wishlist")->content();
        return view('site.wishlist',['items'=>$items]);
    }

    public function addToWishlist(Request $request){
        $product = Product::findOrFail($request->id);
        Cart::instance('wishlist')->add($product->id, $product->title, $request->quantity, $product->price) ->associate('App\Models\Product');
        return redirect()->route('wishlist.index');
    }

    public function removeProductFromWishlist(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance("wishlist")->remove($rowId);
        return redirect()->route('wishlist.index');
    }

    public function moveToCart(Request $request)
{
    $item = Cart::instance('wishlist')->get($request->rowId);
    Cart::instance('wishlist')->remove($request->rowId);
    Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');
    return redirect()->route('wishlist.index');
}
}
