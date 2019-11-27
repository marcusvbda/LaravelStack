<?php

namespace App\vStack\Controllers;

use App\Http\Controllers\Controller;
use ResourcesHelpers;
use Illuminate\Http\Request;
use App\vStack\Services\Messages;

class ResourceController extends Controller
{
    public function index($resource, Request $request)
    {
        $resource = ResourcesHelpers::find($resource);
        if (!$resource->canViewList()) abort(403);
        $data = $this->getPaginatedData($resource, $request);
        return view("admin.vStack.resources.index", compact("resource", "data"));
    }

    private function getPaginatedData($resource, Request $request)
    {
        $data      = $request->all();
        $orderBy   = @$data["order_by"] ? $data["order_by"] : "id";
        $orderType = @$data["order_type"] ? $data["order_type"] : "desc";
        $perPage   = @$data["per_page"] ? $data["per_page"] : 10;
        $query     = $resource->model->orderBy($orderBy, $orderType);
        foreach ($resource->filters() as $filter) $query = $filter->applyFilter($query, $data);
        foreach ($resource->search() as $search) {
            $query = $query->where($search, "like", "%" . (@$data["_"] ? $data["_"] : "") . "%");
        }
        $query = $query->paginate($perPage);
        return $query;
    }

    public function create($resource)
    {
        $resource = ResourcesHelpers::find($resource);
        if (!$resource->canCreate()) abort(403);
        // dd($resource->fields());
        $data = $this->makeCrudData($resource);
        return view("admin.vStack.resources.crud", compact("resource", "data"));
    }

    public function edit($resource, $code)
    {
        $resource = ResourcesHelpers::find($resource);
        if (!$resource->canUpdate()) abort(403);
        $content = $resource->model->findOrFail($code);
        $data = $this->makeCrudData($resource, $content);
        return view("admin.vStack.resources.crud", compact("resource", "data"));
    }

    private function makeCrudData($resource, $content = null)
    {
        // dd($resource->fields());
        return [
            "id"          => @$content->id,
            "page_type"   => @$content->id ? 'Edição' : 'Cadastro',
            "fields"      => $this->makeCrudDataFields($content, $resource->fields()),
            "store_route" => route('resource.store'),
            "list_route"  => route('resource.index', ["resource" => $resource->id]),
            "resource_id" => $resource->id
        ];
    }

    private function makeCrudDataFields($content, $fields)
    {
        if (!$content) return $fields;
        foreach ($fields  as $field) {
            $field->options["value"] = @$content->{$field->options["field"]};
        }
        return $fields;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (!@$data["resource_id"]) abort(404);
        $resource = ResourcesHelpers::find($data["resource_id"]);
        if (@$data["id"]) if (!$resource->canUpdate()) abort(403);
        if (!@$data["id"]) if (!$resource->canCreate()) abort(403);
        $this->validate($request, $resource->getValidationRule());
        $target = @$data["id"] ? $resource->model->findOrFail($data["id"]) : new $resource->model();

        $data = $request->except(["resource_id", "id"]);
        $target->fill($data);
        $target->save();
        Messages::send("success", $resource->singularLabel() . " Salvo com sucesso !!");
        return ["success" => true, "route" => route('resource.index', ["resource" => $resource->id])];
    }
}
