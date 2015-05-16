@extends('app')

@section('content')

<div class="row">

    <div class="col-md-offset-1 col-md-7">
        <div class="panel panel-default panel-event-detail">
            <div class="panel-heading panel-title">{{$data->event->eve_title}}</div>
            <div class="panel-body">
                <table class="table">
                    <tr><td><i class="fa fa-tag fa-2x"></i></td><td>{{$data->event->int_name}}</td></tr>
                    <tr><td><i class="fa fa-calendar fa-2x"></i></td><td>{{$data->event->eve_start_date}}</td></tr>
                    <tr><td><i class="fa fa-map-marker fa-2x text-danger"></i></td><td>{{$data->event->eve_location}}</td></tr>
                    <tr>
                        <td><i class="fa fa-users fa-2x text-success"></i></td>
                        <td><span id="event-count-participant" class="badge" data-event-id="{{ $data->event->eve_id }}">{{$data->event->count_participants}}</span></td>
                    </tr>
                    <tr><td><i class="fa fa-info-circle fa-2x text-warning"></i></td><td>{{$data->event->eve_details}}</td></tr>
                </table>

                <div id="info-event-detail" class="small pull-right">
                @if ($data->isUserComing)
                <i class="fa fa-check-square-o fa-2x text-success"></i> Your are going to this moment - <a href="">cancel?</a>
                @else
                <i class="fa fa-user-plus fa-2x text-success"></i>
                    <a href="#" class="join-event-detail" data-event-id="{{ $data->event->eve_id }}">{{trans('messages.join')}}</a>
                    <i id="join-loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                @endif
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{trans('messages.event_comments')}}</div>
            <div class="panel-body">
                {!! Form::open(array('action' => 'EventController@postStoreMessage', 'class' => 'well')) !!}
                {!! Form::hidden('event_id', $data->event->eve_id) !!}
                {!! Form::hidden('user_id', $data->user_id) !!}
                <div class="form-group">

                    @if (!empty($data->event->usr_photo))
                    {!! Html::image('files/user/'.$data->event->usr_photo, '', array('class' => 'img-rounded img-user50')) !!}
                    @else
                    <img class="img-circle" src="holder.js/50x50?theme=social&text={{ $data->event->usr_first_letter }}" alt="">
                    @endif
                    <i class="fa fa-quote-right fa-2x"></i>

                </div>
                <div class="form-group">
                    {!! Form::textarea('message', null, array(
                    'placeholder' => trans('messages.your_message'),
                    'class' => 'form-control textarea-msg',
                    'rows' => '2'
                    )) !!}
                </div>
                <div class="align-right">
                    {!! Form::submit(trans('messages.publish'), array(
                    'class' => 'btn btn-primary'
                    )); !!}
                </div>
                {!! Form::close() !!}

                <div>
                    <table class="table">
                        @foreach ($data->messages as $message)
                        <tr>
                            <td style="width: 20%">
                                @if (!empty($message->user_photo))
                                {!! Html::image('files/user/'.$message->user_photo, '', array('class' => 'img-rounded img-user40')) !!}
                                @else
                                <img class="img-circle" src="holder.js/40x40?theme=social&text={{ $message->usr_first_letter }}" alt="">
                                @endif
                                <i class="fa fa-quote-right fa-2x"></i>
                            </td>
                            <td>{{$message->message}}</td>
                            <td>{{$message->date}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('messages.owner')}}</div>
            <div class="panel-body">
                <div>
                    @if (!empty($data->event->usr_photo))
                    {!! Html::image('files/user/'.$data->event->usr_photo, '', array('class' => 'img-rounded img-user50')) !!}
                    @else
                    <img class="img-circle" src="holder.js/50x50?text={{ $data->event->usr_first_letter }}" alt="">
                    @endif
                    <a href="{{action('UserController@getProfile', array('user_id'=> $data->event->user_id))}}">{{$data->event->usr_firstname}}</a>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Participants</div>
            <div id="eventParticipants-loading" class="text-center top20">
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
            <div id="eventParticipants" class="panel-body small" data-event-id="{{ $data->event->eve_id }}">

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Upcoming events for <span class="label label-primary">{{$data->event->int_name}}</span></div>
            <div class="panel-body">
                @foreach ($data->eventsListByInterest as $event)
                <dl>
                    <dt>
                        <a href="{{action('EventController@getDetails', array('event_id'=> $event->eve_id))}}">
                            {{ $event->eve_title }}
                        </a>
                    </dt>
                    <dd><i class="fa fa-calendar"></i> <small>{{ $event->eve_start_date }}</small></dd>
                </dl>
                @endforeach

                @if (empty($data->eventsListByInterest))
                No events
                @endif
            </div>
        </div>
    </div>

</div>


@endsection
