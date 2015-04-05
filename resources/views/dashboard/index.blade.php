@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">Upcoming RendezVous</div>
            <div class="panel-body">
                <ul class="media-list">
                    @for ($i = 1; $i <= 5; $i++)
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="holder.js/150x100/vine" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="">Soccer 5 @ Parilly</a></h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                            <div><small><a href="">Join</a> - <a href="">Like</a></small></div>
                        </div>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">Friends RendezVous</div>
            <div class="panel-body">
                <ul class="media-list">
                    @for ($i = 1; $i <= 5; $i++)
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="holder.js/40x40/lava" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="">Nadia</a> is going to <a href="">Soccer 5 @ Parilly</a>
                            <div><small><a href="">Join</a> - <a href="">Like</a></small></div>
                        </div>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">Highlights Past RendezVous</div>
            <div class="panel-body">
                @for ($i = 1; $i <= 8; $i++)
                <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                    <img src="holder.js/171x180/social" alt="">
                </a>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">RendezVous That Might Interest You</div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>
</div>

@endsection
