@extends('Layout.master')

@section('title')
    Making Order
@endsection

@section('link1')
    {{Route('user.getOrder')}}
@endsection

@section('link1_name')
    Make order
@endsection

@section('link2')
    {{Route('dashboard')}}
@endsection

@section('link2_name')
   View items
@endsection

@section('one')
    active
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 alphaBox">
            <form action="{{Route('user.makeOrder')}}" method="post">
                {{csrf_field()}}
                <h1 class="text-center">Making Order</h1>
                <div class="form-group">
                    <label>Item name</label>
                    <input type="text" name="order" class="form-control" placeholder="Type here the name of item you wish to get"><br>
                    <label>Name your order</label>
                    <input type="text" name="order_name" class="form-control" placeholder="type the name of order">
                </div>
                <button type="submit">Submit</button>
            </form>
            </div>
        </div>
    </div>
@endsection
