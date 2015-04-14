@extends('app')

@section('content')

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Create Your RendezVous</div>
            <div class="panel-body">


                @if(!empty($errors->any()))
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <div>{{ $errors->first('title') }}</div>
                        <div>{{ $errors->first('details') }}</div>
                        <div>{{ $errors->first('location') }}</div>
                        <div>{{ $errors->first('photo') }}</div>
                        <div>{{ $errors->first('start_date') }}</div>
                        <div>{{ $errors->first('end_date') }}</div>
                        <div>{{ $errors->first('category') }}</div>
                    </ul>
                </div>
                @endif

                {!! Form::open(array('action' => 'RendezvousController@postStore', 'files' => true)) !!}

                <div class="form-group">
                    {!! Form::text('title', null, array(
                    'placeholder' => 'Title',
                    'class' => 'form-control input-lg'
                    )) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('location', null, array(
                    'placeholder' => 'Where ?',
                    'class' => 'form-control input-lg',
                    'id' => 'search_autocomplete',
                    'autocomplete' => 'off'

                    )) !!}
                </div>

                {!! Form::hidden('short_sublocality_level_1', null, array('id' => 'short_sublocality_level_1')) !!}
                {!! Form::hidden('long_sublocality_level_1', null, array('id' => 'long_sublocality_level_1')) !!}
                {!! Form::hidden('short_locality', null, array('id' => 'short_locality')) !!}
                {!! Form::hidden('long_locality', null, array('id' => 'long_locality')) !!}
                {!! Form::hidden('short_administrative_area_level_2', null, array('id' => 'short_administrative_area_level_2')) !!}
                {!! Form::hidden('long_administrative_area_level_2', null, array('id' => 'long_administrative_area_level_2')) !!}
                {!! Form::hidden('short_administrative_area_level_1', null, array('id' => 'short_administrative_area_level_1')) !!}
                {!! Form::hidden('long_administrative_area_level_1', null, array('id' => 'long_administrative_area_level_1')) !!}
                {!! Form::hidden('short_postal_code', null, array('id' => 'short_postal_code')) !!}
                {!! Form::hidden('long_postal_code', null, array('id' => 'long_postal_code')) !!}
                {!! Form::hidden('short_postal_code_prefix', null, array('id' => 'short_postal_code_prefix')) !!}
                {!! Form::hidden('long_postal_code_prefix', null, array('id' => 'long_postal_code_prefix')) !!}
                {!! Form::hidden('short_country', null, array('id' => 'short_country')) !!}
                {!! Form::hidden('long_country', null, array('id' => 'long_country')) !!}

                <div class="form-group">
                    {!! Form::text('start_date', null, array(
                    'placeholder' => 'When ?',
                    'class' => 'form-control input-lg',
                    'id' => 'start_date'
                    )) !!}
                </div>

                <div class="form-group">
                    {!! Form::select('interest',
                    $data->interests,
                    '',
                    array('class' => 'form-control input-lg select-interests')) !!}
                </div>

                <div class="form-group">
                    {!! Form::textarea('details', null, array(
                    'placeholder' => 'Details',
                    'class' => 'form-control input-lg',
                    'rows' => '5'
                    )) !!}
                </div>

                <h5>Add a Photo</h5>
                <div class="form-group">
                    {!! Form::file('photo') !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Create', array(
                    'class' => 'btn btn-primary btn-lg btn-block'
                    )); !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@endsection
