<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::Class);
    }

    public function item()
    {
        return $this->belongsToMany(Item::Class,'item_order','order_id','item_id');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::Class,'cart_order','order_id','cart_id');
    }
}
