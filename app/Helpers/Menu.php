<?php
class Menu
{
    static function isActive($route, $compare = null)
    {
        return strpos(($compare ? $compare : Route::currentRouteName()), $route) !== false;
    }

    static function ResourceIsActive($route)
    {
        return url()->current() == $route;
    }
}
