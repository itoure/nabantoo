@extends('app')

@section('content')

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="row">

    <div class="col-md-8">
        <div class="panel panel-default panel-event-detail">
            <div class="panel-heading panel-title">{{$data->event->eve_title}}</div>
            <div class="panel-body">

                @if (!empty($data->event->eve_photo))
                {!! Html::image('img/interests/'.$data->event->eve_photo, '', array('class' => 'img-event-item')) !!}
                @else
                <img class="" src="holder.js/100px250?text={{ $data->event->int_name }}&theme={{$data->event->cat_color}}" alt="">
                @endif

                <table class="table table-striped">
                    <tr><td><i class="fa fa-tag fa-2x"></i></td><td>{{$data->event->int_name}}</td></tr>
                    <tr><td><i class="fa fa-calendar fa-2x"></i></td><td>{{$data->event->eve_start_date}}</td></tr>
                    <tr><td><i class="fa fa-clock-o fa-2x"></i></td><td>{{$data->event->eve_duration == 0 ? 'No limit' : $data->event->eve_duration}}</td></tr>
                    <tr><td><i class="fa fa-map-marker fa-2x text-danger"></i></td><td>{{$data->event->eve_location}}</td></tr>
                    <tr>
                        <td><i class="fa fa-users fa-2x text-success"></i></td>
                        <td><span class="badge"><span id="event-count-participant" data-event-id="{{ $data->event->eve_id }}">{{$data->event->count_participants}}</span> / {{ $data->event->eve_people_limit_max }}</span></td>
                    </tr>
                    <tr><td><i class="fa fa-money fa-2x"></i></td><td>{{$data->event->eve_budget == 0 ? 'Free' : $data->event->eve_budget}}</td></tr>
                    <tr><td><i class="fa fa-info-circle fa-2x text-warning"></i></td><td>{{$data->event->eve_details}}</td></tr>
                </table>

                <div class="fb-share-button pull-left" data-href="{{Request::url()}}" data-layout="button"></div>

                <div id="action-event-detail" class="small pull-right">
                    <i class="fa fa-spinner fa-spin loading" style="display: none"></i>

                    @if ($data->event->user_event_choice == 'ok')
                        <i class="fa fa-thumbs-o-up text-success"></i> going - <a class="cancel-join-event-detail" href="#" data-event-id="{{ $data->event->eve_id }}">cancel</a>
                    @elseif($data->event->user_event_choice == 'ko')
                        <i class="fa fa-thumbs-o-down text-danger"></i> declined - <a class="cancel-join-event-detail" href="#" data-event-id="{{ $data->event->eve_id }}">cancel</a>
                    @elseif($data->event->user_event_choice == 'host')
                        <i class="fa fa-user"></i> host - <a href="#">edit</a>
                    @else
                        <a role="button" href="#" class="btn btn-default btn-xs join-event-detail" data-event-id="{{ $data->event->eve_id }}"><i class="fa fa-user-plus"></i> {{trans('messages.join')}}</a>
                        <a role="button" href="#" class="btn btn-default btn-xs decline-event-detail" data-event-id="{{ $data->event->eve_id }}"><i class="fa fa-user-times"></i> Decline</a>
                    @endif
                </div>

            </div>
        </div>



        <!-- Messages -->
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('messages.event_comments')}}</div>
            <div class="panel-body">
                {!! Form::open(array('action' => 'EventController@postStoreMessage', 'class' => 'well')) !!}
                {!! Form::hidden('event_id', $data->event->eve_id) !!}
                {!! Form::hidden('user_id', $data->user_id) !!}
                <div class="form-group">
                    {!! Form::textarea('message', null, array(
                    'placeholder' => trans('messages.your_message'),
                    'class' => 'form-control textarea-msg',
                    'rows' => '2'
                    )) !!}
                </div>
                <div class="text-right">
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
                                {!! Html::image('files/user/'.$message->user_photo, '', array('class' => 'img-rounded img-user30')) !!}
                                @else
                                <img class="img-circle" src="holder.js/30x30?theme=social&text={{ $message->usr_first_letter }}" alt="">
                                @endif
                                <i class="fa fa-quote-right"></i>
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


    <div class="col-md-4">

        <!-- Host -->
        <div class="panel panel-default">
            <div class="panel-heading small">{{trans('messages.owner')}}</div>
            <div class="panel-body" id="host-block">
                <div>
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-left">
                                @if (!empty($data->event->usr_photo))
                                {!! Html::image('files/user/'.$data->event->usr_photo, '', array('class' => 'img-rounded img-user80')) !!}
                                @else
                                <img class="img-rounded" src="holder.js/80x80?text={{ $data->event->usr_first_letter }}" alt="">
                                @endif
                            </div>
                            <div class="media-body">
                                <a href="{{action('UserController@getProfile', array('user_id'=> $data->event->usr_id))}}">{{$data->event->usr_firstname}}</a>
                                <p><i class="fa fa-trophy"></i> <small class="badge">23</small></p>
                            </div>
                        </li>
                    </ul>
                </div>

                @if ($data->event->usr_id != $data->user_id)
                <div class="text-right">
                    <i id="network-loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                    @if ($data->event->isUserInMyNetwork)
                        <a role="button" class="btn btn-default btn-xs manage-network" data-action="remove" data-user-id="{{$data->event->usr_id}}">Remove network</a>
                    @else
                        <a role="button" class="btn btn-primary btn-xs manage-network" data-action="add" data-user-id="{{$data->event->usr_id}}">Add network</a>
                    @endif
                </div>
                @endif
            </div>
        </div>



        <!-- Participants -->
        <div class="panel panel-default">
            <div class="panel-heading small">Participants</div>
            <div id="eventParticipants-loading" class="text-center top20">
                <i class="fa fa-spinner fa-spin fa-2x"></i>
            </div>
            <div id="eventParticipants" class="panel-body small" data-event-id="{{ $data->event->eve_id }}">

            </div>
        </div>



        <!-- Others moments -->
        <div class="panel panel-default">
            <div class="panel-heading small">Related moments</div>
            <div class="panel-body">
                <ul class="media-list">
                    @foreach ($data->eventsListByInterest as $event)
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
                            <p><i class="fa fa-calendar"></i> <small>{{ $event->eve_start_date }}</small></p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                @if (empty($data->eventsListByInterest))
                No moments.
                @endif
            </div>
        </div>
    </div>

</div>


@endsection
