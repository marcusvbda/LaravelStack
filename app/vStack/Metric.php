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
        $this->view = $this->initView();
        $this->processView();
    }

    public function label()
    {
        return "";
    }

    public function sublabel()
    {
        return "";
    }

    private function initView()
    {
        if(in_array($this->type,["custom-content"]))
        {
            return  "<div class='".$this->width()." mb-3'>
                        <div class='card p-3 h-100'>
                            __content__here__
                        </div>
                    </div>";
        }
        if(in_array($this->type,["group-graph"]))
        {
            return  "<div class='".$this->width()." mb-3'>
                        <div class='card p-3 h-100'>
                            __content__here__
                        </div>
                    </div>";
        }
        if(in_array($this->type,["simple-counter"]))
        {
            return  "<div class='".$this->width()." mb-3'>
                        <div class='card p-3 h-100'>
                            __content__here__
                        </div>
                    </div>";
        }
        if(in_array($this->type,["trend-graph"]))
        {
            return  "<div class='".$this->width()." mb-3'>
                        <div class='card p-0 h-100'>
                            __content__here__
                        </div>
                    </div>";
        }
    }

    public function width()
    {
        return "col-md-4 col-sm-12";
    }

    public function processView()
    {
        $view = str_replace ("__content__here__",$this->makeContent(),$this->view);
        $this->view = $view;
    }

    private function makeContent()
    {
        switch ($this->type) 
        {
            case 'custom-content':
                return $this->customContent();
                break;
            case 'group-graph':
                return $this->groupGraphContent();
                break;
            case 'simple-counter':
                return $this->simpleCounterContent();
                break;
            case 'trend-graph':
                return $this->trendGrapContent();
                break;
            default:
                return $this->type;
                break;
        }
    }

    private function groupGraphContent()
    {
        return "<metric-piechart :time='time' :route='calculate_route'>
                    <template slot='label'>".$this->label()."</template>
                    <template slot='sublabel'>".$this->sublabel()."</template>
                </metric-piechart>";
    }

    private function customContent()
    {
        return "<metric-custom-content>
                    <template slot='label'>".$this->label()."</template>
                    <template slot='sublabel'>".$this->sublabel()."</template>
                    <template slot='content'>".$this->content()."</template>
                </metric-custom-content>";
    }

    private function trendGrapContent()
    {
        return "<metric-trend-graph :ranges='ranges' :time='time' :route='calculate_route'>".$this->label()."</metric-trend-graph>";
    }

    private function simpleCounterContent()
    {
        return "<metric-simple-counter :ranges='ranges' :time='time' :route='calculate_route'>".$this->label()."</metric-simple-counter>";
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
