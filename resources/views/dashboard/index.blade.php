@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-8">
        <ul class="nav nav-tabs home-tabs">
            <li role="presentation" class="active"><a href="#interesting">Might Be Interesting</a></li>
            <li role="presentation"><a href="#upcomming">My Upcoming RendezVous</a></li>
            <li role="presentation"><a href="#friends">Friends RendezVous</a></li>
        </ul>

        <div class="tab-content top20">
            <div role="tabpanel" class="tab-pane active top20" id="interesting">
                <ul class="media-list">
                    @for ($i = 1; $i <= 4; $i++)
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="holder.js/150x100/vine" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="">Soccer 5 @ Parilly</a></h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                            <div><small><a href="">Join</a> - <a href="">Like</a></small></div>
                        </div>
                    </li>
                    @endfor
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
