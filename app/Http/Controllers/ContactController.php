<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request) {
        echo $request->input('email');

        return $request->input('email');
    }
}
