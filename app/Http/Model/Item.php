<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    public function category()
    {
        return $this->belongsTo(Category::Class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::Class,'item_order','item_id','order_id');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::Class, 'cart_item','item_id','cart_id');
    }
}
