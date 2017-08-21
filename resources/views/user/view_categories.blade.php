@extends('Layout.master')

@section('title')
    View Categories
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

@section('two')
    active
@endsection

@section('content')
    <div class="container-fluid alphaBox">
        <div class="col-md-8 col-md-offset-3">
            @if(Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <table class="table-bordered table-striped center txt-size">
                <thead style="background-color:#23527c; color:white">
                <th class="text-center elementPadding">ID</th>
                <th class="text-center elementPadding">Category</th>
                <th class="text-center elementPadding">Items of category</th>
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
                    </tr>
                @endforeach
                {{$categories->links()}}
                </tbody>
            </table>
        </div>
    </div>
@endsection