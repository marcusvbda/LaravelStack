<?php

namespace App\Http\Traits;

// use Vinkla\Hashids\Facades\Hashids;

trait hasCode
{
    private function hasCode()
    {
        $this->append('code');
    }

    public function getCodeAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
