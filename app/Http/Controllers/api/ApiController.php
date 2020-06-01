<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Food;
use App\User;

class ApiController extends Controller
{
    //food list api
    public function foodList()
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    //report assessment api
    // public function patientReport (Request $request) 
    // {
    //     //validator input
    //     $request->validate([
    //         'name' => 'required|string',
    //         // 'is_admin' => 'required|boolean',
    //         'email' => 'required|string|email|unique:users',
    //         'password' => 'required|string',
    //         'address' => 'required',
    //         'p_num' => 'required'
    //     ]);
    //     $user = new User;
    //     $user->name = $request->name;
    //     $user->is_admin = false;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);

    //     $detail = new Detail;
    //     $detail->address = $request->address;
    //     $detail->p_num = $request->p_num;
    //     // $user->detail()->address = $request->address;
    //     // $user->detail()->p_num = $request->p_num;
    //     $user->save();
    //     $user->detail()->save($detail);
        

    //     return response()->json([
    //         'message' => 'Successfully created user!'
    //     ], 201);
    // }

    //user diet entry
    public function userDiet (Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'intake_amount' => 'required'
        ]);

        $user_id = $request->user()->id;
        
        $user = User::where('id', $user_id)->first();

        $user->foods()->attach([
            $request->food_id => [
                'intake_amount' => $request->intake_amount
            ]
        ]);

        return response()->json($user);
        

    }
}
