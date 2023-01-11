<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'integer',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->all());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['Result'=>'User Successfully Registered','token' => $token];

        return response($response, 200);
    }

    public function login (Request $request)
     {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();

        if ($user)
         {
            if (Hash::check($request->password, $user->password))
             {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['Result'=>'User Login SuccessFully','token' => $token];
                return response($response, 200);
            } 
            else
            {
                $response = ["message" => "Password Mis-Match"];
                return response($response, 422);
            }
        } 
        else 
        {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) 
    {

        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
