@extends('app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-justified home-tabs">
            <li role="presentation" class="active"><a href="#interesting" data-tab="interesting">My Events</a></li>
            <li role="presentation"><a href="#upcomming" data-tab="upcomming">Network Events</a></li>
        </ul>

        <div class="tab-content top20">
            <div role="tabpanel" class="tab-pane active" id="interesting">
                <ul class="media-list">
                    @foreach ($data->my_events as $event)
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="holder.js/75x50/vine" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <a href="{{action('EventController@getDetails', array('event_id'=> $event->id))}}">{{ $event->title }} @ {{ $event->location }}</a>
                                by <a href="">{{ $event->event_owner }}</a>
                            </h5>
                            <span class="hide label label-success">Yep!</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane top20" id="upcomming">Network Events</div>
        </div>

    </div>
</div>


<div class="top50" id="filters">
    <h3>Discover the Events</h3>
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.all')}}</button>
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.today')}}</button>
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.tomorrow')}}</button>
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.this_week')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".fitToMe">{{trans('messages.fit_to_me')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".aroundMe">{{trans('messages.around_me')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".aroundMe.fitToMe">{{trans('messages.exact_match')}}</button>
</div>

<div class="row top30" id="events-container">
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
