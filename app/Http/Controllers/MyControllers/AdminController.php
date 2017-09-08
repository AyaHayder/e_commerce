<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Item;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Category;
use Session;
use function Sodium\crypto_box_publickey_from_secretkey;
use Validator;
use DB;
use App\Cart;
class AdminController extends Controller
{
    /*
    Hello there :)
    please make yourself at home while reading this documentation :)
    I'll be using this controller to do all methods associated with admin activities
    here's a brief description for all methods in this controller:

    1.getLogin: this method is taking me to admin/login page :)

    2.attemptLogin: this method is logging into the website just like the user/login page
                    but in addition to that it takes the id of the just logged in user
                    and compares it to the user_id coloumn in the admin table, it then
                    takes the count of the matched elements, if they match then
                    the count should be greater than zero (one) so the user is an admin
                    and is taken to the admin panel page, if they don't match then he's
                    not an admin so we're telling him that we're really sorry but you're
                    unauthorized :(

    3.getPanel: this method takes me to the admin panel page

    4.getCategories: this method takes me to edit_cats page in addition
                     it's taking the logged in user info and pass it to the page. why?
                     -simply because I wanted to show the name of the admin in the title
                      of the edit_cats page to make it look a little bit better :)

    5.addCat: this method is used to add Category to the database :)
              and after adding category I'm passing a little nice message back.

    6.getUpdateCat: this method is getting an id parameter that is passed to it via url
                    (update/category/{id}) you can see that the id I'm getting is the
                     Category id (you can take a look at edit_cats page) it's then setting
                     a session to store the passed id and in the end it takes me to the
                     update_cat page :)

    7.updateCat: this method updates the chosen category by getting its id from the session
                 mentioned above, after updating the category, I'm passing a little nice message
                 and redirecting to this url(/admin/manage/categories)

    8.deleteCat: this method is getting an id parameter that is passed to it via url
                 (update/category/{id}) just like the updateCat method is and after that I'm
                  softDeleting that category using its id, and in the end I'm passing a little
                  sweet message back to the user and redirecting to this url(/admin/manage/categories)

    9.getItems: this method gets the logged in user info and all items in the database,
                view the edit_items page and pass the user and items variables to that page.

    10.getAddItem: this method views the add_items page, and passes the logged in user info to
                   it as a variable :)

    11.addItem: this method does the actual 'adding item' process it's setting the item name
                and price to the values inserted into the input 'text' fields and after doing so
                it's getting the category name that was inserted into the cat text field, it's
                then comparing this value with the name coloumn in the category table and takes
                the count of the matched elements, if they match the adding item process will
                continue by getting the info of the matched element (so I can then get the
                id of the matched element) and setting the item's category_id to it, then
                i'm setting the item's image_path to the value inserted in the image path
                text field, saving the changes made to item and then passing a little sweet
                message and redirecting the user to this url(/admin/manage/items) but in case
                that the count of the matched elements is zero or less (XD)
                I'm telling the user that there's no such category, stopping the process and
                taking him back to the add_item page :)

    12.getUpdateItem: this method is taking the item id as a parameter from edit_items page,
                      saving that id in  a session and the viewing the update_item page and
                      passing the logged in user info as a variable :)

    13.updateItem: this method is doing the actual update item process it's very similar to
                   the addItem method, the only difference is that it is not making a new item
                   instead it's taking the info of the item with the id value stored the session
                   mentioned in the above (in getUpdateItem method) and updating these info.

    14.deleteItem: this method is performing the delete item process, it's getting the id of the
                   item that needs to be deleted from the edit_items page and using it to delete
                   that item, then passing a little sweet message in a session and redirecting to
                   (/admin/manage/items) url.


    15.getUsers: this method is viewing the edit_users page after getting the info of all users
                 (gets 10 users info at a time) and passing it along with the logged in user info :)

    16.makeAdmin: this method is performing the make admin process by getting the id of the user
                  whom is wished to be made admin as a parameter from the make admin link in the
                  edit_users page, the method makes a new admin and sets its user_id value equal
                  to the id value parameter, saving the changes made to admin and returning back
                  with a little nice message :)

    17.deleteUser: this method is performing the softDelete user process by getting the id of the user
                   whom is wished to be deleted as a parameter from the make delete link in the
                   edit_users page, the method is using that id to softDelete the user, passing
                   a sweet message through session and redirecting to (/admin/manage/users) url
                   to view the changes.

    Hope that was helpful please don't forget to subscribe to my channel, add like to
    the documentation, leave a comment below and share it with friends if you think it was helpful (XD)
    and wait for the next documentation in the coming controller, see you soon ;)


    */

