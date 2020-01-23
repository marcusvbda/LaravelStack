<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use marcusvbda\vstack\Services\Messages;
use ResourcesHelpers;
use Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        if(@$request["id"]) 
            $this->editUser($request);
        else
            $this->createUser($request);
        Messages::send("success", "Registro salvo com sucesso !!");
        return ["success" => true, "route" => route('resource.index', ["resource" => "users"])];
    }

    private function createUser($request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => ['required','email',Rule::unique('users')->whereNull('deleted_at')],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'roleName' => 'required'
        ]);
        $data = $request->except(["_token", "password_confirmation","roleName","resource_id"]);
        $data["avatar"] = is_array(@$data["avatar"]) ? @$data["avatar"][0] : "";
        $data["email_verified_at"] = date("Y-m-d H:i:s");
        $user = User::create($data);
        $user->assignRole($request["roleName"]);
    }

    private function editUser($request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => ['required','email',Rule::unique('users')->ignore($request['id'])->whereNull('deleted_at')],
            'password' => 'confirmed',
            'roleName' => 'required'
        ]);
        $data = $request->except(["id","_token", "password_confirmation","roleName","resource_id"]);
        if(!$data["password"]) unset($data["password"]);
        $user = User::findOrFail($request["id"]);
        $data["avatar"] = is_array($data["avatar"]) ? (@$data["avatar"] ? $data["avatar"][0] : "") : "";
        $user->fill($data);
        $user->save();
        $user->roles()->detach();
        $user->assignRole($request["roleName"]);
    }

    public function import($resource)
    {
        $resource = ResourcesHelpers::find("users");
        if (!($resource->canImport() && $resource->canCreate())) abort(403);
        $data = $this->makeImportData($resource);
        return view("vStack::resources.import", compact('data'));
    }

    private function makeImportData($resource)
    {
        $columns = [];
        foreach($resource->getTableColumns() as $col)
        {
            if(!in_array($col,["id","created_at","deleted_at","updated_at","email_verified_at","confirmation_token","recovery_token","remember_token","provider"])) $columns[] = $col;
        }
        $columns[] = "role_name";
        return [
            "resource" => [
                "label"          => $resource->label(),
                "singular_label" => $resource->singularLabel(),
                "route"          => $resource->route(),
                "columns"        => $columns
            ]
        ];
    }

    public function importSubmit($resource,Request $request)
    {
        $resource = ResourcesHelpers::find("users");
        if (!($resource->canImport() && $resource->canCreate())) abort(403);
        $data = $request->all();
        $file = $data["file"];
        if(!$file) return ["success" => false, "message" => ["type" => "error", "text" => "Arquivo inválido..."]];
        if($file->getSize()>137072) return ["success" => false, "message" => ["type" => "error", "text" => "Arquivo maior do que o permitido..."]];
        $csvFile = file($file->getPathName());
        if(!@$csvFile[0]) return ["success" => false, "message" => ["type" => "error", "text" => "Arquivo inválido..."]];
        $data["config"] = json_decode($data["config"]);
        $this->importCSV($resource,$csvFile,$data["config"]);
        return ["success"=>true];
    } 

    private function importCSV($resource,$rows,$config)
    {
        $user = Auth::user();
        dispatch(function () use ($user,$rows,$config,$resource) {
            $headers = $config->data->csv_header;
            $data = [];
            for($i=1;$i<count($rows);$i++)
            {
                $_data = [];
                $columns = str_getcsv($rows[$i],$config->delimiter);
                for($y=0;$y<count($headers);$y++) $_data[$headers[$y]] = $columns[$y];
                if( $_data) $data[] = $_data;
            }
            $fieldlist = $config->fieldlist;
            if($config->update)
            {
                try {
                    foreach($data as $row)
                    {
                        $item = $resource->model->find($row["id"]);
                        if($item) 
                        {
                            foreach($fieldlist as $key=>$value) if(!in_array($value,["_IGNORE_","role_name"])) $item->{$value} = $row[$key];
                            if(!$new->avatar) $new->avatar = null;
                            $item->save();
                            $item->roles()->detach();
                            $item->assignRole($item->role_name);
                        }
                    }
                    Messages::notify("success", "CSV de ".$resource->label()." importado com sucesso !!", $user->id);
                } catch(\Exception $e) {
                    Messages::notify("error", "<p>Erro ao importar CSV de ".$resource->label()."</p><p>".$e->getMessage()."</p>", $user->id);
                } 
            }
            else 
            {
                foreach($data as $row)
                {
                    $new = [];
                    $new = new User();
                    foreach($fieldlist as $key=>$value) if(!in_array($value,["_IGNORE_","role_name"])) $new->{$value} = $row[$key];
                    $new->email_verified_at = date("Y-m-d H:i:s");
                    if(!$new->avatar) $new->avatar = null;
                    $new->save();
                    $new->assignRole($row["role_name"]);
                }
                Messages::notify("success", "CSV de ".$resource->label()." importado com sucesso !!", $user->id);
            } 
        })->onQueue("resource-import");
    }

}
