@extends('layouts.layout')

@section('content')
    <div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <img src="/img/logo_smartsd4d.png" alt="smarts d4d logo" width="300" height="100">
        <div class="title m-b-md">
            SMARTS D4D APP WEB SYSTEM
        </div>

        <div class="links">
            <p>This web system is specifically for <b>Admins<b> and <b>Health Care Professional (HCP)<b> use only.</p>
        </div>
    </div>
    </div>
@endsection


