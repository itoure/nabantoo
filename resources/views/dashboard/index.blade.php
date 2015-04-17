@extends('app')

@section('content')

<div id="filters">
    <button type="button" class="btn btn-success" data-filter="*">All</button>
    <button type="button" class="btn btn-info" data-filter=".interesting">Fit To Me</button>
    <button type="button" class="btn btn-primary" data-filter=".upcoming">My Next Events</button>
    <button type="button" class="btn btn-warning" data-filter=".friends">Friends</button>
    @foreach ($data->userInterestsList as $interest)
        <button type="button" class="btn btn-default" data-filter=".{{$interest}}">{{$interest}}</button>
    @endforeach
</div>

<div class="row top30" id="events-container">
    @foreach ($data->events as $event)
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2 event_id_{{ $event->id }} event-item {{ $event->type }} {{ $event->interest }}">
        <div class="panel {{ $event->class }}">
            <div class="panel-heading txt13">
                <a style="color: black" href="{{action('RendezvousController@getDetails', array('event_id'=> $event->id))}}">{{ $event->title }}</a>
            </div>
                <img src="holder.js/100%x100" alt="">
            <div class="panel-body" style="padding: 10px">
                <p><i class="fa fa-map-marker text-danger"></i> <small>{{ $event->location }}</small></p>
                <p><i class="fa fa-calendar"></i> <small>{{ $event->start_date }}</small></p>
                <p><i class="fa fa-paperclip"></i> <small>{{ $event->interest }}</small></p>
            </div>
            <div class="panel-footer" style="padding: 10px">
                <span class="small"><img class="img-rounded align-with-text" src="holder.js/30x30/lava/text:P" alt=""> <a href="">{{ $event->event_owner }}</a></span>

                @if ($event->type == 'interesting')
                    <span class="small pull-right actions-interesting">
                        <i id="loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                        <a href="#" class="join-event" data-event-id="{{ $event->id }}">Join</a>
                    </span>
                @elseif ($event->type == 'upcoming')
                    <i class="pull-right fa fa-check-square-o fa-2x text-success actions-upcoming"></i>
                @else
                @endif

            </div>
        </div>
    </div>
    @endforeach
</div>


<div class="row hide">
    <div class="col-md-offset-1 col-md-10">
        <ul class="nav nav-tabs home-tabs">
            <li role="presentation" class="active"><a href="#interesting" data-tab="interesting">Might Be Interesting</a></li>
            <li role="presentation"><a href="#upcomming" data-tab="upcomming">My Upcoming RendezVous</a></li>
            <li role="presentation"><a href="#friends" data-tab="friends">Friends RendezVous</a></li>
        </ul>

        <div class="tab-content top20">
            <div role="tabpanel" class="tab-pane active" id="interesting">
                <ul class="media-list">
                    @foreach ($data->events as $event)
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="holder.js/150x100/vine" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">
                                <a href="{{action('RendezvousController@getDetails', array('event_id'=> $event->id))}}">{{ $event->title }} @ {{ $event->location }}</a>
                                by <a href="">{{ $event->event_owner }}</a>
                                <img class="align-with-text" src="holder.js/30x30/social" alt="">
                            </h5>
                            {{ $event->details }}
                            <div><img id="spinner" class="" src="/img/spinner2.gif" alt="" width="15px" style="display: none"> <small><a href="#" class="join-event" data-event-id="{{ $event->id }}">Join</a> - <a href="">Like</a></small></div>
                            <span class="hide label label-success">Yep!</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane top20" id="upcomming">My Upcoming RendezVous</div>
            <div role="tabpanel" class="tab-pane top20" id="friends">Friends RendezVous</div>
        </div>

    </div>
</div>


@endsection
