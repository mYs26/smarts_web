@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as normal user! Welcome to the Dashboard.

                    <p>This system is developed for Admin only.  Kindly please use the apps...</p>
                    
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="homediv">
        <a href="/patient" id="button1">patient Assessment</a>
        <a href="/foodLibrary" id="button2">Food Library</a>
    </div> --}}
    
</div>
@endsection
