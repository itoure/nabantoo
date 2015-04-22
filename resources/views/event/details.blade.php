@extends('app')

@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger top30">
    <strong>{{trans('messages.whoops')}}!</strong> {{trans('messages.problem_with_inputs')}}<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">

    <div class="col-md-offset-1 col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">{{trans('messages.event')}}</div>
            <div class="panel-body">
                <h3>{{$data->event->title}}</h3>
                <table class="table">
                    <tr><td><i class="fa fa-map-marker fa-2x text-danger"></i></td><td>{{$data->event->location}}</td></tr>
                    <tr><td><i class="fa fa-calendar fa-2x"></i></td><td>{{$data->event->start_date}}</td></tr>
                    <tr><td><i class="fa fa-paperclip fa-2x"></i></td><td>{{$data->event->interest}}</td></tr>
                    <tr>
                        <td><i class="fa fa-users fa-2x text-success"></i></td>
                        <td><span class="badge">{{$data->event->count_people}}</span></td>
                    </tr>
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
            <div class="pull-right">{!! Html::image('files/user/'.$data->event->usr_photo, '', array('class' => 'img-rounded img-user50')) !!}</div>
        </div>
    </div>
    </div>

</div>


<div class="row">

    <div class="col-md-offset-1 col-md-7">

        <div class="panel panel-default">
            <div class="panel-heading">{{trans('messages.event_comments')}}</div>
            <div class="panel-body">
                {!! Form::open(array('action' => 'EventController@postStoreMessage', 'class' => 'well')) !!}
                {!! Form::hidden('event_id', $data->event->id) !!}
                {!! Form::hidden('user_id', $data->current_user_id) !!}
                <div class="form-group">
                    {!! Html::image('files/user/'.$data->event->usr_photo, '', array('class' => 'img-rounded img-user50')) !!} <i class="fa fa-quote-right fa-2x"></i>
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
                            <td style="width: 20%">{!! Html::image('files/user/'.$message->user_photo, '', array('class' => 'img-rounded img-user40')) !!} <i class="fa fa-quote-right fa-2x"></i></td>
                            <td>{{$message->message}}</td>
                            <td>{{$message->date}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

@endsection
