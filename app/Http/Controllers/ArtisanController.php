<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function config(){
        Artisan::call('config:clear');
        //Artisan::call('config:cache');
        // Artisan::call('migrate');
        return redirect('/');
    }
}
