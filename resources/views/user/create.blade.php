@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Create Your Account</div>
            <div class="panel-body">


                @if(!empty($errors->any()))
                <div class="alert alert-danger" role="alert">
                    <ul>
                    <div>{{ $errors->first('firstname') }}</div>
                    <div>{{ $errors->first('sexe') }}</div>
                    <div>{{ $errors->first('birthday') }}</div>
                    <div>{{ $errors->first('email') }}</div>
                    <div>{{ $errors->first('password') }}</div>
                    </ul>
                </div>
                @endif

                {!! Form::open(array('action' => 'UserController@postStore')) !!}

                <div class="form-group">
                    {!! Form::text('firstname', null, array(
                    'placeholder' => 'Firstame',
                    'class' => 'form-control input-lg'
                    )) !!}
                    <span class="help-block">Don't forget to put your real name ;-)</span>
                </div>

                <div class="form-group">
                    <label class="radio-inline">
                    {!! Form::radio('sexe', 'F', array('class' => 'form-control input-lg')) !!} Female
                    </label>

                    <label class="radio-inline">
                    {!! Form::radio('sexe', 'M', array('class' => 'form-control input-lg')) !!} Male
                    </label>
                </div>

                <div class="form-group">
                    {!! Form::text('birthday', null, array(
                    'placeholder' => 'Birthday',
                    'id' => 'birthday',
                    'readonly',
                    'class' => 'form-control input-lg'
                    )) !!}
                </div>

                <div class="form-group">
                    {!! Form::email('email', null, array(
                    'placeholder' => 'Email',
                    'class' => 'form-control input-lg'
                    )) !!}
                </div>

                <div class="form-group">
                    {!! Form::password('password', array(
                    'placeholder' => 'Password',
                    'class' => 'form-control input-lg'
                    )) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Let\'s meet people now', array(
                    'class' => 'btn btn-primary btn-lg btn-block'
                    )); !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>

@endsection
