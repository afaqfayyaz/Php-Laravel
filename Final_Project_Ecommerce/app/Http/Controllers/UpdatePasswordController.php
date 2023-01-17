<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    // This function update the current User password using Auth Token
    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'oldPassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Failed.",
                "body" => $validator->errors(),
            ]);
        }

        $Password = Auth::user()->password;
        if (Hash::check($input['oldPassword'], $Password)) {
            $user = User::Find(Auth::id());
            $user->password = Hash::make($input['password']);
            $user->save();
            return response()->json([
                "success" => true,
                "message" => "Password Updated successfully."
            ]);
            Auth::logout();
        }
    }
}