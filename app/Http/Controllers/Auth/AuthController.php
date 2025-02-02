<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Detail;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login api
    public function login(Request $request) 
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    //register api
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            // 'is_admin' => 'required|boolean',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'address' => 'required',
            'p_num' => 'required'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->is_admin = false;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $detail = new Detail;
        $detail->address = $request->address;
        $detail->p_num = $request->p_num;
        // $user->detail()->address = $request->address;
        // $user->detail()->p_num = $request->p_num;
        $user->save();
        $user->detail()->save($detail);
        

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    //logout api
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
