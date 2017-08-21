<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use Illuminate\Http\Request;
use function Sodium\crypto_box_publickey_from_secretkey;
use Validator;
use Auth;
use App\Cart;
use Session;
use Response;

class UserController extends Controller
{

    //1.
    public function getLogin()
    {
        return view('user.login');
    }

    //2.
    public function getRegister()
    {
        return view('user.register');
    }

    //3.
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);
        if ($validator->fails())
            return back()->withErrors($validator->errors())->withInput();

        $user = new User;
        $cart = new Cart;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        if ($user->save()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $cart->user_id = intval(Auth::user()->id);
                $cart->save();
                return redirect('/user/welcome');
            } else {
                return back()->withError(['error' => 'wrong email or password']);
            }
        }
        return abort(500);
    }

    //4.
    public function attemptLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        if ($validator->fails())
            return back()->withErrors($validator->errors())->withInput();
        $credentials = $request->only('email', 'password');
        $rememberMe =$request->remember_me;

        if (Auth::guard('web')->attempt($credentials,$rememberMe)) {
            return redirect('/user/dashboard');
        }

    }

    //5.
    public function getLogout(Request $request)
    {
        Auth::logout();
        Session::flash('message','Please visit again!');
        return redirect('/user/login');
    }

    //6.
    public function getWelcome()
    {
        $user=Auth::user();
        return view('user.welcome',compact('user'));
    }

    //7.
    public function getProfile()
    {
        $carts =Cart::all();
        $user=Auth::user();
        return view('user.view_profile',compact('user','carts'));
    }

}
