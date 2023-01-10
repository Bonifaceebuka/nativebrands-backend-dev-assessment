@extends('layouts.user') 
@section('title') Feed @endsection
 @php 
 $BaseController = new \App\Http\Controllers\BaseController();
@endphp 
@section('content')
    <div class="view-wrapper">
        <!-- Container -->
        <div id="main-feed" class="container">
    @include('user._components.feed_placeholder')
            <!-- Feed page main wrapper -->
            <div id="activity-feed" class="view-wrap true-dom is-hidden">
                <div class="columns">
    @include('user._components.feed_left_sidebar')

                    <!-- Middle column -->
                    <div class="column is-6">
    @include('user._components.feed_new_post')
    @include('user._components.post-types.texts-and-image')
    @include('user._components.post-types.texts-and-links')
    @include('user._components.post-types.texts-and-image-gallery')
    @include('user._components.post-types.texts-only')
                        <!-- Load more posts -->
                        <div class=" load-more-wrap narrow-top has-text-centered">
                            <a href="#" class="load-more-button">Load More</a>
                        </div>
                        <!-- /Load more posts -->

                    </div>
                    <!-- /Middle column -->
    @include('user._components.feed_right_sidebar')
                </div>
            </div>
            <!-- /Feed page main wrapper -->
        </div>
        <!-- /Container -->
    @include('user._components.new-group')
    @include('user._components.new-album')
    @include('user._components.live-video')
        <!-- Google places Lib -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyAGLO_M5VT7BsVdjMjciKoH1fFJWWdhDPU&libraries=places"></script>
    </div>
    @include('user._components.chats')
    @include('user._components.explore-nav')
    @include('user._components.end-tour')
@endsection

    
@section('extra-js')
    <script src="/assets/js/feed.js"></script>
    <script src="/assets/js/webcam.js"></script>
    <script src="/assets/js/compose.js"></script>
    <script src="/assets/js/autocompletes.js"></script>
@endsection