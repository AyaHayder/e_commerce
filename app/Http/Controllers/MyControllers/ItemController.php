<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use App\Cart;
use Auth;
use Illuminate\Support\Facades\Session;
class ItemController extends Controller
{
    /*
     Hello and welcome to my new documentation, in this documentation
     I'll be showing you around my ItemController methods!
     please don't stop supporting me by adding likes to my recent documentations,
     leave a comment below and share with friends and if you haven't yet subscribed
     to my channel then please do. (even though I don't know what am I talking about XD)

     now to the main subject: here are the methods associated to items with a brief
     description:

    1.getDashboard: this method is getting all categories info (six categories at a time)
                    and all items info (also six items at a time), it's then getting the
                    info of the logged in user (which I'm going to use to add items
                    to cart later), and passing it along with the category and
                    items variables, it then views the view_item page.

    2.sortByPrice: just like the name implies this method is sorting items by price.
                   this is how it works: it gets all items (six items at a time)
                   and arranging them in ascending order according to their price.
                   it then sets three new variables ($link, $linkName, $user)
                   the $link is used to return us the normal view, the $linkName
                   is the name of the link which is going to show to the user, and the
                   $user is info of the logged in user which I'm going to use to add items
                    to cart later.

    3.addToCart: this method is adding items to cart, at first it gets the item id and cart id
                 as a parameter via add to cart button in the view_item page, it's finding
                 the info of the cart with that id and attaching it to the item table with
                 row that contains the item id passed to the method, it saves those changes
                 and return back along with a sweet little message stored in a flash session

    4.searchByName: this method is searching item by name, it takes the value inserted in
                    the search text field comparing it to the item name coloumn and getting
                    back the count of matched items, if the count is greater than zero
                    (there are matching items) then get those items paginate them up to 3 per
                    page and pass them to view_searched_items page along with the info of the
                    logged in user (which I'm going to use to add items
                    to cart later) and view that page, but if the count of the matched items is
                    zero or less redirect to 'user/dashboard/search_not_found' url.

    5.searchNotFound: this method views the 'search_not_found' page in the user directory :)


    that's all for this documentation make sure to take a look at my next documentation
    in OrderController, see you soon :)

     */

    //1.
    public function getDashboard()
    {
        $category=Category::paginate(3);
        $items =Item::paginate(3);
        $user=Auth::user();
        return view('user.view_item',compact('items','category','user'));
    }

    //2.
    public function sortByPrice()
    {
        $items = Item::orderBy('price')->paginate(3);
        $link ="/user/dashboard";
        $linkName="Normal view";
        $user=Auth::user();
        return view('user.view_item',compact('items','link','linkName','user'));
    }

    //3.
    public function addToCart($itemId,$cartId)
    {
        $carts = Cart::find($cartId);
        $carts->item()->attach($itemId);
        $carts->save();
        Session::flash('message','Item was added successfully');
        return back();
    }

    //4.
    public function searchByName(Request $request)
    {
        $user=Auth::user();
        $search = $request->search;
        $count = Item::where('name','like',"%$search%")->count();
        if($count>0){
            $items= Item::where('name','like',"%$search%")->paginate(3);
            return view('user.view_searched_items',compact('items','user'));
        }
        else{
            return redirect('user/dashboard/search_not_found');
        }
    }

    //5.
    public function searchNotFound()
    {
        return view('user.search_not_found');
    }
}
