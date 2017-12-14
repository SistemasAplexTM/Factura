<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\duvierEvent;

class welcomeController extends Controller
{
    public function generarEvento(){
    	event(new duvierEvent('jhonny'));
    }
}
