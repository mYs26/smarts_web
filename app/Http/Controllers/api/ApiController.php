<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Food;
use App\User;
use App\Report;

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
        //validator input
        // $request->validate([
        //     'user_id' => 'required',
        //     'doctor_name' => 'required|string',
        //     'weight' => 'required',
        //     'height' => 'required'
        // ]);
        
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
}
