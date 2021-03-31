<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function smile() {
        return ["dane" => [1,2,3]];
    }
}
