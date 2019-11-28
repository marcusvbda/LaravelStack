<?php

namespace App\vStack\Fields;

class Check extends Field
{
    public $options = [];
    public function __construct($op = [])
    {
        $this->options = $op;
        $this->options["type"] = "check";
        parent::processFieldOptions();
        $this->makeView();
    }

    private function makeView()
    {
        $label          = $this->options["label"];
        $field          = $this->options["field"];
        $active_color   = @$this->options["active_color"] ? $this->options["active_color"] : "green";
        $inactive_color = @$this->options["inactive_color"] ? $this->options["inactive_color"] : "red";
        $active_text    = @$this->options["active_text"] ? $this->options["active_text"] : "";
        $inactive_text  = @$this->options["inactive_text"] ? $this->options["inactive_text"] : "";
        $view = "<div>                                         
                    <label v-if='!hide_label' class='mb-3'>$label</label>                     
                    <el-switch             
                        :disabled='hide_label'                            
                        class='ml-3'                          
                        v-model='form.$field'                 
                        active-color='$active_color'          
                        inactive-color='$inactive_color'      
                        active-text='$active_text'            
                        inactive-text='$inactive_text'>       
                    </el-switch>                              
                </div>";
        return $this->view = $view;
    }
}
