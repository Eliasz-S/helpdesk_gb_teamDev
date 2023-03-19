<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>@section('title') | Helpdesk @show</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin/css/styles.css') }}" rel="stylesheet"/>
    {{--  <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
</head>

<body class="g-sidenav-show  bg-gray-100">

<div id="app-vue">

    @include('layouts.navbar-left')

    <main class="main-content position-relative mt-1 border-radius-lg ps">

        @include('layouts.navbar-top')

        <div class="container-fluid py-4">
            <div class="row">
                {{--            <div id="app"></div>--}}
                <router-view></router-view>
            </div>

            {{--        @yield('content')--}}
        </div>

    </main>

</div>

</body>

<!--   Vue   -->
<script src="{{ asset('js/manifest.js') }}" defer></script>
<script src="{{ asset('js/vendor.js') }}" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>

<!--   Core JS Files   -->
<script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
{{--  <script src="{{ asset('admin/plugins/chartjs.min.js') }}"></script>--}}
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('admin/js/soft-ui-dashboard.min.js') }}"></script>
@stack('js')

</html>
