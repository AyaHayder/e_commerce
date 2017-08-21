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
    <div class="container-fluid alphaBox">
        <div class="col-md-8 col-md-offset-2">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <table class="table-bordered table-striped center txt-size">
                <thead style="background-color:#23527c; color:white">
                    <th class="text-center elementPadding">ID</th>
                    <th class="text-center elementPadding">Category</th>
                    <th class="text-center elementPadding">Items of category</th>
                    <th class="text-center elementPadding">Edit categories</th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center  elementPadding">{{$category->id}}</td>
                            <td class="text-center  elementPadding">{{$category->name}}</td>
                            <td class="text-center  elementPadding">
                                <ul>
                                    @foreach($category->item as $item)
                                        <li>{{$item->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center  elementPadding">
                                <a href="/admin/update/category/{{$category->id}}">update</a> /
                                <a href="/admin/delete/category/{{$category->id}}">delete</a> </td>
                        </tr>
                    @endforeach
                {{$categories->links()}}
                </tbody>
            </table>
                <br>
            <form action="{{Route('add.cat')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Add category</label>
                    <input type="text" name="add_cat" placeholder="name">
                    <button type="submit">Add</button>
                </div>
            </form>
            <a href="{{Route('admin.panel')}}">Back to admin panel</a>
        </div>
    </div>
    @endsection