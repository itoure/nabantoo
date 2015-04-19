@extends('app')

@section('content')

<div class="row">

    <div class="col-md-offset-1 col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">{{$data->event->title}}</div>
            <div class="panel-body">
                <table class="table">
                    <tr><td><i class="fa fa-map-marker fa-2x text-danger"></i></td><td>{{$data->event->location}}</td></tr>
                    <tr><td><i class="fa fa-calendar fa-2x"></i></td><td>{{$data->event->start_date}}</td></tr>
                    <tr><td><i class="fa fa-paperclip fa-2x"></i></td><td>{{$data->event->interest}}</td></tr>
                    <tr><td><i class="fa fa-users fa-2x text-success"></i></td><td><span class="badge">5</span></td></tr>
                    <tr><td><i class="fa fa-info-circle fa-2x text-primary"></i></td><td>{{$data->event->details}}</td></tr>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('messages.owner')}}</div>
        <div class="panel-body">
            <h3><a href="">{{$data->event->event_owner}}</a></h3>
            <div>events list</div>
            <div>interests list</div>
            <div class="pull-right"><i class="fa fa-user-secret fa-3x"></i></div>
        </div>
    </div>
    </div>

</div>


<div class="row">

    <div class="col-md-offset-1 col-md-7">

        <div class="panel panel-default">
            <div class="panel-heading">{{trans('messages.comments')}}</div>
            <div class="panel-body">

            </div>
        </div>

    </div>

</div>

@endsection
