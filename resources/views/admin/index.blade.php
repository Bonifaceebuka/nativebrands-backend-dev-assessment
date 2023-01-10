@extends('admin.layouts.app')
@section('title')
Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-2 text-xs-center bg-cyan bg-darken-2 media-left media-middle">
                        <i class="icon-video font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-cyan white media-body">
                        <h5>Videos</h5>
                        <h5 class="text-bold-400">{{number_format($Totalvideos)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-2 text-xs-center bg-deep-orange bg-darken-2 media-left media-middle">
                        <i class="icon-users font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-deep-orange white media-body">
                        <h5>Users</h5>
                    <h5 class="text-bold-400">{{number_format($users)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-2 text-xs-center bg-teal bg-darken-2 media-left media-middle">
                        <i class="icon-cart font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-teal white media-body">
                        <h5>Plans</h5>
                        <h5 class="text-bold-400">{{number_format($plans)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="media">
                    <div class="p-2 text-xs-center bg-pink bg-darken-2 media-left media-middle">
                        <i class="icon-banknote font-large-2 white"></i>
                    </div>
                    <div class="p-2 bg-pink white media-body">
                        <h5>Subscriptions</h5>
                        <h5 class="text-bold-400">{{number_format($subscriptions)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Statistics -->
<!-- projects table with monthly chart -->
<div class="row">
    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Videos</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if($Totalvideos !== 0)
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Poster</th>
                                <th>Title</th>
                                <th>Posted By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                    @foreach($videos as $video)
                                    <tr>
                                       
                                        <th scope="row">{{$i++}}</th>
                                        <td>
                                            <a href="{{route('admin.videos.edit',$video->id)}}">
                                                <img src="{{$video->poster}}" class="video-thumb img-responsive" alt=""/>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.videos.edit',$video->id)}}">
                                                {{$video->title}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.videos.edit',$video->id)}}">
                                                {{ucfirst($video->user->first_name)}}
                                            </a>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="well">No Videos Found!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card bg-cyan">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-left media-middle">
                            <i class="icon-tag white font-large-2 float-xs-left"></i>
                        </div>
                        <div class="media-body white text-xs-right">
                            <h3>{{number_format($categories)}}</h3>
                            <span>Categories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card bg-deep-orange">
            <div class="card-body">
                <div class="card-block">
                    <div class="media">
                        <div class="media-left media-middle">
                            <i class="icon-comments white font-large-2 float-xs-left"></i>
                        </div>
                        <div class="media-body white text-xs-right">
                            <h3>{{number_format($comments)}}</h3>
                            <span>Comments</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ projects table with monthly chart -->
@endsection()