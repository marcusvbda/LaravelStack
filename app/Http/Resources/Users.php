<?php
namespace App\Http\Resources;
use marcusvbda\vstack\Resource;
use Auth;
use marcusvbda\vstack\Fields\{
    Card, 
    Text, 
    BelongsTo,
    Upload
};

class Users extends Resource
{
    public $model = \App\User::class;

    public function menu()
    {
        return "Cadastros";
    }

    public function menuIcon()
    {
        return "el-icon-menu";
    }

    public function label()
    {
        return "Usuários";
    }
    
    public function singularLabel()
    {
        return "Usuário";
    }

    public function icon()
    {
        return "el-icon-user-solid";
    }

    public function table()
    {
        return [
            "name" => ["label" => "Nome"],
            "roleName" => ["label"=> "Nível de Acesso","sortable"=>false],
        ];
    }

    public function fields()
    {
        return [
            new Card("Informações",[
                new Upload([
                    "label" => "Avatar", 
                    "field" => "avatar",
                    "preview"  => true, 
                    "multiple" => false,
                    "accept"   => "image/*"
                ]),
                new Text([
                    "label" => "Nome", 
                    "field" => "name", 
                    "required" => true,
                    "placeholder" => "Digite o nome aqui ...", 
                    "rules" => "required|max:255"
                ]),
                new Text([
                    "label" => "Email", 
                    "field" => "email", 
                    "type"  => "email",
                    "required" => true,
                    "placeholder" => "Digite o email aqui ...", 
                    "rules" => ['required','email',\Illuminate\Validation\Rule::unique('users')->whereNull('deleted_at')]
                ]),
                new Text([
                    "label" => "Senha", 
                    "field" => "password", 
                    "type"  => "password",
                    "required" => true,
                    "placeholder" => "Digite a senha aqui ...", 
                    "rules" => "required|confirmed"
                ]),
                new Text([
                    "label" => "Confirme a Senha", 
                    "field" => "password_confirmation", 
                    "type"  => "password",
                    "required" => true,
                    "placeholder" => "Confirme a senha aqui ...", 
                    "rules" => "required"
                ]),
                new BelongsTo([
                    "label" => "Nível de Acesso", 
                    "field" => "roleName",
                    "options" => ["super-admin","admin","user"],
                    "rules" => "required"
                ]),
            ]),
        ];
    }

    public function canViewList()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    public function canView()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    public function canCreate()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    public function canImport()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    public function canExport()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    public function canUpdate()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    public function canDelete()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    public function canCustomizeMetrics()
    {
        return Auth::user()->hasRole(["super-admin"]);
    }

    
}