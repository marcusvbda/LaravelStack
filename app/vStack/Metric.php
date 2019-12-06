<?php

namespace App\vStack;
use Illuminate\Http\Request;

class Metric
{
    public $label;
    public $type;
    public $view;

    public function __construct()
    {
        $this->initView();
        $this->processView();
    }

    public function label()
    {
        return "";
    }

    private function initView()
    {
        $this->view =  "<div class='".$this->width()."'>
                            <div class='card p-3 h-100'>__label__here__
                                __put__content__here__
                            </div>
                        </div>";
    }

    public function width()
    {
        return "col-md-4 col-sm-12";
    }

    public function processView()
    {
        $view = str_replace ("__put__content__here__",$this->makeContent(),$this->view);
        $view = str_replace ("__label__here__",$this->label() ? $this->label() : "",$view);
        $this->view = $view;
    }

    public function content() 
    {
        return "card content here";
    }

    private function makeContent()
    {
        switch ($this->type) 
        {
            case 'custom-content':
                return $this->content();
                break;
            case 'group-graph':
                return $this->groupGraphContent();
                break;
            case 'simple-counter':
                return $this->simpleCounterContent();
                break;
            default:
                return $this->content();
                break;
        }
    }

    private function groupGraphContent()
    {
        return "<metric-piechart :time='time' :route='calculate_route'></metric-piechart>";
    }

    private function simpleCounterContent()
    {
        return "<metric-simple-counter :ranges='ranges' :time='time' :route='calculate_route'></metric-simple-counter>";
    }

    public function ranges()
    {
        return [];
    }

    public function calculate(Request $request)
    {
        return [];
    }

    public function updateTime()
    {
        return 60;
    }

    public function uriKey()
    {
        return 'metric_key_here';
    }
}
