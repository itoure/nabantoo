@extends('app')

@section('content')

<div id="filters">
    <button type="button" class="btn btn-default btn-sm" data-filter="*">{{trans('messages.all')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".interesting">{{trans('messages.fit_to_me')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".upcoming">{{trans('messages.upcoming')}}</button>
    <button type="button" class="btn btn-primary btn-sm" data-filter=".friends">{{trans('messages.friends')}}</button>
    @foreach ($data->userInterestsList as $interest)
        <button type="button" class="btn btn-default btn-sm" data-filter=".{{$interest}}">{{$interest}}</button>
    @endforeach
</div>

<div class="row top30" id="events-container">
    @foreach ($data->events as $event)
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2 event_id_{{ $event->id }} event-item {{ $event->type }} {{ $event->interest }}">
        <div class="panel {{ $event->class }}">
            <div class="panel-heading txt13">
                <a style="color: black" href="{{action('RendezvousController@getDetails', array('event_id'=> $event->id))}}">{{ $event->title }}</a>
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
                @if ($event->type == 'interesting')
                    <span class="small actions-interesting">
                        <i id="loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                        <a href="#" class="join-event" data-event-id="{{ $event->id }}">{{trans('messages.join')}}</a>
                    </span>
                @elseif ($event->type == 'upcoming')
                    <i class="fa fa-check-square-o fa-2x text-success actions-upcoming"></i>
                @else
                @endif

            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection
