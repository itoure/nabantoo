@if (empty($events))
Nothing found. <a href="{{action('EventController@getCreate')}}">Create a moment</a>
@else

<ul class="media-list">
    @foreach ($events as $event)
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

@endif