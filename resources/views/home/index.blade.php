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

        <div id="filters">
            <a role="button" class="btn btn-default btn-sm moments-filter default-filter" data-filter="all">{{trans('messages.all')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="fitToMe">{{trans('messages.fit_to_me')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="aroundMe">{{trans('messages.around_me')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="perfectMatch">{{trans('messages.exact_match')}}</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="myNetwork">My Network</a>
            <a role="button" class="btn btn-default btn-sm moments-filter" data-filter="myMoments">My Moments</a>
        </div>
    </div>
</div>

<div class="row top20">
    <div class="col-md-offset-1 col-md-7">
        <div id="eventListHome-loading" class="text-center">
            <i class="fa fa-spinner fa-spin fa-4x"></i>
        </div>
        <ul class="list-group" id="eventListHome"></ul>



        <!-- Past moments -->
        <h4 class="top40">Past Moments Highlights</h4>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="holder.js/100px100" alt="">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="holder.js/100px100?text=" alt="">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="holder.js/100px100?text=" alt="">
                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-primary" role="button">Button</a></p>
                    </div>
                </div>
            </div>
        </div>
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


@endsection
