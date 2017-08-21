<?php

namespace App\Http\Controllers\Api\v1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        return response()->json([
            'status'=>true,
            'users'=>$users,
        ]);
    }



}
