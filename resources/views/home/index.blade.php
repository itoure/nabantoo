@extends('app')

@section('content')

<div id="filters">
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.all')}}</button>
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.today')}}</button>
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.tomorrow')}}</button>
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.this_week')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".fitToMe">{{trans('messages.fit_to_me')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".aroundMe">{{trans('messages.around_me')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".aroundMe.fitToMe">{{trans('messages.exact_match')}}</button>
</div>

<div class="row top30 " id="events-container">
    @foreach ($data->events as $event)
    <div class="col-xs-6 col-sm-3 col-md-2 event_id_{{ $event->id }} event-item {{ $event->fitToMe ? 'fitToMe' : '' }} {{ $event->aroundMe ? 'aroundMe' : '' }}">
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
