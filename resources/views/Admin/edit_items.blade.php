@extends('Layout.master')

@section('title')
    {{$user->first_name}} Admin Panel/edit items
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
        <div class="col-md-6 col-md-offset-3">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <table class="table-bordered table-striped center txt-size">
                <thead style="background-color:#23527c; color:white">
                <th class="text-center elementPadding">ID</th>
                <th class="text-center elementPadding">Name</th>
                <th class="text-center elementPadding">Price</th>
                <th class="text-center elementPadding">Category</th>
                <th class="text-center elementPadding">Image</th>
                <th class="text-center elementPadding">Edit Items</th>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="text-center  elementPadding">{{$item->id}}</td>
                        <td class="text-center  elementPadding">{{$item->name}}</td>
                        <td class="text-center  elementPadding">{{$item->price}}$</td>
                        <td class="text-center  elementPadding">{{$item->category->name}}</td>
                        <td class="text-center  elementPadding"><img src="{{$item->image_path}}" class="img-responsive "></td>
                        <td class="text-center  elementPadding">
                            <a href="/admin/update/item/{{$item->id}}" style="color:black !important;">update</a><br>
                            <a href="/admin/delete/item/{{$item->id}}" style="color:black !important;">delete</a> </td>
                    </tr>
                @endforeach
                {{$items->links()}}
                </tbody>
            </table>
            <br>
            <form action="{{Route('get.addItem')}}" method="get">
                <div class="form-group">
                    <button type="submit">Add item</button>
                </div>
            </form>
            <a href="{{Route('admin.panel')}}">Back to admin panel</a>
        </div>
    </div>
@endsection