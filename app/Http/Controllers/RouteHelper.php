<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteHelper extends Controller
{
    
    public static function isCurrentRoute($route, $routes) {
        return  in_array(1, [1,2,3]);
    }
}
