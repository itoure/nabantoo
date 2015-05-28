@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-1 col-sm-10 col-md-10 col-xs-10">


        <ul class="media-list well profile-well">
            <li class="media">
                <div class="media-left">
                    @if (!empty($data->user->usr_photo))
                    {!! Html::image('files/user/'.$data->user->usr_photo, '', array('class' => 'img-rounded img-user150')) !!}
                    @else
                    <img class="img-rounded" src="holder.js/150x150?theme=social&text={{ $data->user->usr_first_letter }}" alt="">
                    @endif
                </div>
                <div class="media-body">
                    <dl>
                        <dt class="lead" style="margin-bottom: 0px">
                            <span>{{$data->user->usr_firstname}}</span>

                            @if ($data->user->usr_id != $data->user_id)
                            <span class="text-right">
                                <i id="network-loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                                @if ($data->user->isUserInMyNetwork)
                                <a role="button" class="btn btn-default btn-xs manage-network" data-action="remove" data-user-id="{{$data->user->usr_id}}">Remove network</a>
                                @else
                                <a role="button" class="btn btn-primary btn-xs manage-network" data-action="add" data-user-id="{{$data->user->usr_id}}">Add network</a>
                                @endif
                            </span>
                            @endif
                        </dt>

                        <dd>{{$data->user->usr_location}}</dd>
                        <dd>Interests : {!! implode(', ', $data->user->interests) !!}</dd>
                        <dd><i class="fa fa-trophy"></i> <small class="badge">23</small></dd>

                        @if ($data->user->usr_id == $data->user_id)
                        <dd class="small"><a href="{{action('UserController@getAccount')}}"><i class="fa fa-pencil"></i> edit profile</a></dd>
                        @endif
                    </dl>
                </div>
            </li>
        </ul>

    </div>

    <div class="clearfix"></div>

    <div class="col-md-offset-2 col-md-8">
        <h4>Upcoming Moments</h4>

        @foreach ($data->upcomingEvents as $event)
        <li class="list-group-item event_id_{{ $event->eve_id }} event-item">
            <div class="container-fluid">
                <div class="row row-list">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        @if (!empty($event->eve_photo))
                        {!! Html::image('img/interests/'.$event->eve_photo, '', array('class' => 'img-event-item')) !!}
                        @else
                        <img class="" src="holder.js/100px98?text={{ $event->int_name }}&theme={{$event->cat_color}}" alt="">
                        @endif
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9">
                        <h5 class="list-group-item-heading marg-top5">
                            <a href="{{action('EventController@getDetails', array('event_id'=> $event->eve_id))}}">
                                {{ $event->eve_title }}
                            </a>
                        </h5>
                        <p>
                            <i class="fa fa-calendar"></i> <small>{{ $event->eve_start_date }}</small> |
                            <i class="fa fa-map-marker text-danger"></i> <small>{{ $event->short_locality }}</small> |
                            <i class="fa fa-users text-success"></i> <small>{{ $event->count_people }}</small>
                        </p>
                        <p class="marg-bot5">
                            @if (!empty($event->usr_photo))
                            {!! Html::image('files/user/'.$event->usr_photo, '', array('class' => 'img-user30 img-rounded')) !!}
                            @else
                            <img class="img-rounded" src="holder.js/30x30?text={{ $event->usr_first_letter }}" alt="">
                            @endif
                            <a href="{{action('UserController@getProfile', array('user_id'=> $event->usr_id))}}" class="small">{{ $event->usr_firstname }}</a>

                            <span id="info-item-list" class="pull-right">
                                <i id="join-loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                                <i class="fa fa-thumbs-o-up text-success"></i> going - <a href="">cancel</a>
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        </li>
        @endforeach

        @if (empty($data->upcomingEvents))
        No upcoming moments. <a href="{{action('EventController@getCreate')}}">Create a moment</a>
        @endif

    </div>


    <div class="col-md-offset-2 col-md-8 top20">
        <h4>Host Moments</h4>

        @foreach ($data->hostEvents as $event)
        <li class="list-group-item event_id_{{ $event->eve_id }} event-item">
            <div class="container-fluid">
                <div class="row row-list">
                    <div class="col-xs-3 col-sm-3 col-md-3">
                        @if (!empty($event->eve_photo))
                        {!! Html::image('img/interests/'.$event->eve_photo, '', array('class' => 'img-event-item')) !!}
                        @else
                        <img class="" src="holder.js/100px98?text={{ $event->int_name }}&theme={{$event->cat_color}}" alt="">
                        @endif
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9">
                        <h5 class="list-group-item-heading marg-top5">
                            <a href="{{action('EventController@getDetails', array('event_id'=> $event->eve_id))}}">
                                {{ $event->eve_title }}
                            </a>
                        </h5>
                        <p>
                            <i class="fa fa-calendar"></i> <small>{{ $event->eve_start_date }}</small> |
                            <i class="fa fa-map-marker text-danger"></i> <small>{{ $event->short_locality }}</small> |
                            <i class="fa fa-users text-success"></i> <small>{{ $event->count_people }}</small>
                        </p>
                        <p class="marg-bot5">
                            <span id="info-item-list" class="pull-right">
                                <i id="join-loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                                <i class="fa fa-user text-success"></i> host - <a href="">edit</a>
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        </li>
        @endforeach

        @if (empty($data->hostEvents))
        No host moments. <a href="{{action('EventController@getCreate')}}">Create a moment</a>
        @endif

    </div>


</div>

@endsection
