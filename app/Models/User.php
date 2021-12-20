<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends = ['name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->hasOne('App\Models\Doctor');
    }

    public function patient()
    {
        return $this->hasOne('App\Models\Patient');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

//    public function getAddressAttribute()
//    {
//        return "{$this->address->street}, {$this->address->postal_code} {$this->address->muncipility}, {$this->address->city}, {$this->address->country}";
//    }

//    public function getDateOfBirthAttribute()
//    {
//        return Carbon::parse($this->attributes['date_of_birth'])->age;
//    }
}
