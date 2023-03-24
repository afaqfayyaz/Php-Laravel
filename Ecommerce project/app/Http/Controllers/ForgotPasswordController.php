<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class ForgotPasswordController extends Controller
{
    /* First User hit this api url this function send user an 
    email with a token and a link where they can change the password*/

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        $resetPassword = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        if ($resetPassword) {
            Mail::to($request->email)->send(new ResetPassword($token));
        }
        return response()->json([
            "success" => true,
            "message" => 'We have e-mailed your password reset link!'
        ]);
    }

    //After hiting the Url that sent in the email this function open the Forgot password form field.

    public function forgotPasswordForm($token)
    {
        return view('ForgotPasswordForm', ['token' => $token]);
    }

    //After submit the for this function triggers and change the password.

    public function reset(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();

        if (!$updatePassword) {
            return response()->json([
                "success" => false,
                "message" => 'Invalid token!'
            ]);
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return response()->json([
            "success" => true,
            "message" => 'Your password has been changed!'
        ]);
    }
}