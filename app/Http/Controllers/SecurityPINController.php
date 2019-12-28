<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SecurityPINController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:12,1')->only('setPIN');
    }

    public function show(Request $request): View
    {
        $redirect = $request->cookie('token_admin_pin_redirect', '/');
        return view('pages.pin')->with(['redirect' => $redirect]);
    }

    public function setPIN(Request $request)
    {
        $redirect = $request->cookie('token_admin_pin_redirect', '/');
        $pin = (int)$request->input('pin');
        Cookie::queue('token_admin_pin', $pin, 525948);
        return redirect($redirect);
    }
}
