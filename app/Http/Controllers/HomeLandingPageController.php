<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeLandingPageController extends Controller
{
    private $service;

    public function __construct()
    {

    }

    public function index(Request $request): View
    {
        $data = [
            'age' => 23
        ];

        return view('pages.home', $data);
    }
}
