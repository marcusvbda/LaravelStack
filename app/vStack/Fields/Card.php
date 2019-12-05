<?php

namespace App\vStack\Fields;

class Card
{
    public $label;
    public $inputs;
    
    public function __construct($label,$inputs)
    {
        $this->label = $label;
        $this->inputs = $inputs;
    }


}
