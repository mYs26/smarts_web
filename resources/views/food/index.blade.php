@extends('layouts.app')

@section('content')
    <div class="container">
      {{-- @extends('layouts.sidebarFoodLib') --}}
        <div class="content-wrap">
            <h2 style="text-align: center">Food Library List</h2>
            <div style="text-align: center">
              <input type="text" name="search" placeholder="Search..." style="text-align: center">
              
            </div>
            <br>
            @if (count($foods) > 0)
                    <table /*id="customers"*/ class="table">
                      <tr>
                        <th>No</th>
                        <th>Foods</th>
                        <th style="text-align: right">Action</th>
                      </tr>
                      @foreach ($foods as $food)
                      <tr>
                        <td>1</td>
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
