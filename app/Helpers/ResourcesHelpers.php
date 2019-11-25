<?php

class ResourcesHelpers
{
    static function all()
    {
        $path = app_path('Http\Resources\\');
        $data = [];
        foreach (glob($path . "*.php") as $filename) {
            if (basename($filename) != "Resource.php") {
                $name = str_replace(".php", "", basename($filename));
                $data = [$name => self::make($filename, $name)];
            }
        }
        return $data;
    }

    static function make($filename)
    {
        $name = str_replace(".php", "", basename($filename));
        $class = "App\Http\Resources\\" . $name;
        return App::make($class);
    }

    static function find($name)
    {
        $resources = self::all();
        $resource = array_filter(
            $resources,
            function ($r) use ($name) {
                return $r->id == "resource." . $name;
            }
        );
        if (!$resource) abort(404);
        foreach ($resource as $value) return $value;
    }

    static function sortLink($route, $query, $field, $type)
    {
        $str_query = "";
        $query["order_by"] = $field;
        $query["order_type"] = $type;
        foreach ($query as $key => $value) $str_query .= $key . "=" . $value . "&";
        $str_query = substr($str_query, 0, -1);
        return $route . "?" . $str_query;
    }

    static function hasFilter($query, $filters = [])
    {
        $filters = array_keys($filters);
        $keys = array_keys($query);
        $qty = 0;
        foreach ($keys as $key) {
            if (in_array($key, $filters)) $qty++;
        }
        return $qty;
    }
}
