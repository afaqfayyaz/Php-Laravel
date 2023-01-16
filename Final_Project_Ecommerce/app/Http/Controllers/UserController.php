<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'type' => 'integer',
            ]
        );
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);

        $user = User::create($request->all());

        if ($user) {
            $verify2 =  DB::table('password_resets')->where([
                ['email', $request->all()['email']]
            ]);

            if ($verify2->exists()) {
                $verify2->delete();
            }
            $emailToken = rand(100000, 999999);
            DB::table('password_resets')->insert(
                [
                    'email' => $request->all()['email'],
                    'token' => $emailToken
                ]
            );
        }

        Mail::to($request->email)->send(new VerifyEmail($emailToken));

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response()->json(
            [
                'success' => true,
                'message' => 'Successful created user. Please check your email for a 6-digit pin to verify your email.',
                'token' => $token
            ],
            201
        );
    }


    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['message' => $validator->errors()]);
        }
        $select = DB::table('password_resets')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token);

        if ($select->get()->isEmpty()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => "Invalid PIN"
                ],
                400
            );
        }

        $select = DB::table('password_resets')
            ->where('email', Auth::user()->email)
            ->where('token', $request->token)
            ->delete();

        $user = User::find(Auth::user()->id);
        $user->email_verified_at = Carbon::now()->getTimestamp();
        $user->save();

        return response()->json(
            [
                'success' => true,
                'message' => "Email is verified"
            ],
            200
        );
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['Result' => 'User Login SuccessFully', 'token' => $token];
                return response($response, 200);
            } else {
                $response = ["message" => "Password Mis-Match"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => 'User does not exist'];
            return response($response, 422);
        }
    }



    public function logout(Request $request)
    {

        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
