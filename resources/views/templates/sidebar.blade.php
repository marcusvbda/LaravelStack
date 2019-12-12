<?php 
$menu = [];
$menu[] = ["label"=>"Dashboard","icon"=>"el-icon-s-home","url"=>route('admin.home'), "active" => Menu::isActive('admin.home')];
foreach(ResourcesHelpers::all() as $group=>$resources)
{
    $groups = ["label"=>$group,"items" => []];
    foreach($resources as $resource)
    {
        if($resource->canViewList())
            $groups["items"][] = ["active"=>Menu::ResourceIsActive($resource->id),"url"=>$resource->route(),"icon"=>$resource->icon(),"label"=>$resource->label()];
    }
    $menu[] = $groups;
}
$logo = ["src"=>asset('assets/images/logo.png'),"href"=>route('admin.home')];
?>
<template-sidebar :logo="{{json_encode($logo)}}" :menu="{{json_encode($menu)}}"></template-sidebar>