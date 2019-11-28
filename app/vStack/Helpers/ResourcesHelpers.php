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
                $data[] = [$name => self::make($filename, $name)];
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
        $_resource = null;
        foreach ($resources as $resource) {
            foreach (array_keys($resource) as $key) {
                if ($resource[$key]->id == $name) {
                    $_resource =  $resource[$key];
                    break;
                }
            }
        }
        if (!$_resource) abort(404);
        return $_resource;
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

        $keys = array_keys($query);
        $qty = 0;
        foreach ($keys as $key) {
            if (
                self::findFilter($key, $filters) &&
                @$query[$key] &&
                @$query[$key] != "false" &&
                @$query[$key] != "null"
            ) $qty++;
        }
        return $qty;
    }

    static function findFilter($key, $filters)
    {
        foreach ($filters as $f) {
            if ($f->index == $key) return $f;
        };
        return false;
    }
}
