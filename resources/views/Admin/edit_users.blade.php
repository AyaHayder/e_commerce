@extends('Layout.master')

@section('title')
    {{$loggedUser->first_name}} Admin Panel/edit users
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
    <div class="container-fluid alphaBox">
        <div class="col-md-6 col-md-offset-2">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <table class="table-bordered table-striped center txt-size">
                <thead style="background-color:#23527c; color:white">
                <th class="text-center elementPadding">ID</th>
                <th class="text-center elementPadding">Name</th>
                <th class="text-center elementPadding">Email</th>
                <th class="text-center elementPadding">Cart ID</th>
                <th class="text-center elementPadding">Cart Contents</th>
                <th class="text-center elementPadding">Orders</th>
                <th class="text-center elementPadding">Edit user</th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center  elementPadding">{{$user->id}}</td>
                        <td class="text-center  elementPadding">{{$user->name}}</td>
                        <td class="text-center  elementPadding">{{$user->email}}$</td>
                        <td class="text-center  elementPadding">{{$user->cart->id}}</td>
                        <td class="text-center  elementPadding">
                            @foreach($user->cart->item as $item)
                                <ul>
                                    <li> {{$item->name}}</li>
                                    <ul>
                                        <li>{{$item->category->name}}</li>
                                        <li>{{$item->price}}$</li>
                                    </ul>
                                </ul>
                            @endforeach
                        </td>
                        <td></td>
                        <td class="text-center  elementPadding">
                            <a href="/admin/make/admin/{{$user->id}}" style="color:black !important;">make admin</a><br><br>
                            <a href="/admin/delete/user/{{$user->id}}" style="color:black !important;">delete</a> </td>
                    </tr>
                @endforeach
                {{$users->links()}}
                </tbody>
            </table>
            <br>
            <a href="{{Route('admin.panel')}}">Back to admin panel</a>
        </div>
    </div>
@endsection