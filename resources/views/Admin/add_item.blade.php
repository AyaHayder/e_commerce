@extends('Layout.master')

@section('title')
    {{$user->first_name}} Admin Panel/add item
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
                @if(Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <form action="{{Route('admin.addUser')}}" method="post">
                    {{csrf_field()}}
                    <h1 class="text-center">Add Item</h1>
                    <div class="form-group">
                        <label>First name</label>
                        <input type="text" name="name" class="form-control" placeholder="First Name"><br>
                        <label>Last name</label>
                        <input type="text" name="price" class="form-control" placeholder="type the price"><br>
                        <label>Category</label>
                        <input type="text" name="cat" class="form-control" placeholder="category name"><br>
                        <label>Image</label>
                        <input type="url" name="img_path"  class="form-control" placeholder="image path"><br>
                    </div>
                    <button type="submit">Submit</button>
                </form>
                <br>
                <a href="{{Route('admin.panel')}}">Back to admin panel</a>
            </div>
        </div>
    </div>
@endsection