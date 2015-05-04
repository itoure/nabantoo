@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-1 col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">Profile</div>
            <div class="panel-body">
                {!! Html::image('files/user/'.$data->user->usr_photo, '', array('class' => 'img-rounded img-user50')) !!}
                <h3>{{$data->user->firstname}}</h3>
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
                @foreach ($data->upcomingEvents as $event)
                <dl>
                    <dt>
                        <a href="{{action('EventController@getDetails', array('event_id'=> $event->id))}}">
                            {{ $event->title }}
                        </a>
                    </dt>
                    <dd><i class="fa fa-calendar"></i> <small>{{ $event->start_date }}</small></dd>
                </dl>
                @endforeach

                @if (empty($data->upcomingEvents))
                No upcoming events
                @endif
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">Events Host</div>
            <div class="panel-body">
                @foreach ($data->hostEvents as $event)
                <dl>
                    <dt>
                        <a href="{{action('EventController@getDetails', array('event_id'=> $event->eve_id))}}">
                            {{ $event->eve_title }}
                        </a>
                    </dt>
                    <dd><i class="fa fa-calendar"></i> <small>{{ $event->start_date }}</small></dd>
                </dl>
                @endforeach

                @if (empty($data->hostEvents))
                No host events
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
