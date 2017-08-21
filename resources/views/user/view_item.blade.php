@extends('Layout.master')

@section('link1')
    {{Route('user.getOrder')}}
@endsection

@section('link1_name')
    Make order
@endsection

@section('link2')
    {{--
    I'm getting '$link' from the sortByPrice method in the ItemController,
    normally when you press on the 'view by price' link before accessing
    the page it'll go to sortByOrder method where it will create the '$link' and pass it by to this page
    so if the link is pressed then show '$link' which tells you to return to the Normal view instead of
    the view by price.
    all well all good :)
    --}}
    @if(isset($link))
            {{$link}}
        @else
        {{Route('item.sortByPrice')}}
    @endif
@endsection

@section('link2_name')
    {{--
    the same as the story above, you are free to read it again if you wish to, but just change all '$link' with
    '$linkName' cz I won't re-write it.
     --}}
    @if(isset($linkName))
        {{$linkName}}
    @else
    view by price
    @endif
@endsection

@section('two')
    active
@endsection

@section('title')
    View Items
@endsection

@section('content')
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2 alphaBox">
                <h1 class="text-center">Available Items</h1>
            </div>
        </div>
            <br><br>
        <div class="row">
            @foreach($items as $item)
                <div class="col-md-2 col-md-push-3">
                    <div class="thumbnail">
                        <img src="{{$item->image_path}}" class="img-responsive" style="height: 250px">
                        <div class="caption">
                            <h3> {{$item->name}}</h3>
                            <p>
                                Price: {{$item->price}}$ <br>
                                Category: {{$item->category->name}}<br>
                            </p>
                            <p><a href="/user/add_to_cart/{{$item->id}}/{{$user->cart->id}}" class="btn btn-primary" role="button">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
                <br><br>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        {{$items->links()}}
                    </div>
                </div>
        </div>
    </div>

@endsection