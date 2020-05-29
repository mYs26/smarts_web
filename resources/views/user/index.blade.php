@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content-wrap">
            <p>index user ...</p>

            <div class="content-wrap">
                @if (count($users) > 0)
                    <table class="table">
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th style="text-align: right">Action</th>
                        </tr>
                        @foreach ($users as $user)
                        <tr>
                            <td>1</td>
                            <td>{{$user->name}}</td>
                        <td style="text-align: right"><a href="/user/{{$user->id}}" class="btn btn-success">View User</a></td>
                        </tr>   
                        @endforeach
                        
                    </table>
                @else
                <p>No data found</p>
                @endif

            </div>

        </div>
    </div>    
@endsection
