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
            <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.all')}}</button>
            <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.today')}}</button>
            <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.tomorrow')}}</button>
            <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.this_week')}}</button>
            <button type="button" class="btn btn-default btn-sm" data-filter=".fitToMe">{{trans('messages.fit_to_me')}}</button>
            <button type="button" class="btn btn-default btn-sm" data-filter=".aroundMe">{{trans('messages.around_me')}}</button>
            <button type="button" class="btn btn-default btn-sm" data-filter=".aroundMe.fitToMe">{{trans('messages.exact_match')}}</button>
        </div>
    </div>
</div>

<div class="row top20">
    <div class="col-md-offset-1 col-md-7">

        <ul class="list-group" id="">
            @foreach ($data->events as $event)
            <li class="list-group-item event_id_{{ $event->id }} event-item {{ $event->fitToMe ? 'fitToMe' : '' }} {{ $event->aroundMe ? 'aroundMe' : '' }}">
                <div class="container-fluid">
                    <div class="row row-list">
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            @if (!empty($event->img_interest))
                            {!! Html::image('img/interests/'.$event->img_interest, '', array('class' => 'img-event-item img-rounded')) !!}
                            @else
                            <img src="holder.js/100x100" alt="">
                            @endif
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10">
                            <h4 class="list-group-item-heading">
                                <a href="{{action('EventController@getDetails', array('event_id'=> $event->id))}}">
                                    {{ $event->title }}
                                </a>
                            </h4>
                            <p>
                                <i class="fa fa-map-marker text-danger"></i> <small>{{ $event->location }}</small> |
                                <i class="fa fa-calendar"></i> <small>{{ $event->start_date }}</small> |
                                <i class="fa fa-tag"></i> <small>{{ $event->interest }}</small>
                            </p>
                            <p>
                                {!! Html::image('files/user/'.$event->usr_photo, '', array('class' => 'img-user30 img-rounded')) !!} <a href="" class="small">{{ $event->event_owner }}</a>
                                <span class="pull-right">
                                    <i id="join-loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                                    <a href="#" class="join-event small" data-event-id="{{ $event->id }}">{{trans('messages.join')}}</a>
                                </span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            @endforeach
        </ul>

    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">My next events</div>
            <div id="myNextEvents-loading" class="text-center top20">
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
            <div id="myNextEvents" class="panel-body">

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Events from my network</div>
            <div class="panel-body">
            </div>
        </div>

    </div>

</div>


<div class="row top30 hide" id="events-container">
    @foreach ($data->events as $event)
    <div class="col-md-2 event_id_{{ $event->id }} event-item {{ $event->fitToMe ? 'fitToMe' : '' }} {{ $event->aroundMe ? 'aroundMe' : '' }}">
        <div class="panel panel-default">
            <div class="panel-heading txt13">
                <a href="{{action('EventController@getDetails', array('event_id'=> $event->id))}}">{{ $event->title }}</a>
            </div>

                @if (!empty($event->img_interest))
                    {!! Html::image('img/interests/'.$event->img_interest, '', array('class' => 'img-event-item')) !!}
                @else
                    <img src="holder.js/100%x100" alt="">
                @endif

            <div class="panel-body" style="padding: 10px">
                <p><i class="fa fa-map-marker text-danger"></i> <small>{{ $event->location }}</small></p>
                <p><i class="fa fa-calendar"></i> <small>{{ $event->start_date }}</small></p>
                <p><i class="fa fa-paperclip"></i> <small>{{ $event->interest }}</small></p>
                <p class="no-margin-bottom">
                    {!! Html::image('files/user/'.$event->usr_photo, '', array('class' => 'img-user30 img-rounded')) !!} <a href="" class="small">{{ $event->event_owner }}</a>
                </p>
            </div>
            <div class="panel-footer align-right" style="padding: 10px">
                <span class="small actions-interesting">
                    <i id="loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                    <a href="#" class="join-event" data-event-id="{{ $event->id }}">{{trans('messages.join')}}</a>
                </span>
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection
