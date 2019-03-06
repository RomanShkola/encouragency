<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promo;

class PromoController extends Controller
{
    public function apply(Request $request)
    {
        $code = $request->input('code');
        $product = $request->input('product');
        return Promo::where('code', '=', $code)->where('product', '=', $product)->get();
    }
}
