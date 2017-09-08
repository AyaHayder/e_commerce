<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ url('/css/main.css') }}">
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
         <img src="/../../images/ecommerce.png" class="img-responsive logo" >
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="@yield('one')"><a href="@yield('link1')">@yield('link1_name')</a></li>
                <li class="@yield('two')"><a href="@yield('link2')">@yield('link2_name')</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="/user/dashboard/search" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for item name">
                </div>
                <button type="submit" name="search_by_name" class="btn btn-default">Search</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                    <li><img src="/../../images/634483-SEO_Audit-512.png" class="img-responsive logo"></li>
                    <li class="@yield('admin')"><a href="{{Route('admin.getLogin')}}">Admin panel</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acounts <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(!Auth::user())
                            <li><a href="/user/register">Sign up</a></li>
                            <li><a href="/user/login">Sign in</a></li>
                        @else
                                <li><a href="{{Route('user.profile')}}">View profile</a> </li>
                                <li><a href="{{Route('user.logout')}}">Log out</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

@yield('content')

<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>