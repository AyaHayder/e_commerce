<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use App\User;
class CartController extends Controller
{
    /* Hello there again :)
       please don't bother with this controller I only felt sorry
       for myself to delete this method so I decided to comment it out
       because I have already deleted lots of things that I spent a bunch
       of time working on ^ ^''
    */

//    public function getCart()
//    {
//     $cart=Cart::where('user_id','=',Auth::user()->id)->select(['*'])->get();
//     //return $cart;
//     $user = Auth::user();
//     //return $user;
//     $cart->user()->associate($user);
//     if($cart->save());
//        return "success";
//    }
}
