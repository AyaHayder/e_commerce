@extends('Layout.master')

@section('title')
    Register
@endsection

@section('link1')
    {{Route('dashboard')}}
@endsection

@section('link1_name')
    view items
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
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 alphaBox">
                @if($errors->count()>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <form action="{{Route('user.register')}}" method="POST">
                    {{csrf_field()}}
                    <h1>Sign up</h1>
                    <div class="form-group">
                        <label for="InputFirstName">First name</label>
                        <input type="text" value="{{old('first_name')}}" name="first_name" id="InputFirstName" class="form-control"  placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label for="InputLastName">Last name</label>
                        <input type="text" value="{{old('last_name')}}" name="last_name" id="InputLastName" class="form-control"  placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email address</label>
                        <input type="email" value="{{old('email')}}" name="email"  id="InputEmail" class="form-control"  placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" name="password" id="InputPassword" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="InputConfirmPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" id="InputConfirmPassword" class="form-control"  placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>

                </form>
            </div>
        </div>
    </div>

@endsection