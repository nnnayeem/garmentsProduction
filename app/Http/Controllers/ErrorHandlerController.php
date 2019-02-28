<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorHandlerController extends Controller
{
    public function errorCode401()
    {

        return view('errors.401');

    }
}
