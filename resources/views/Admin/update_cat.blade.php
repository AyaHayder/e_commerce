@extends('Layout.master')

@section('title')
    {{$user->first_name}} Admin Panel/edit categories
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
            <div class="col-md-8 col-md-offset-2 alphaBox">
                <form action="{{Route('update.cat')}}" method="post">
                    {{csrf_field()}}
                    <h1 class="text-center">Update Category</h1>
                    <div class="form-group">
                        <label>New name</label>
                        <input type="text" name="name" class="form-control" placeholder="Type here the new name of category"><br>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection