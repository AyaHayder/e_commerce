<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Auth;
use App\Item;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /*
     Hello and welcome again to my new documentation, as promised I'll be explaining
     to you my OrderController methods, so please follow around :)

    1.getOrder: this method is viewing my make_order page :)

    2.makeOrder: this method is doing the actual make order process by setting $user value to the
                 info of the logged in user, will come to tell you why later.
                 the method then takes the value inserted into the 'order' text field and setting it
                 to $getOrder variable.
                 it then compares th value of $getOrder to item name coloumn and stores the count of
                 the matched elements in $count variable.
                 if the count was greater than zero (i.e: there are matching elements) then proceed by
                 taking the info of the matched element and storing its id to $itemId variable,
                 and here comes the part I told you to wait for later:
                 I'm using the $user variable to get the cart id (getting advantage of having one
                 to one relationship between carts and users table) so it's like telling it to get
                 the id of the cart of the current user.
                 and now I'm going to make my new Order, I'm giving it a name from 'order_name' text
                 field and adding "/" along with the item name to it.
                 I'm giving the value of $user id to the order user_id coloumn, saving my changes
                 and making the many to many relationship between order and item and again between
                 order and cart, I'm then saving changes and redirecting to '/user/view_profile' url
                 with a little nice mesaage :)

    that's all, hope it was helpful ^ ^''

     */

    //1.
    public function getOrder()
    {
        return view('user.make_order');
    }

    //2.
    public function makeOrder(Request $request)
    {
        $user = Auth::user();
        $getOrder = $request->order;
        $count =Item::where('name','like',"%$getOrder%")->count();
        if($count > 0){
            $item= Item::where('name','like',"%$getOrder%")->first();
            $itemId=$item->id;
            $cartId= $user->cart->id;
            $order = new Order;
            $order->name = $request->order_name . "/ " . $item->name;;
            $order->user_id = $user->id;
            $order->save();

            $order->item()->attach($itemId);
            $order->cart()->attach($cartId);
            $order->save();
            Session::flash('message','You have successfully placed an order');
            return redirect('/user/view_profile');
        }
        else{
            Session::flash('message','the order must have an existing item!');
            return back();
        }

    }
}
