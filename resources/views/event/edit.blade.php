@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Edit the event</div>
            <div class="panel-body">


                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>{{trans('messages.oups')}}!</strong> {{trans('messages.problem_with_inputs')}}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::model($data->event, array('action' => 'EventController@postEditStore', 'files' => true, 'id' => 'formEditEvent')) !!}

                {!! Form::hidden('eve_id') !!}
                {!! Form::hidden('location_id', $data->event->location_id) !!}

                <div class="form-group">
                    <label>{{trans('messages.title')}}</label>
                    {!! Form::text('eve_title', null, array(
                    'placeholder' => trans('messages.title'),
                    'class' => 'form-control',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'left',
                    'title' => trans('messages.help_title')
                    )) !!}
                </div>

                <div class="form-group">
                    <label>{{trans('messages.where')}}</label>
                    {!! Form::text('eve_location', null, array(
                    'placeholder' => trans('messages.where'),
                    'class' => 'form-control',
                    'id' => 'search_autocomplete',
                    'autocomplete' => 'off',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'left',
                    'title' => trans('messages.help_where')
                    )) !!}
                </div>

                {!! Form::hidden('short_sublocality_level_1', $data->location->short_sublocality_level_1, array('id' => 'short_sublocality_level_1')) !!}
                {!! Form::hidden('long_sublocality_level_1', $data->location->long_sublocality_level_1, array('id' => 'long_sublocality_level_1')) !!}
                {!! Form::hidden('short_locality', $data->location->short_locality, array('id' => 'short_locality')) !!}
                {!! Form::hidden('long_locality', $data->location->long_locality, array('id' => 'long_locality')) !!}
                {!! Form::hidden('short_administrative_area_level_2', $data->location->short_administrative_area_level_2, array('id' => 'short_administrative_area_level_2')) !!}
                {!! Form::hidden('long_administrative_area_level_2', $data->location->long_administrative_area_level_2, array('id' => 'long_administrative_area_level_2')) !!}
                {!! Form::hidden('short_administrative_area_level_1', $data->location->short_administrative_area_level_1, array('id' => 'short_administrative_area_level_1')) !!}
                {!! Form::hidden('long_administrative_area_level_1', $data->location->long_administrative_area_level_1, array('id' => 'long_administrative_area_level_1')) !!}
                {!! Form::hidden('short_postal_code', $data->location->short_postal_code, array('id' => 'short_postal_code')) !!}
                {!! Form::hidden('long_postal_code', $data->location->long_postal_code, array('id' => 'long_postal_code')) !!}
                {!! Form::hidden('short_postal_code_prefix', $data->location->short_postal_code_prefix, array('id' => 'short_postal_code_prefix')) !!}
                {!! Form::hidden('long_postal_code_prefix', $data->location->long_postal_code_prefix, array('id' => 'long_postal_code_prefix')) !!}
                {!! Form::hidden('short_country', $data->location->short_country, array('id' => 'short_country')) !!}
                {!! Form::hidden('long_country', $data->location->long_country, array('id' => 'long_country')) !!}

                <div class="form-group">
                    <label>{{trans('messages.when')}}</label>
                    {!! Form::text('eve_start_date', null, array(
                    'placeholder' => trans('messages.when'),
                    'class' => 'form-control',
                    'id' => 'start_date',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'left',
                    'title' => trans('messages.help_when')
                    )) !!}
                </div>


                <div class="form-group">
                    <label>Interest</label>
                    {!! Form::select('interest',
                    $data->interests,
                    $data->event->int_id,
                    array(
                    'class' => 'form-control select-interests',
                    'data-toggle' => 'tooltip'
                    )) !!}
                </div>


                <div class="form-group">
                    <label>Details</label>
                    {!! Form::textarea('eve_details', null, array(
                    'placeholder' => trans('messages.details'),
                    'class' => 'form-control',
                    'rows' => '5',
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'left',
                    'title' => trans('messages.help_details')
                    )) !!}
                </div>

                <span class="lead">Others Informations</span>

                <div class="form-group">
                    <label>People limit</label>
                    {!! Form::text('eve_people_limit_max', null, array(
                    'placeholder' => 'People limit',
                    'class' => 'form-control',
                    )) !!}
                </div>

                <div class="form-group">
                    <label>Budget</label>
                    {!! Form::text('eve_budget', null, array(
                    'placeholder' => 'Budget',
                    'class' => 'form-control',
                    )) !!}
                </div>

                <div class="form-group">
                    <label>Duration</label>
                    {!! Form::text('eve_duration', null, array(
                    'placeholder' => 'Duration',
                    'class' => 'form-control',
                    )) !!}
                </div>

                <label>{{trans('messages.add_photo')}}</label>
                <div class="form-group">
                    {!! Form::file('photo') !!}
                </div>

                <div class="form-group pull-right">
                    <a class="btn btn-default" href="{{action('HomeController@getIndex')}}" role="button">Annuler</a>
                    {!! Form::submit('Edit the event', array(
                    'class' => 'btn btn-primary'
                    )); !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>

</div>

@endsection
