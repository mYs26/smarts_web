<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

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
    public function searchUser(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'like', '%'.$search.'%')->paginate(5);
        return view ('user.index', ['users' => $users]);
    }

    public function graphData($id)
    {
        // $user = User::find($id);
        $users = User::find($id);
        $detail = User::find($id)->detail;
        $report = User::find($id)->reports()->orderBy('created_at', 'desc')->get();
        // $x = Carbon::today()->subDays(6);
        $reportW = $users->reports()->orderBy('created_at', 'desc')->first();
        if ($reportW) {
            # code...
            $date = Carbon::today()->subDays(6);
            $all = array();
            foreach($users->foods as $food) {
                $all = $food->pivot
                            ->where('created_at', '>', $date)
                            ->where('user_id', $users->id)
                            ->get()
                            ->groupBy(function($tarikh) {
                                return Carbon::parse($tarikh->created_at)->format('d'); // grouping by days
                            })->toArray();
            }
            $sodium = array();
            $potassium = array();
            $phosphate = array();
            $protein = array();
            $energy = array();
            $fluid = array();

            //loop hari
            foreach($all as $test){
            //loop makanan dalam sehari
            //temp var utk nk tmbah 
            $tsodium = 0;
            $tpotassium = 0;
            $tphosp = 0;
            $tprotein = 0;
            $tenergy = 0;
            $tfluid = 0;
                foreach($test as $tust){
                    //dapat makanan
                    $tsodium += $tust['sodium'];
                    $tpotassium += $tust['potassium'];
                    $tphosp += $tust['phosphate'];
                    $tprotein += $tust['protein'];
                    $tenergy += $tust['energy'];
                    $tfluid += $tust['fluid'];
                }
                //dekat sini kita dpt total something dlm sehari 
                // % = (n / total)*100
                //dptkn weight fromr report latest
                
                
                $weight = $reportW->weight;
                $weight1 = $weight * 35;
                $weight2 = $weight * 1.25;

                array_push($sodium,round((($tsodium/2000)*100),2));
                array_push($potassium,round((($tpotassium/3500)*100),2));
                array_push($phosphate,round((($tphosp/800)*100),2));
                array_push($protein,round((($tprotein/$weight2)*100),2));
                array_push($energy,round((($tenergy/$weight1)*100),2));
                array_push($fluid,round((($tfluid/500)*100),2));

            }
            $test  = array("name"=>"sodium","data"=>$sodium);
            $test2  = array("name"=>"potasium","data"=>$potassium);
            $test3  = array("name"=>"phosphate","data"=>$phosphate);
            $test4  = array("name"=>"protein","data"=>$protein);
            $test5  = array("name"=>"energy","data"=>$energy);
            $test6  = array("name"=>"fluid","data"=>$fluid);
            $dataG = array($test,$test2,$test3,$test4, $test5, $test6);
            // return response()->json($dataG);
            // $dataG = json_encode($dataG);

            return view('user.show',compact('users', 'detail','report','dataG'));
        } else {
            $dataG = array();
            return view('user.show', compact('users', 'detail','report','dataG'));
        }
        
        
    }
    

}


