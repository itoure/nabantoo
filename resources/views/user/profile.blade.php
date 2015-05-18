@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-1 col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading panel-title">
                @if (!empty($data->user->usr_photo))
                {!! Html::image('files/user/'.$data->user->usr_photo, '', array('class' => 'img-rounded img-user50')) !!}
                @else
                <img class="img-circle" src="holder.js/50x50?theme=social&text={{ $data->user->usr_first_letter }}" alt="">
                @endif

                {{$data->user->usr_firstname}}
            </div>
            <div class="panel-body">
                <dl>
                    <dt>{{$data->user->usr_location}}</dt>
                    <dt>Interests : {!! implode(', ', $data->user->interests) !!}</dt>
                </dl>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">Calendar</div>
            <div class="panel-body">
                <ul class="media-list">
                    @foreach ($data->upcomingEvents as $event)
                    <li class="media">
                        <div class="media-left">
                            @if (!empty($event->eve_photo))
                            {!! Html::image('img/interests/'.$event->eve_photo, '', array('class' => 'img-event-item media-object')) !!}
                            @else
                            <img class="media-object" src="holder.js/75x75?text={{ $event->int_name }}&theme={{$event->cat_color}}" alt="">
                            @endif
                        </div>
                        <div class="media-body">
                            <a class="small" href="{{action('EventController@getDetails', array('event_id'=> $event->eve_id))}}">
                                {{ $event->eve_title }}
                            </a>
                            <p><i class="fa fa-calendar small"></i> <small>{{ $event->eve_start_date }}</small></p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                @if (empty($data->upcomingEvents))
                No upcoming events
                @endif
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">Events Host</div>
            <div class="panel-body">
                <ul class="media-list">
                    @foreach ($data->hostEvents as $event)
                    <li class="media">
                        <div class="media-left">
                            @if (!empty($event->eve_photo))
                            {!! Html::image('img/interests/'.$event->eve_photo, '', array('class' => 'img-event-item media-object')) !!}
                            @else
                            <img class="media-object" src="holder.js/75x75?text={{ $event->int_name }}&theme={{$event->cat_color}}" alt="">
                            @endif
                        </div>
                        <div class="media-body">
                            <a class="small" href="{{action('EventController@getDetails', array('event_id'=> $event->eve_id))}}">
                                {{ $event->eve_title }}
                            </a>
                            <p><i class="fa fa-calendar small"></i> <small>{{ $event->eve_start_date }}</small></p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                @if (empty($data->hostEvents))
                No host events
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
