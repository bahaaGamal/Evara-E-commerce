<?php

namespace App\Http\Controllers\Seller;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerAuthController extends Controller
{
    public function index(){
        return view('sellers.login');
    }

    public function dashboard(){
        return view('sellers.dashboard');
    }

    public function login(Request $request){

        $check =  $request->all();

        if(Auth:: guard('seller')->attempt (['email' => $check['email'], 'password' => $check['password'] ])){
            return redirect()->route('seller.dashboard')->with('error', 'Seller Login Successfully');
        }else{
        return back()->with('error', 'Invaild Email or Password');
        }
    }

    public function logout(){
        Auth::guard('seller')->logout();
        return redirect()->route('seller_login_form')->with('error', 'Seller Logout Successfully');

    }
}
