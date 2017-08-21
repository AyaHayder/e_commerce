@extends('Layout.master')

@section('title')
    Profile: {{$user->first_name}}
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
            <div class="col-md-8 col-md-offset-2 alphaBox">
                @if(Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <h1 class="text-center">Profile: {{$user->full_name}}</h1>
            </div>
            <div class="col-md-8 col-md-offset-2 alphaBox">
               <span class="txt-size"><span style="font-weight: bold">Email address:</span>  {{$user->email}}</span>
            </div>
            <div class="col-md-8 col-md-offset-2 alphaBox">
                <span class="txt-size"><span style="font-weight: bold">Cart ID:</span>  {{$user->cart->id}}</span>
            </div>
            <div class="col-md-8 col-md-offset-2 alphaBox">
                <span class="txt-size"><span style="font-weight: bold">Cart contents:</span><br>
                        @foreach($user->cart->item as $item)
                            <ul>
                               <li>{{$item->name}}</li>
                                <ul>
                                    <li>Category: {{$item->category->name}}</li>
                                    <li>Price: {{$item->price}}$</li>
                                </ul>
                            </ul>
                        @endforeach
                </span>
                <span class="txt-size"><span style="font-weight: bold">Orders:</span><br>
                    @foreach($user->cart->order as $order)
                                <li>{{$order->name}}</li>
                        @endforeach

                </span>
            </div>
        </div>
    </div>
@endsection