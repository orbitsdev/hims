<?php
namespace App\Services;

use Illuminate\Support\Facades\Session;

class RouteManager
{
    public function isCurrentPage($route, $routes)
    {
        return in_array($route,$routes) ? 'active-link' : 'inactive-link';
    }
    public function route($route) : String 
    {
        Session::put('route', $route);
        return $route;
    }
}