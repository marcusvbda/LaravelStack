<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use ResourcesHelpers;
use Symfony\Component\HttpFoundation\Request;

class ResourceController extends Controller
{
    public function index($resource, Request $request)
    {
        $resource = ResourcesHelpers::find($resource);
        $data = $this->getPaginatedData($resource, $request);
        return view("admin.resources.index", compact("resource", "data"));
    }

    private function getPaginatedData($resource, Request $request)
    {
        $query = $request->all();
        $orderBy = @$query["order_by"] ? $query["order_by"] : "id";
        $orderType = @$query["order_type"] ? $query["order_type"] : "desc";
        $perPage = @$query["per_page"] ? $query["per_page"] : 10;
        $data = $resource->model->orderBy($orderBy, $orderType);
        foreach ($resource->filters as $key => $value) {
            $filter_value = @$query[$key] ? @$query[$key] : "";
            $data = $data->where($key, "like", "%" . $filter_value . "%");
        }
        $data = $data->paginate($perPage);
        return $data;
    }

    public function edit($resource, $code)
    {
        dd($resource, $code);
    }
}
