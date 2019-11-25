<?php
class Menu
{
    static function isActive($route, $compare = null)
    {
        return strpos(($compare ? $compare : Route::currentRouteName()), $route) !== false;
    }

    static function ResourceIsActive($route)
    {
        $aux =  explode("/", url()->current());
        $aux = "resource." . $aux[count($aux) - 1];
        return self::isActive($route, $aux);
    }
}
