@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content-wrap">
            <h2 style="text-align: center">Food Library List</h2>
            <div>
              <div class="col-md-4" style="float: left">
                <form action="/searchfood" method="GET">
                  <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                      <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                  </div>
                </form>
              </div>
              <div style="float: right">
                <a href="/food/create" class="btn btn-primary">Create New Food</a>
              </div>
            </div>
            
            <br> <br>
            @if (count($foods) > 0)
                    <table class="table">
                      <tr>
                        <th>No</th>
                        <th>Foods</th>
                        <th style="text-align: right">Action</th>
                      </tr>
                      @foreach ($foods as $index => $food)
                      <tr>
                        <td>{{ $index +1 }}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-4 col-sm-4">
                              <img style="width:50%" src="/storage/food_image/{{$food->food_image}}" alt="food image">
                            </div>
                            <div class="col-md-8 col-sm-8">
                              <a href="/food/{{$food->id}}">{{$food->food_name}}</a> <p  style="font-size: small">{{$food->food_type}}</p>
                            </div>
                          </div>
                          
                        </td>
                        <td style="text-align: right">
                          <a href="/food/{{$food->id}}/edit" class="btn btn-success">Edit</a>
                          <br> <br>
                          <form action="/food/{{ $food->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn-danger">Delete</button>
                        </form>
                        </td>
                      </tr>
                      @endforeach
                      
                    </table>
                    <hr>
                    {{$foods->links()}}
            @else
                <p>No food data found</p>
            @endif

          
        </div>
    </div>    
@endsection
