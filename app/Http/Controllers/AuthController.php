<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use illuminate\SUpport\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Constants;

class AuthController extends Controller
{
    /**
     * API Register
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'role' => 'in:author,reader'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Constants::STATUS_UNAUTHORIZED);
        }

//        $input = $request->all();
//        $input['password'] = Hash::make($input['password']);

        $receiveNotifications = $request->has('receive_notifications') ? $request->receive_notifications : "0";

        if ($request->role === 'author')
            $receiveNotifications = "0";

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'receive_notifications' => $receiveNotifications
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], Constants::STATUS_OBJECT_CREATED);
    }

    /**
     * Login user and create token
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
//        dd($request);
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
//        dd($request->user());
        if(!Auth::attempt($credentials)) {
            return response()->json([
                'message' => Constants::UNAUTHORIZED
            ], Constants::STATUS_UNAUTHORIZED);
        }
//        dd($request->user());
        $user = $request->user();
//        dd($user);

        $tokenResult = $user->createToken('BooksAPI');
//        dd($tokenResult);
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'created_at' =>  $tokenResult->token->created_at,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => Constants::SUCCESSFULLY_LOGGED_OUT
        ]);
    }

    /**
     * Get the authenticated user
     * @return \Illuminate\Http\JsonResponse
     */
    public function details(Request $request)
    {
        return response()->json($request->user());
    }
}
