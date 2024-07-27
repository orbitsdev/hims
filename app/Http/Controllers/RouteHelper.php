<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RouteHelper extends Controller
{
    
    public static function isCurrentRoute($route, $routes) {
        return  in_array(1, [1,2,3]);
    }

   
}
