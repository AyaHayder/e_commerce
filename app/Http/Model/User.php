<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::Class, 'user_id','id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::Class,'user_id','id');
    }

    public function getfullNameAttribute()//the words get and attribute are fixed
    {
        return $this->first_name." ".$this->last_name;
    }

    public function admin()
    {
        return $this->hasOne(Admin::Class,'user_id','id');
    }

}
