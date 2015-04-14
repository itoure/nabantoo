@extends('home')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12 text-center" style="margin-top: 50px;color: #FFF;">
            <h1>Don't be afraid to meet new people</h1>
        </div>
    </div>

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

    {!! Form::open(array('action' => 'Auth\AuthController@postRegister', 'class' => 'form-signup well')) !!}

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
        {!! Form::text('location', null, array(
        'placeholder' => 'Your City',
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

    <h5>Birthday</h5>
    <div class="form-group">
        Month {!! Form::select('month', array('' => '') + array_combine(range(1,12),range(1,12)), '', array('class' => 'form-inline')) !!}
        Day {!! Form::select('day', array('' => '') + array_combine(range(1,31),range(1,31)), '', array('class' => 'form-inline')) !!}
        Year {!! Form::select('year', array('' => '') + array_combine(range(2015, 1915),range(2015, 1915)), '', array('class' => 'form-inline')) !!}
    </div>

    <h5>What are your interests ?</h5>
    <div class="form-group">
        {!! Form::select('interests[]',
        $data->interests,
        '',
        array('class' => 'form-control input-lg multiselect-interests-home', 'multiple' => 'multiple')) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Sign Up', array(
        'class' => 'btn btn-primary btn-lg btn-block'
        )); !!}
    </div>

    {!! Form::close() !!}

</div>
@endsection
