<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use illuminate\SUpport\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    public $statusSuccess = 200;
    public $statusUnauthorized = 401;

    /**
     * API Login
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('BooksAPI')->accessToken;
            return response()->json(['success' => $success], $this->statusSuccess);
        }
        else
            return response()->json(['error' => 'Unauthorized'], $this->statusUnauthorized);
    }

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
            return response()->json(['error' => $validator->errors()], $this->statusUnauthorized);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if ((int)$input['receive_notifications'] === 1 && $input['role'] === 'author')
            $input['receive_notifications'] = "0";

        $user = User::create($input);
        $success['token'] =  $user->createToken('BooksAPI')-> accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success' => $success], $this-> statusSuccess);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->statusSuccess);
    }
}
