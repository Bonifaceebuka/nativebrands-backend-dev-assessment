<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading" 
  lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ config('app.name') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="TACC Group">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/default/tacc-logo.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/css/extensions/pace.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.css')}}">
    <link rel="')}}stylesheet" type="text/css" href="{{asset('assets/css/colors.css')}}">
    <!-- END ROBUST CSS'-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/core/menu/menu-types/vertical-overlay-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/core/colors/palette-gradient.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}"> --}}
    <!-- END Custom CSS-->
    <style>
    .header-navbar.navbar-semi-dark .navbar-nav .nav-link.logo {
    color: #55595c;
    font-weight: bold;
    color: #fff;
    text-decoration: underline;
    font-size: 26;
    }
    .helper-text{
            font-weight: 100;
            color: red;
        }
      .video-thumb.img-responsive {
        max-width: 100px;
      }
    </style>
    @section('extra-styles')
    @show()
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" 
  class="vertical-layout vertical-menu 2-columns  fixed-navbar">

  @include('admin.partials.nav-bar');    
  @include('admin.partials.main-menu');    
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->

    <div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @section('content')
            @show()
        </div>
      </div>
    </div>
    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2">
        <span class="float-md-left d-xs-block d-md-inline-block">
          Copyright  &copy; {{date("Y")}} <a href="#" target="_blank" 
          class="text-bold-800 grey darken-2">{{ config('app.name') }}</a>, All rights reserved. </span>
          <span class="float-md-right d-xs-block d-md-inline-block">Proudly Sponsored By TACC Group With <i class="icon-heart5 pink"></i></span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
   <script src="{{asset('assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('assets/vendors/js/ui/tether.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
   {{-- <script src="{{asset('assets/vendors/js/ui/perfect-scrollbar.jquery.min.js')}}" 
   type="text/javascript"></script>--}}
   <script src="{{asset('assets/vendors/js/ui/unison.min.js')}}" type="text/javascript"></script>
   {{-- <script src="{{asset('assets/vendors/js/ui/blockUI.min.js')}}" type="text/javascript"></script> --}}
   <script src="{{asset('assets/vendors/js/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
   <script src="{{asset('assets/vendors/js/ui/screenfull.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
   <!-- BEGIN VENDOR JS-->
   <!-- BEGIN PAGE VENDOR JS-->
   {{-- <script src="{{asset('assets/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script> --}}
   <!-- END PAGE VENDOR JS-->
   <!-- BEGIN ROBUST JS-->
   <script src="{{asset('assets/js/core/app-menu.js')}}" type="text/javascript"></script>
   <script src="{{asset('assets/js/core/app.js')}}" type="text/javascript"></script>
   <!-- END ROBUST JS-->
   <!-- BEGIN PAGE LEVEL JS-->
   <!-- END PAGE LEVEL JS-->
    @section('extra-script')
    @show()
  </body>
</html>
