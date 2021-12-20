<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'doctorreviews';

    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
