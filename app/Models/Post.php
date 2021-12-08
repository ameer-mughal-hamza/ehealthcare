<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    protected $appends = ['time', 'date_created'];
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i');
    }
}
