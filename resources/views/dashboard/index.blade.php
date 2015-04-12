@extends('app')

@section('content')

<div class="row">
    <div class="col-md-8">
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
                            <h5 class="media-heading"><a href="">{{ $event->title }} @ {{ $event->location }}</a></h5>
                            {{ $event->details }}
                            <div><small><a href="#" class="join-event" data-event-id="{{ $event->id }}">Join</a> - <a href="">Like</a></small></div>
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


<div class="row top30">

    @for ($i = 1; $i <= 8; $i++)
    <div class="col-md-3" id="isotope">
        <div class="thumbnail isotope-item">
            <img src="holder.js/100%x200" alt="">
            <div class="caption">
                <h4>Thumbnail label</h4>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
            </div>
        </div>
    </div>
    @endfor
</div>

@endsection
