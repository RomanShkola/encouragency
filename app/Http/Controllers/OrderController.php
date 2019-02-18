<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($name)
    {
        return view('pages.order');
    }
}
