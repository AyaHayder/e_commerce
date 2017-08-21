<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::Class);
    }
    public function item()
    {
        return $this->belongsToMany(Item::Class,'cart_item','cart_id','item_id');
    }

    public function order()
    {
       return $this->belongsToMany(Order::Class,'cart_order','cart_id','order_id');
    }
}
