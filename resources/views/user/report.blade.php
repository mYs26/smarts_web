@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p>Patient Assessment Report</p>
            </div>
            <div class="card-subtitle" style="padding-left: 20px">
                <br> 
                <p>Name : {{$patient->name}}</p>
                <p>Email : {{$patient->email}}</p>
                <p>Diagnosis Type : Code {{$data->diagnosis_type}}</p>
                <div style="display: grid; grid-template-columns: 150px 150px">
                    <p>Weight : {{$data->weight}} kg</p>
                    <p>Height : {{$data->height}} cm</p>
                </div>
                <p>BMI : {{$data->BMI}}</p>
            </div>
            <hr>
            <div class="card-body">
                <div>
                    <h5>Report Summary</h5>
                    <p>{{$data->report_summary}}</p>
                    <hr>
                </div>
                
                <div style="display: grid; grid-template-columns: 400px 400px">
                    <p>Interdialytic Weight : {{$data->interdialytic_weight}} kg</p>
                    <p>Dry Weight : {{$data->dry_weight}} kg</p>
                    <p>Creatinine : {{$data->creatinine}}</p>
                    <p>Urea : {{$data->urea}}</p>
                    <p>Potasssium : {{$data->potassium}}</p>
                    <p>Sodium : {{$data->sodium}}</p>
                    <p>Phosphate : {{$data->phosphate}}</p>
                    <p>Blood Pressure : {{$data->bp}}</p>
                    <p>Kt/v : {{$data->ktv}}</p>
                </div>
                <hr>
                <div>
                    <h5>Urine Analysis</h5>
                    <p>{{$data->urine_analysis}}</p>
                    <hr>
                </div>
                <p>Assessment By : {{$data->doctor_name}}</p>
                <small>Assessment Date : {{$data->created_at}}</small>

            </div>
        </div>
    </div>    
@endsection
