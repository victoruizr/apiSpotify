<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\User;


class AuthControllerUsers extends Controller
{

    public function registerUser(Request $request){
        $request->validate([
            'q' => 'required|string',
            'type' => 'required|string',
            'market' => 'required|string',
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'include_external' => 'required|string',

        ]);

        $validatedUsers = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:6|confirmed',
        ]);

        $userRegistred = User::create([
           'name' => $request->name,
           'email' =>$request->email,
           'password' => Hash::make($request->password)
        ]);


        $userToken = $userRegistred->createToken('authToken')->plainTextToken;

        return response()->json([
            'data' => $userRegistred,
            'access_token' => $userToken,
            'token_type' => 'Bearer',
        ]);

    }


}
