<?php

namespace App\Http\Controllers;


use App\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(){
        Mail::to(Auth::user()->email)->send(new Mailer());
        return 'bahaa';

    }
}
