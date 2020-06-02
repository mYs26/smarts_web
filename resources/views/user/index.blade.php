@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content-wrap">
            <h3>Users Index</h3>
            <div class="col-md-4" style="text-align: center">
                <form action="/search" method="GET">
                  <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                      <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                  </div>
                </form>
              </div> <br>

            <div class="content-wrap">
                @if (count($users) > 0)
                    <table class="table">
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th style="text-align: right">Action</th>
                        </tr>
                        @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index +1 }}</td>
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
