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
                    {!! Form::select('category',
                    $data->interests,
                    '',
                    array('class' => 'form-control input-lg')) !!}
                </div>

                <div class="form-group">
                    {!! Form::text('location', null, array(
                    'placeholder' => 'Where ?',
                    'class' => 'form-control input-lg',
                    'id' => 'search_autocomplete',
                    'autocomplete' => 'off'

                    )) !!}
                </div>

                {!! Form::hidden('sublocality_level_1', null, array('id' => 'sublocality_level_1')) !!}
                {!! Form::hidden('locality', null, array('id' => 'locality')) !!}
                {!! Form::hidden('administrative_area_level_2', null, array('id' => 'administrative_area_level_2')) !!}
                {!! Form::hidden('administrative_area_level_1', null, array('id' => 'administrative_area_level_1')) !!}
                {!! Form::hidden('postal_code', null, array('id' => 'postal_code')) !!}
                {!! Form::hidden('postal_code_prefix', null, array('id' => 'postal_code_prefix')) !!}
                {!! Form::hidden('country', null, array('id' => 'country')) !!}

                <h5>When ?</h5>
                <div class="form-group form-inline">
                    {!! Form::text('start_date', null, array(
                    'placeholder' => 'Start Date',
                    'class' => 'form-control input-lg',
                    'id' => 'start_date'
                    )) !!}
                    {!! Form::text('end_date', null, array(
                    'placeholder' => 'End Date',
                    'class' => 'form-control input-lg',
                    'id' => 'end_date'
                    )) !!}
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
