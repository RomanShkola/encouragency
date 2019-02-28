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
            'countries' => $countries->all()->pluck('name.common', 'cca2')->toArray(),
            'calling_codes' => $countries->all()->pluck('dialling.calling_code.0', 'cca2')->toArray(),
            'product' => $selectedProduct
        ];
        return view('pages.order')->with('data', $data);
    }

    public function send(Request $request)
    {

        $order = new Order;
        $order->user_email = $request->input('user_email');
        $order->user_name = $request->input('user_name');
        $order->user_surname = $request->input('user_surname');
        $order->user_soc_link = $request->input('soc_network') . $request->input('user_soc_link');
        $order->user_phone_num = $request->input('user_phone_num_code') . $request->input('user_phone_num');
        $order->user_address = $request->input('user_address');
        $order->user_address2 = $request->input('user_address2');
        $order->user_state = $request->input('user_state');
        $order->user_zip = $request->input('user_zip');
        $order->user_country = $request->input('user_country');
        $order->price_final = $request->input('price_final');

        $order->save();

        return redirect('/order');
    }
}
