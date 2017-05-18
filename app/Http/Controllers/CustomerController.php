<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class CustomerController extends Controller
{
    public function buy()
    {
        return View::make('buy');
    }

    public function checkout()
    {

    }
}
