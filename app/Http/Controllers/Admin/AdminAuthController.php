<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
    public function index(){
        return view('admin.admins.login');
    }

    public function dashboard(){
        return view('admin.admins.dashboard');
    }

    public function login(Request $request){

        $check =  $request->all();

        if(Auth:: guard('admin')->attempt (['email' => $check['email'], 'password' => $check['password'] ])){
            return redirect()->route('admin.dashboard')->with('error', 'Admin Login Successfully');
        }else{
        return back()->with('error', 'Invaild Email or Password');
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error', 'Admin Logout Successfully');

    }
}
