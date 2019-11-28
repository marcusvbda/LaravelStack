<?php

namespace App\vStack\Fields;

class Text extends Field
{
    public $options = [];
    public $view = "";
    public function __construct($op = [])
    {
        $this->options = $op;
        $this->options["type"] = "text";
        parent::processFieldOptions();
        $this->makeView();
    }

    private function makeView()
    {
        $label          = $this->options["label"];
        $append         = @$this->options["append"];
        $prepend        = @$this->options["prepend"];
        $type           = $this->options["type"];
        $field          = $this->options["field"];
        $placeholder    = $this->options["placeholder"];
        $view = "<v-input class='mb-3'  
                    :hidelabel='hide_label' 
                    :disabled='hide_label'                                                                  
                    label='$label'                                                                   
                    prepend='$prepend'                                                               
                    append='$append'                                                               
                    type='$type'                                                                     
                    v-model='form.$field'                                                            
                    placeholder='$placeholder'                                                       
                    :errors='errors.$field ? errors.$field : false'                                  
                />";
        return $this->view = $view;
    }
}
