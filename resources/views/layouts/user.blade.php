<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="icon" type="image/png" href="assets\img\favicon.png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- Core CSS -->
    <link rel="stylesheet" href="assets\css\app.css">
    <link rel="stylesheet" href="assets\css\core.css">
    @section('extra-styles')
    @show()
</head>
@php
$BaseController = new \App\Http\Controllers\BaseController();
@endphp
<body>
<!--Preloader -->
@include('user._components.preloader')
<!--PC Nav -->
@include('user._components.main_nav',['BaseController'=>$BaseController])
<!--Mobile Nav -->
@include('user._components.mobile_nav',['BaseController'=>$BaseController])
<!--Content -->
@section('content')
@show()

    <!-- Concatenated js plugins and jQuery -->
    <script src="assets\js\app.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="assets\data\tipuedrop_content.js"></script>

    <!-- Core js -->
    <script src="assets\js\global.js"></script>

    <!-- Navigation options js -->
    <script src="assets\js\navbar-v1.js"></script>
    <script src="assets\js\navbar-v2.js"></script>
    <script src="assets\js\navbar-mobile.js"></script>
    <script src="assets\js\navbar-options.js"></script>
    <script src="assets\js\sidebar-v1.js"></script>

    <!-- Core instance js -->
    <script src="assets\js\main.js"></script>
    <script src="assets\js\chat.js"></script>
    <script src="assets\js\touch.js"></script>
    <script src="assets\js\tour.js"></script>

    <!-- Components js -->
    <script src="assets\js\explorer.js"></script>
    <script src="assets\js\widgets.js"></script>
    <script src="assets\js\modal-uploader.js"></script>
    <script src="assets\js\popovers-users.js"></script>
    <script src="assets\js\popovers-pages.js"></script>
    <script src="assets\js\lightbox.js"></script>
    <script src="{{asset('/assets/js/custom/functions.js')}}"></script>
    <script src="assets\js\settings.js"></script>
 <!-- profile js -->
 <script src="assets/js/profile.js"></script>
    @section('extra-js')
    @show()
</body>

</html>