<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Food;
use App\User;
use App\Report;
use Carbon\Carbon;

class ApiController extends Controller
{
    //food list api
    public function foodList()
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    //report assessment api
    public function patientReport (Request $request) 
    {
        
        $doctor = $request->user()->name;

        $w = $request->weight;
        $h = $request->height / 100;
        $abah = $h*$h;
        $umi = $w/$abah;

        $report = new Report;
        $report->user_id = $request->user_id;
        $report->diagnosis_type = $request->diagnosis_type;
        $report->report_summary = $request->report_summary;
        $report->weight = $request->weight;
        $report->height = $request->height;
        $report->BMI = $umi;
        $report->interdialytic_weight = $request->interdialytic_weight;
        $report->dry_weight = $request->dry_weight;
        $report->creatinine = $request->creatinine;
        $report->urea = $request->urea;
        $report->potassium = $request->potassium;
        $report->sodium = $request->sodium;
        $report->phosphate = $request->phosphate;
        $report->urine_analysis = $request->urine_analysis;
        $report->bp = $request->bp;
        $report->ktv = $request->ktv;
        $report->skin_condition = $request->skin;
        $report->appetite = $request->appetite;
        $report->gi_symptom = $request->symptom;
        $report->doctor_name = $doctor;

        $report->save();
        // return response()->json($request->user());
        // return response()->json($umi);
        return response()->json([
            'message' => 'Successfully created a report!'
        ], 201);
    }

    //user diet entry
    public function userDiet (Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'intake_amount' => 'required'
        ]);

        $user_id = $request->user()->id;
        
        $user = User::where('id', $user_id)->first();
        
        $intake = $request->intake_amount;
        $food = Food::where('id', $request->food_id)->first();

        $energy = $food->energy_kcal * $intake;
        $fluid = $food->water_g * $intake;
        $protein = $food->protein_g * $intake;
        $potassium = $food->k_mg * $intake;
        $phosphate = $food->p_mg * $intake;
        $sodium = $food->na_mg * $intake;

        $user->foods()->attach([
            $food->id => [
                'intake_amount' => $intake,
                'energy' => $energy,
                'protein' => $protein,
                'fluid' => $fluid,
                'potassium' => $potassium,
                'phosphate' => $phosphate,
                'sodium' => $sodium
            ]
        ]);

        return response()->json([
            'message' => 'Successfully updated diet!'
        ], 201);
        

    }

    public function userDietList (Request $request)
    {
        $user = $request->user();
        foreach ($user->foods as $food) {
            $s = $food->pivot->whereDate('created_at', '=', Carbon::today()->toDateString())->get();
            $a = $s->where('user_id', $user->id);
        }
        if ($a) {
            # code...
            //return all the food that taken that day
            return response()->json($a);
        } else {
            # code...
            return response()->json([
                'message' => 'no food entered yet'
            ]);
        }
        
        
    }

    public function deleteUserDiet (Request $request) {

        $request->validate([
            'foodL_id' => 'required',
        ]);
        $user = $request->user();
        $fd = $request->foodL_id;
        $user->foods()->wherePivot('id', '=', $fd)->detach();

        return response()->json([
            'message' => 'Successfully deleted diet!'
        ], 201);
    }

    public function userDietPercent (Request $request)
    {
        $user = $request->user();
        foreach ($user->foods as $food) {
            $s = $food->pivot->whereDate('created_at', '=', Carbon::today()->toDateString())->get();
            $a = $s->where('user_id', $user->id);
        }
        //return all the food that taken that day
        // return response()->json($a);

        //validation
        if ($a) {
            # code...
            $sodium = 0;
            $potassium = 0;
            $phosphate = 0;
            $protein = 0;
            $energy = 0;
            $fluid = 0;
            //loop mknn
            foreach($a as $item)
            {
                $sodium += $item->sodium;
                $potassium += $item->potassium;
                $phosphate += $item->phosphate;
                $protein += $item->protein;
                $energy += $item->energy;
                $fluid += $item->fluid;
            }
            //get weight from report
            $reportW = $user->reports()->orderBy('created_at', 'desc')->first();
            if ($reportW) {
                # code...
                $weight = $reportW->weight;
                $weight1 = $weight * 35;
                $weight2 = $weight * 1.25;
        
                //get percentage
                $sodpercent = number_format(($sodium/2000)*100);
                $potpercent = number_format(($potassium/3500)*100);
                $phospercent = number_format(($phosphate/800)*100);
                $propercent = number_format(($protein/$weight2)*100);
                $enerpercent = number_format(($energy/$weight1)*100);
                $fluidpercent = number_format(($fluid/500)*100);
        
                $sod = array("name"=>"sodium", "data"=>$sodpercent);
                $pot = array("name"=>"potassium", "data"=>$potpercent);
                $phos = array("name"=>"phosphate", "data"=>"$phospercent");
                $pro = array("name"=>"protein", "data"=>"$propercent");
                $ener = array("name"=>"energy", "data"=>"$enerpercent");
                $water = array("name"=>"fluid", "data"=>"$fluidpercent");
                $data = array($sod, $pot, $phos, $pro, $ener, $water, $water);
        
                return response()->json($data);
            } else {
                # code...
                return response()->json([
                    'message' => 'no user assessment report yet'
                ]);
            }
            
            

        } else {
            # code...
            return response()->json([
                'message' => 'Food Data Not Entered yet'
            ], 401);
        }
        

    }

}
