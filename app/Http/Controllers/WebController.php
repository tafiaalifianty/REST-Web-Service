<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function me()
    {
        return view('web.me');
    }

    public function member()
    {
        return view('web.member');
    }

    public function order()
    {
        return view('web.order');
    }

    public function orderget()
    {
        return view('web.orderget');
    }

    public function payment()
    {
        return view('web.payment');
    }

    public function tiketid()
    {
        return view('web.tiketid');
    }

    public function tiketuser()
    {
        return view('web.tiketuser');
    }

    public function log()
    {
        return view('web.log');
    }
}
