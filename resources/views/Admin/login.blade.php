@extends('Layout.master')

@section('title')
    Admin Login
@endsection

@section('link1')
{{Route('dashboard')}}
@endsection

@section('link1_name')
    Back to website
@endsection

@section('link2')
    {{Route('dashboard')}}
@endsection

@section('link2_name')
    View items
@endsection

@section('admin')
    active
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 alphaBox">
                @if($errors->count()>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <form action="{{Route('admin.login')}}" method="post">
                    {{csrf_field()}}
                    <h1 class="padding">Admin Sign in <span class="glyphicon glyphicon-lock pull-right" ></span></h1>
                    <div class="form-group">
                        <label for="InputEmail1">Email address</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="InputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="InputPassword1" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember_me"> keep me logged in
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                    <br><br><br>
                </form>
            </div>
        </div>
    </div>

@endsection