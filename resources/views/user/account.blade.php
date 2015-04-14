@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">My Account</div>
            <div class="panel-body">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {!! Form::model($data->user, array('action' => 'UserController@postStore', 'files' => true)) !!}

                {!! Form::hidden('usr_id', null) !!}
                {!! Form::hidden('loc_id', $data->location->location_id) !!}

                <div class="form-group">
                    <label class="radio-inline">
                        {!! Form::radio('sexe', 'F') !!} Female
                    </label>

                    <label class="radio-inline">
                        {!! Form::radio('sexe', 'M') !!} Male
                    </label>
                </div>

                <div class="form-group">
                    {!! Form::text('firstname', null, array(
                    'placeholder' => 'Your Real Name',
                    'class' => 'form-control input-lg'
                    )) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('usr_location', null, array(
                    'placeholder' => 'Your City',
                    'class' => 'form-control input-lg',
                    'id' => 'search_autocomplete',
                    'autocomplete' => 'off'

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

                <h5>Birthday</h5>
                <div class="form-group">
                    {!! Form::select('month', array_combine(range(1,12),range(1,12)), $data->birthday->month, array('class' => 'form-inline')) !!}
                    {!! Form::select('day', array_combine(range(1,31),range(1,31)), $data->birthday->day, array('class' => 'form-inline')) !!}
                    {!! Form::select('year', array_combine(range(2015, 1915),range(2015, 1915)), $data->birthday->year, array('class' => 'form-inline')) !!}
                </div>

                <h5>Your Photo</h5>
                <div class="form-group">
                    {!! Form::file('photo') !!}
                </div>

                <h3>What are your interests ?</h3>

                <div class="form-group">
                    {!! Form::select('interests[]',
                    $data->interests,
                    $data->interestIds,
                    array('class' => 'form-control input-lg multiselect-interests-user', 'multiple' => 'multiple')) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update', array(
                    'class' => 'btn btn-primary btn-lg btn-block'
                    )); !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@endsection
