@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-1 col-md-10">

        <ul class="media-list well profile-well">
            <li class="media">
                <div class="media-left">
                    @if (!empty($data->user->usr_photo))
                    {!! Html::image('files/user/'.$data->user->usr_photo, '', array('class' => 'img-rounded img-user150')) !!}
                    @else
                    <img class="img-rounded" src="holder.js/150x150?theme=social&text={{ $data->user->usr_first_letter }}" alt="">
                    @endif
                </div>
                <div class="media-body">
                    <dl>
                        <dt class="lead" style="margin-bottom: 0px">
                            <span>{{$data->user->usr_firstname}}</span>

                            @if ($data->user->usr_id != $data->user_id)
                            <span class="text-right">
                                <i id="network-loading" class="fa fa-spinner fa-spin" style="display: none"></i>
                                @if ($data->user->isUserInMyNetwork)
                                <a role="button" class="btn btn-default btn-xs manage-network" data-action="remove" data-user-id="{{$data->user->usr_id}}">Remove network</a>
                                @else
                                <a role="button" class="btn btn-primary btn-xs manage-network" data-action="add" data-user-id="{{$data->user->usr_id}}">Add network</a>
                                @endif
                            </span>
                            @endif
                        </dt>

                        <dd>{{$data->user->usr_location}}</dd>
                        <dd>Interests : {!! implode(', ', $data->user->interests) !!}</dd>
                        <dd><i class="fa fa-trophy"></i> <small class="badge">23</small></dd>

                        @if ($data->user->usr_id == $data->user_id)
                        <dd class="small"><a href="{{action('UserController@getAccount')}}"><i class="fa fa-pencil"></i> edit profile</a></dd>
                        @endif
                    </dl>
                </div>
            </li>
        </ul>

    </div>

    <div class="clearfix"></div>

    <div class="col-md-offset-2 col-md-8">
        <h4>Host Moments</h4>

        <ul class="list-group">
            @include('event/event_items', ['events' => $data->hostEvents])
        </ul>

    </div>

    <div class="col-md-offset-2 col-md-8 bottom20">
        <h4>Upcoming Moments</h4>

        <ul class="list-group">
            @include('event/event_items', ['events' => $data->upcomingEvents])
        </ul>

    </div>


</div>

@endsection
