<?php

namespace App\vStack\Fields;

class Text extends Field
{
    public $options = [];
    public function __construct($op = [])
    {
        $this->options = $op;
        $this->options["type"] = "text";
        parent::processFieldOptions();
    }
}
