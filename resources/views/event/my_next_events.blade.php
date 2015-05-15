@foreach ($data->upcomingEvents as $event)
<dl>
    <dt>
        <a href="{{action('EventController@getDetails', array('event_id'=> $event->eve_id))}}">
            {{ $event->eve_title }}
        </a>
    </dt>
    <dd><i class="fa fa-calendar"></i> <small>{{ $event->eve_start_date }}</small></dd>
</dl>
@endforeach

@if (empty($data->upcomingEvents))
No upcoming events
@endif