<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class);
    }
}
