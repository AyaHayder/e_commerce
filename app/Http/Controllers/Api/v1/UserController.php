<?php

namespace App\Http\Controllers\Api\v1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{
    public function getUsers()
    {
        $users= User::all();
        return response()->json(
            [
                'users'=>$users,
            ],true);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);
        if ($validator->fails())
            return response()->json(
                [
                    'errors' => $validator->errors()->all()
                ]
                , 422);
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::toUser($token);
        $user->token = $token;

        $user = JWTAuth::toUser($token);

        $user->token =$token;
        //return $user;

        // all good so return the token
        return response()->json(compact('user'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            ]);
        if ($validator->fails())
            return response()->json(
                [
                    'errors' => $validator->errors()->all()
                ]
                , 422);

        $user =new User;
        $user->first_name = $request->first_name;
        $user->password =bcrypt($request->password);
        $user->email = $request->email;
        $user->save();

        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::toUser($token);
        $user->token = $token;

        $user = JWTAuth::toUser($token);

        $user->token =$token;
        //return $user;

        // all good so return the token
        return response()->json(compact('user'));

    }
}
