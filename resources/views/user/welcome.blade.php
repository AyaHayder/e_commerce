@extends('Layout.master')

@section('title')
    Welcome
@endsection

@section('link1')
    {{Route('dashboard')}}
@endsection

@section('link1_name')
    View items
@endsection

@section('link2')
    {{Route('user.viewCats')}}
@endsection

@section('link2_name')
    Categories
@endsection




@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 alphaBox">
                <h1 class="text-center">Welcome {{$user->name}}</h1>

                <p class="text-center txt-size">You have been successfully registered with a username of: {{$user->full_name}}<br>
                    and an email address of: {{$user->email}}
                </p>
                <div class="col-md-3 col-md-offset-2">
                    <a href="{{Route('dashboard')}}" class="txt-size">Get Started</a>
                </div>
                <div class="col-md-3 col-md-offset-4 ">
                    <a href="{{Route('user.logout')}}" class="txt-size">log Out</a>
                </div>
            </div>
        </div>
    </div>
@endsection


