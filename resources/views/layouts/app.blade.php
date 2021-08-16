@if ($ajax == false)
<!DOCTYPE html>
<html class="loading" lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name') }}</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('icons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('icons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('icons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('icons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('icons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('icons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('icons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('icons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('icons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('icons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/pages/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/toggle/switchery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/droidkufi-regular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="vertical-layout vertical-overlay-menu 2-columns bg-full-screen-image menu-expanded fixed-navbar" id="keyboard">
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-dark navbar-shadow navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{route('dashboard')}}">
                        <img class="brand-logo" src="{{ asset('icons/favicon-32x32.png') }}" height="27">
                        <h2 class="brand-text">{{ config('app.name') }}</h2>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                            <i class="fa fa-ellipsis-v"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link nav-link-expand" href="#">
                                <i class="ficon ft-maximize"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                <img src="{{ asset('icons/apple-icon-180x180.png') }}"><i></i>
                            </span>
                            <span class="user-name">
                                {{ Auth()->user()->name }}
                            </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="user-profile.html">
                                    <i class="ft-user"></i> تحديث المعلومات
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('logout')}}">
                                    <i class="ft-power"></i> تسجيل الخروج
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="col-md-12 col-12 mb-2 text-center">
                    <button type="button" class="btn btn-float btn-float-lg btn-pink" id="urlChange" data-url="{{route('dashboard')}}">
                        <i class="fa fa-home"></i>
                        <span>الصفحة الرئيسية</span>
                    </button>
                    <button type="button" class="btn btn-float btn-float-lg btn-blue buttonChange" id="urlChange" data-url="{{route('ticket', 0)}}">
                        <i class="fa fa-cart-plus"></i>
                        <span>تذكرة جديدة (F1)</span>
                    </button>
                    <button type="button" class="btn btn-float btn-float-lg btn-red" id="urlChange" data-url="{{route('tickets')}}">
                        <i class="fa fa-shopping-cart"></i>
                        <span>قائمة التذاكر</span>
                    </button>
                    <button type="button" class="btn btn-float btn-float-lg btn-warning" id="urlChange" data-url="{{route('addedititem', 0)}}">
                        <i class="fa fa-plus"></i>
                        <span>إضافة سلعة</span>
                    </button>
                    <button type="button" class="btn btn-float btn-float-lg btn-teal" id="urlChange" data-url="{{route('items')}}">
                        <i class="fa fa-tags"></i>
                        <span>قائمة السلع</span>
                    </button>
                </div>
            </div>
            <div class="content-body" id="pageContents">
            @endif
                @yield('content')
            @if ($ajax == false)
            </div>
        </div>
    </div>
    <footer class="footer footer-static footer-light navbar-border">
        <p class="clearfix blue-black lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">
                &copy; {{ date('Y') }} - {{ config('app.name') }} .
            </span>
            <span class="float-md-right d-block d-md-inline-block d-none d-lg-block">
                برمجة وتصميم
                <i class="ft-heart pink"></i> 
                عصام نجار
            </span>
        </p>
    </footer>
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/ajax.js') }}?v=hh" type="text/javascript"></script>
</body>
</html>
@endif