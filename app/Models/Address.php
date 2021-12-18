<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor');
    }
}
