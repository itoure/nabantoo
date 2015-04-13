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
                <a href="">{{ $event->title }} @ {{ $event->location }}</a>
                by <a href="">{{ $event->event_owner }}</a>
                <img class="align-with-text" src="holder.js/30x30/social" alt="">
            </h5>
            {{ $event->details }}
            <div><small><a href="#" class="join-event" data-event-id="{{ $event->id }}">Join</a> - <a href="">Like</a></small></div>
        </div>
    </li>
    @endforeach
</ul>