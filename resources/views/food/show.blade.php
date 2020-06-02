@extends('layouts.app')

@section('content')
    {{-- <div class="flex-center position-ref full-height">
        <p>create new food ...</p>
    </div> --}}
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p>{{$food->food_name}}</p>
            </div>
            <div class="card-body">
                <div style="text-align: center; padding:20px;">
                    <div >
                        <img src="/storage/food_image/{{$food->food_image}}" alt="food image" style="width:25em; height:25em;">
                    </div>
                    
                </div>
                <div style="padding-left: 15%" class="wrapper">
                    <p>Measurement Type : {{$food->measurement_type}}</p>
                    <p>Food Type : {{$food->food_type}}</p>
                    <p>Food Weigh (gram) : {{$food->weigh_g}}</p>
                    <p>Food Energy (kcal) : {{$food->energy_kcal}}</p>
                    <p>Food Water amount (gram): {{$food->water_g}}</p>
                    <p>Food protein (gram) : {{$food->protein_g}}</p>
                    <p>Food Fat (gram) : {{$food->fat_g}}</p>
                    <p>Food carbohydrates (gram) : {{$food->cho_g}}</p>
                    <p>Food Fibre (gram) : {{$food->fibre_g}}</p>
                    <p>Food Calcium (mg) : {{$food->ca_mg}}</p>
                    <p>Food Phosphorus (mg) : {{$food->p_mg}}</p>
                    <p>Food Iron (mg) : {{$food->re_mg}}</p>
                    <p>Food Sodium (mg) : {{$food->na_mg}}</p>
                    <p>Food Potassium (mg) : {{$food->k_mg}}</p>
                </div>
            </div>
            <div class="card-footer">
                <a href="/food/{{$food->id}}/edit" class="btn btn-success">Edit</a>
                <hr>
                <form action="/food/{{ $food->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn-danger">Delete Food Data</button>
                </form>
            </div>
        </div>
        
    </div>
@endsection