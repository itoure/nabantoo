@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-1 col-md-10">
        <div id="alerts">
            @if (session('welcome'))
            <div id="welcome-alert" class="alert alert-success" role="alert">Welcome to Nabantoo <a class="alert-link" href="{{action('UserController@getAccount')}}">{{$data->user_firstname}}</a> !</div>
            @endif

            @if (session('welcome_back'))
            <div id="welcomeback-alert" class="alert alert-success" role="alert">Welcome back <a class="alert-link" href="{{action('UserController@getAccount')}}">{{$data->user_firstname}}</a> !</div>
            @endif
        </div>

        <h4>Moments List</h4>

        <div id="filters">
            <a role="button" class="btn btn-default btn-sm moments-filter default-filter" data-filter="all">{{trans('messages.all')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="fitToMe">{{trans('messages.fit_to_me')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="aroundMe">{{trans('messages.around_me')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="perfectMatch">{{trans('messages.exact_match')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="myNetwork">My Network</a>
            <a role="button" class="btn btn-default btn-sm moments-filter hide" data-filter="myMoments">My Moments</a>
        </div>
    </div>
</div>

<div class="row top20">
    <div class="col-md-offset-1 col-md-7">
        <div id="eventListHome-loading" class="text-center">
            <i class="fa fa-spinner fa-spin fa-4x"></i>
        </div>
        <ul class="list-group" id="eventListHome"></ul>
    </div>

    <div class="col-md-3">

        <!-- upcoming moments -->
        <div class="panel panel-default">
            <div class="panel-heading small">My upcoming moments</div>
            <div id="myNextEvents-loading" class="text-center top20">
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
            <div id="myNextEvents" class="panel-body">

            </div>
        </div>

    </div>

</div>


<!-- Past moments -->
<h4 class="top40">Past Moments Highlights</h4>
<div id="filters-hl">
    <a role="button" class="btn btn-default btn-sm moments-filter default-filter" data-filter="all">{{trans('messages.all')}}</a>
    <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="fitToMe">Sports</a>
    <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="aroundMe">Outings</a>
    <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="perfectMatch">Games</a>
</div>

<div class="row top30" id="pastMomentsBlock">

    @for ($i = 1; $i < 9; $i++)
    <div class="col-xs-6 col-sm-4 col-md-3 past-moment">
        <div class="thumbnail">
            <img src="http://i.imgur.com/6EYMizr.png" alt="">
            <div class="caption">
                <h5>Moments {{$i}}</h5>
                <p><a href="#" class="btn btn-primary btn-xs" role="button">See photos</a></p>
            </div>
        </div>
    </div>
    @endfor

</div>

@endsection
