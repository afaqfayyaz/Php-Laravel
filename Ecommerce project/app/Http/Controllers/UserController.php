<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\IsTrue;
use SebastianBergmann\Type\TrueType;

class UserController extends Controller
{
    // This function register the user and send the verification email to the user with 6 digit pin.

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
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" =>  $validator->errors()
            ]);
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

    // This function take the passport auth token and the pin that send to the email and verify the user.
    public function verifyEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" =>  $validator->errors()
            ]);
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
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" =>  $validator->errors()
            ]);
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                return response()->json([
                    "success" => true,
                    "message" => "User Login SuccessFully",
                    "Token" => $token
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Password Mis-Match",
                ]);
            }
        } else {
            return response()->json([
                "success" => false,
                "message" => "User does not exist",
            ]);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->update();
        return response()->json([
            "success" => true,
            "message" => "User updated",
            "body" => $data,
        ]);
    }
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json([
                "success" => true,
                "message" => "User retrived successfully",
                "body" => $user,
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "User not found",
            ]);
        }
    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            "success" => true,
            "message" => "You have been successfully logged out!",
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            "success" => true,
            "message" => "User Successfully deleted",
        ]);
    }
}