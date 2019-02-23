<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use PragmaRX\Countries\Package\Countries;

class OrderController extends Controller
{
    public function index($name)
    {
        $countries = new Countries();
        $selectedProduct = Product::find(ucwords($name));

        $data = [
            'countries' => $countries->all()->pluck('name.common', 'cca2'),
            'calling_codes' => $countries->all()->pluck('dialling.calling_code.0', 'cca2'),
            'product' => $selectedProduct
        ];
        return view('pages.order')->with('data', $data);
    }

    public function send(Request $request)
    {

        $order = new Order;
        $order->user_email = $request->input('email');
        $order->user_name = $request->input('name');

        return $order;
    }
}
