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
        $this->makeView();
        $this->processView();
    }

    public function makeView()
    {
        switch ($this->type) 
        {
            case 'custom-content':
                return $this->view = $this->getCustomContent();
                break;
            case 'group-graph':
                return $this->view = $this->getGroupGraph();
                break;
            default:
                return $this->view = "<div class='text-danger'>metric type not exist</div>";
                break;
        }
    }

    public function label()
    {
        return "";
    }

    private function getCustomContent()
    {
        return $this->getInitialCard();
    }

    private function getGroupGraph()
    {
        $card = $this->getInitialCard();
        return $card;
    }

    private function getInitialCard()
    {
        return "<div class='".$this->width()."'>
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
                return $this->GroupGraphContent();
                break;
            default:
                return $this->content();
                break;
        }
    }

    private function GroupGraphContent()
    {
        return "<metric-piechart :route='calculate_route'></metric-piechart>";
    }

    public function calculate(Request $request)
    {
        return [];
    }

    public function uriKey()
    {
        return 'metric_key_here';
    }
}