    //1.
    public function getLogin()
    {
        return view('admin.login');
    }
    //2.
    public function attemptLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        if ($validator->fails())
            return back()->withErrors($validator->errors())->withInput();
        $credentials = $request->only('email', 'password');
        $rememberMe = $request->remember_me;

        if (Auth::guard('web')->attempt($credentials,$rememberMe)) {
            $user = Auth::user()->id;
            $admin = Admin::where('user_id','=',$user)->count();
            if($admin > 0)
                return redirect('/admin/panel');
            else
            {
                Session::flash('message','Sorry you are unauthorized');
                return back();
            }

        }
    }

    //3.
    public function getPanel(User $user)
    {
        $user = Auth::user();
        return view('admin.panel',compact('user'));
    }

    //4.
    public function getCategories()
    {
        $user =Auth::user();
        $categories =Category::paginate(10);
        return view('admin.edit_cats',compact('categories','user'));
    }

    //5.
    public function addCat(Request $request)
    {
        $category = new Category;
        $category->name = $request->add_cat;
        $category->save();
        Session::flash('message','Category was added successfully!');
        return back();

    }
    //6.
    public function getUpdateCat($id)
    {
        $user = Auth::user();
        session(['update_id'=>$id]);
        return view('admin.update_cat',compact('user'));
    }
    //7.
    public function updateCat(Request $request)
    {
        if(Session::has('update_id')) {
            $id = $request->session()->get('update_id');
            $category=Category::find($id);
            $category->name = $request->name;
            if ($category->save())
                Session::flash('message', 'Category was updated successfully');
            return redirect('/admin/manage/categories');
        }
    }
    //8.
    public function deleteCat(Category $id)
    {
        $id->delete();
            Session::flash('message','Category was deleted successfully');
        return redirect('/admin/manage/categories');

    }

    //9.
    public function getItems()
    {
        $user=Auth::user();
        $items =Item::paginate(10);
        return view('admin.edit_items',compact('user','items'));
    }

    //10.
    public function getAddItem()
    {
        $user=Auth::user();
        return view('admin.add_item',compact('user'));
    }

    //11.
    public function addItem(Request $request)
    {
        $item = new Item;
        $item->name = $request->name;
        $item->price = $request->price;
        $cat = $request->cat;
        $count = Category::where('name','like',"%$cat%")->count();
        if($count > 0){
            $category = Category::where('name','like',"%$cat%")->first();
            $item->category_id = $category->id;
            $item->image_path = $request->img_path;
            $item->save();
            Session::flash('message','Item was added successfully!');
            return redirect('/admin/manage/items');
        }
        else{
            Session::flash('message','there is NO such category, please try with a valid category name!');
            return back();
        }
    }

    //12.
    public function getUpdateItem($id)
    {
        session(['update_id'=>$id]);
        $user =Auth::user();
        return view('admin.update_item',compact('user'));
    }

    //13.
    public function updateItem(Request $request)
    {
        $id = $request->session()->get('update_id');
        $item = Item::find($id);
        $item->name = $request->name;
        $item->price = $request->price;
        $cat = $request->cat;
        $count = Category::where('name','like',"%$cat%")->count();
        if($count > 0){
            $category = Category::where('name','like',"%$cat%")->first();
            $item->category_id = $category->id;
            $item->image_path = $request->img_path;
            $item->save();
            Session::flash('message','Items was updated successfully!');
            return redirect('/admin/manage/items');
        }
        else {
            Session::flash('message', 'there is NO such category, please try with a valid category name!');
            return back();
        }
    }

    //14.
    public function deleteItem(Item $id)
    {
        $id->delete();
        Session::flash('message','Item was deleted successfully');
        return redirect('/admin/manage/items');
    }

    //15.
    public function getUsers()
    {
        $loggedUser=Auth::user();
        $users = User::paginate(10);
        $cart = Cart::paginate(10);
        return view('admin.edit_users',compact('users','loggedUser','cart'));
    }

    //16.
    public function makeAdmin($id)
    {
        $admin = new Admin;
        $admin->user_id =$id;
        if($admin->save())
            Session::flash('message','User\'s permissions were updated to admin');
        return back();
    }

    //17.
    public function deleteUser(User $id)
    {
        $id->delete();
        Session::flash('message','User was deleted successfully');
        return redirect('/admin/manage/users');
    }

}