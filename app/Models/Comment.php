<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    protected $appends = ['date_created', 'time', 'name'];

    public function posts()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function getDateCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d F Y');
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i');
    }

    public function getNameAttribute()
    {
        return "{$this->user->first_name} {$this->user->last_name}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
