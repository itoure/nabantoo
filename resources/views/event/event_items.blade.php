@foreach ($events as $event)
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
                    <i class="fa fa-users text-success"></i> <small>{{ $event->count_people }} / {{ $event->eve_people_limit_max }}</small>
                </p>
                <p class="marg-bot5">
                    @if (!empty($event->usr_photo))
                    {!! Html::image('files/user/'.$event->usr_photo, '', array('class' => 'img-user30 img-rounded')) !!}
                    @else
                    <img class="img-rounded" src="holder.js/30x30?text={{ $event->usr_first_letter }}" alt="">
                    @endif
                    <a href="{{action('UserController@getProfile', array('user_id'=> $event->usr_id))}}" class="small">{{ $event->usr_firstname }}</a>

                    <span id="info-item-list" class="pull-right">
                        <i class="fa fa-spinner fa-spin loading" style="display: none"></i>

                        @if ($event->user_event_choice == 'ok')
                            <i class="fa fa-thumbs-o-up text-success"></i> going - <a class="cancel-join-event" href="#" data-event-id="{{ $event->eve_id }}">cancel</a>
                        @elseif($event->user_event_choice == 'ko')
                            <i class="fa fa-thumbs-o-down text-danger"></i> declined - <a class="cancel-join-event" href="#" data-event-id="{{ $event->eve_id }}">cancel</a>
                        @elseif($event->user_event_choice == 'host')
                            <i class="fa fa-user"></i> host - <a href="{{action('EventController@getEdit', array('event_id'=> $event->eve_id))}}">edit</a>
                        @else
                            <a role="button" href="#" class="btn btn-default btn-xs join-event" data-event-id="{{ $event->eve_id }}"><i class="fa fa-user-plus"></i> {{trans('messages.join')}}</a>
                            <a role="button" href="#" class="btn btn-default btn-xs decline-event" data-event-id="{{ $event->eve_id }}"><i class="fa fa-user-times"></i> Decline</a>
                        @endif
                    </span>
                </p>
            </div>

        </div>
    </div>
</li>
@endforeach

@if (empty($events))
Nothing found. <a href="{{action('EventController@getCreate')}}">Create a moment</a>
@endif