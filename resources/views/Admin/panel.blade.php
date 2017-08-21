@extends('Layout.master')

@section('title')
    {{$user->first_name}} Admin Panel
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
            <div class="col-md-8 col-md-offset-2 text-center alphaBox">
                <h1>Welcome {{$user->full_name}}</h1>
                <p class="txt-size text-center">
                    This is your admin panel you can manage: categories, items and users too. <br>
                    So use it carefully
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center alphaBox">
                <div class="col-md-2 col-md-offset-3 panelBorder">
                    <img src="/../../images/Custom-Icon-Design-Pretty-Office-4-Open-Folder-Full.png" class="img-responsive">
                    <a href="{{Route('manage.categories')}}">Manage Categories</a>
                </div>
                <div class="col-md-2  panelBorder">
                    <img src="/../../images/Add-item-icon.png" class="img-responsive">
                    <a href="{{Route('manage.items')}}">Manage Items</a>
                </div>
                <div class="col-md-2 panelBorder">
                    <img src="/../../images/m7.png" class="img-responsive">
                    <a href="{{Route('manage.users')}}">Manage Users</a>
                </div>
            </div>
        </div>
    </div>
@endsection