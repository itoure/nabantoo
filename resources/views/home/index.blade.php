@extends('app')

@section('content')

<div class="" style="border-bottom: 1px solid #d0d1d5">
    <ul class="list-inline text-right">
        <li><a href="">action 1</a></li>
        <li><a href="">action 2</a></li>
        <li><a href="">action 3</a></li>
    </ul>
</div>

<div class="row top20">
    <div class="col-md-12">
        <div id="alerts">
            @if (session('welcome'))
            <div id="welcome-alert" class="alert alert-success" role="alert">Welcome to Nabantoo <a class="alert-link" href="{{action('UserController@getAccount')}}">{{$data->user_firstname}}</a> !</div>
            @endif

            @if (session('welcome_back'))
            <div id="welcomeback-alert" class="alert alert-success" role="alert">Welcome back <a class="alert-link" href="{{action('UserController@getAccount')}}">{{$data->user_firstname}}</a> !</div>
            @endif
        </div>

        <div id="filters">
            <a role="button" class="btn btn-info btn-xs moments-filter" data-filter="all">All Upcoming</a>
            <a role="button" class="btn btn-default btn-xs moments-filter" data-filter="myMoments">My Upcoming Moments</a>
            <a role="button" class="btn btn-default btn-xs moments-filter" data-filter="myNetwork">My Network</a>
            <a role="button" class="btn btn-default btn-xs moments-filter hide" data-filter="fitToMe">{{trans('messages.fit_to_me')}}</a>
            <a role="button" class="btn btn-default btn-xs moments-filter hide" data-filter="aroundMe">{{trans('messages.around_me')}}</a>
            <a role="button" class="btn btn-default btn-xs moments-filter" data-filter="perfectMatch">Suggested</a>
        </div>
    </div>
</div>

<div class="row top20">
    <div class="col-md-8">
        <div id="eventListHome-loading" class="text-center">
            <i class="fa fa-spinner fa-spin fa-4x"></i>
        </div>
        <ul class="list-group" id="eventListHome"></ul>
    </div>

    <div class="col-md-4">

        <!-- upcoming moments -->
        <div class="panel panel-default">
            <div class="panel-heading small">My Upcoming</div>
            <div id="myUpcomingMoments-loading" class="text-center top20">
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
            <div id="myUpcomingMoments" class="panel-body">

            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading small">Suggested</div>
            <div id="mySuggestedMoments-loading" class="text-center top20">
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
            <div id="mySuggestedMoments" class="panel-body">

            </div>
        </div>


        <div class="panel panel-default hide">
            <div class="panel-heading small">Popular</div>
            <div id="" class="panel-body">

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
            <img src="http://startupstacks.com/wp-content/uploads/2013/12/Everyday_Birthday_Flyer.png" alt="">
            <div class="caption">
                <h5>Moments {{$i}}</h5>
                <p><a href="#" class="btn btn-primary btn-xs" role="button">See photos</a></p>
            </div>
        </div>
    </div>
    @endfor

</div>

@endsection
