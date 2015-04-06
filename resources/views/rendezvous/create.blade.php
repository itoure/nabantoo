@extends('layout')

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
                    {!! Form::textarea('details', null, array(
                    'placeholder' => 'Description',
                    'class' => 'form-control input-lg',
                    'rows' => '5'
                    )) !!}
                </div>

                <div class="form-group">
                    {!! Form::select('category',
                    $data->interests,
                    '',
                    array('class' => 'form-control input-lg')) !!}
                </div>

                <div class="form-group">
                    {!! Form::select('city',
                    $data->cities,
                    '',
                    array('class' => 'form-control input-lg')) !!}
                </div>

                <h5>Date RendezVous</h5>
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

                <h5>Add Photo RendezVous</h5>
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
