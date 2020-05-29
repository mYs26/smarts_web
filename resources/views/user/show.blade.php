@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p>Patient Profile</p>
            </div>
            <div class="card-subtitle" style="padding-left: 20px">
                <br> 
                <p>{{$users->name}}</p>
                <p>{{$users->email}}</p>
                <p>{{$detail->address}}</p>
                <p>{{$detail->p_num}}</p>
                {{-- <p>{{$user->address}}</p> --}}
            </div>
            <hr>
            <div class="card-body">
                patient data.. graph and report
            </div>
        </div>
    </div>    
@endsection
