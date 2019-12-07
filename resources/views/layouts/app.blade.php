<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{asset('assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/loaders/blockui.min.js')}}"></script>
    @yield('head_assets')
</head>

<body>
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href=""></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="{{route('cart')}}">
                        <i class="icon-cart5"></i>
                        <span class="visible-xs-inline-block position-right">Messages</span>
                        <span class="badge bg-warning-400" id="basket"></span>
                        @if(Session::get('basket') != [])
                            <span class="badge bg-warning-400">*</span>
                        @endif
                    </a>
                </li>

                @guest
                    <li>
                        <a href="{{route('login')}}">
                            <span>Login / Register</span>
                        </a>
                    </li>
                @else
                    <li class="dropdown dropdown-user">

                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <span>{{Auth::user()->name}}</span>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="{{url('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    <i class="icon-switch2"></i> Logout</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>

<div class="page-container">

    <div class="page-content">


        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">
                            <!-- Main -->
                            <li class="navigation-header"><span>Home Page</span> <i class="icon-menu" title="Main pages"></i></li>
                            <li  @if((\Route::current()->getName() == 'home') || (\Route::current()->getName() == 'cart')) class="active" @endif id="dashboard">
                                <a href="{{url('/')}}"><i class="icon-home2"></i><span>Home Page</span></a>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
        @yield('content')
    </div>
</div>
@include('partials.messages')
@include('partials.footer')
@yield('local_scripts')
</body>
</html>
