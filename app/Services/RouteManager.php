<?php
namespace App\Services;

class RouteManager
{
    public function isCurrentPage($route, $routes)
    {
        return in_array($route,$routes) ? 'active-link' : 'inactive-link';
    }
}