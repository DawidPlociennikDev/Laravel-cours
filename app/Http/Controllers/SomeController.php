<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SomeController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            $request->data??="Czarna krowa w kropki bordo gryzła trawę kręcąc mordą.";
            return $next($request);
        });
    }

    public function optiona() {
        return "Option A";
    }
    public function optionb(Request $request) {
        return view('optionb', [
            'title' => 'Option [B]oss',
            'r' => $request
        ]);
    }
    public function optionc(Request $request) {
        return view('optionc', [
            'title' => 'Option [C]',
            'data' => $request->data
        ]);
    }
}
