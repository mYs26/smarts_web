<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin', 0)->get();

        // dd($user);
        //go to patient list
        return view('user.index')->with('users', $users);
        // return User::find(1)->detail;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $foodLibrary = foodLibrary::where('food_id', $id)->first();
        // return view('foodLibrary.show')->with('food', $foodLibrary);
        $users = User::find($id);
        $detail = User::find($id)->detail;
        $report = User::find($id)->reports()->orderBy('created_at', 'desc')->get();
        // $report->orderBy('created_at', DESC)->get();
        // return response()->json($report);
        // dd($users);
        return view('user.show',compact('users', 'detail','report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //show user report
    public function showReport($user_id, $report_id) 
    {
        $patient = User::find($user_id);
        $data = User::find($user_id)->reports()->where('id', $report_id)->first();
        // dd($patient);
        return view ('user.report', compact('patient', 'data'));
    }

    //search function
    public function search(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'like', '%'.$search.'%')->paginate(5);
        return view ('user.index', ['users' => $users]);
    }
}
