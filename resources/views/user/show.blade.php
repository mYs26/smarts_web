@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <p>Patient Profile</p>
            </div>
            <div class="card-subtitle" style="padding-left: 20px">
                <br> 
                <p>Name : {{$users->name}}</p>
                <p>Email : {{$users->email}}</p>
                <p>Address : {{$detail->address}}</p>
                <p>Contact Number : {{$detail->p_num}}</p>
                {{-- <p>{{$user->address}}</p> --}}
            </div>
            <hr>
            <div class="card-body">
                patient data.. graph

                <hr>

                <p> <b>User Asssessment Report<b> </p>
                    @if (count($report) > 0)
                        @foreach ($report as $item)
                        <div class="well">
                            User report at : <a href="/user/{{$users->id}}/{{$item->id}}">{{$item->created_at}}</a>
                        </div>
                        @endforeach
                    @else
                        Data not exist
                    @endif
                
            </div>
        </div>
    </div>    
@endsection
