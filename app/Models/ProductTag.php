<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductTag extends Pivot
{
    public function getHello(){
        return "hello";
    }

    public function getEnabled(){
        return $this->enabled;
    }
}
