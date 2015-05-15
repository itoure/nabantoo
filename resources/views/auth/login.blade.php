@extends('welcome')

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-8">
            <div class="jumbotron">
                <h1>Do it together!</h1>
                <p>Créer, participer et partager des moments que vous allez aimer...</p>
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        {!! Html::image('img/drinks.jpg', '', array('class' => 'img-activity img-rounded')) !!}
                    </div>
                    <div class="col-xs-12 col-md-4">
                        {!! Html::image('img/runners.jpg', '', array('class' => 'img-activity img-rounded')) !!}
                    </div>
                    <div class="col-xs-12 col-md-4">
                        {!! Html::image('img/girls_shopping.jpg', '', array('class' => 'img-activity img-rounded')) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>{{trans('messages.whoops')}}!</strong> {{trans('messages.problem_with_inputs')}}<br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {!! Form::open(array('action' => 'Auth\AuthController@postRegister', 'class' => 'form-signup well', 'id' => 'formSignupUser')) !!}

            <div class="form-group">
                {!! Form::text('firstname', null, array(
                'placeholder' => trans('messages.name'),
                'class' => 'form-control',
                'data-toggle' => 'tooltip',
                'data-placement' => 'left',
                'title' => trans('messages.help_name')
                )) !!}
            </div>

            <div class="form-group">
                {!! Form::text('location', null, array(
                'placeholder' => trans('messages.city'),
                'class' => 'form-control',
                'id' => 'search_autocomplete',
                'autocomplete' => 'off',
                'data-toggle' => 'tooltip',
                'data-placement' => 'left',
                'title' => trans('messages.help_city')

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
                'class' => 'form-control',
                'data-toggle' => 'tooltip',
                'data-placement' => 'left',
                'title' => trans('messages.help_email')
                )) !!}
            </div>

            <div class="form-group">
                {!! Form::password('password', array(
                'placeholder' => 'Password',
                'class' => 'form-control',
                'data-toggle' => 'tooltip',
                'data-placement' => 'left',
                'title' => trans('messages.help_password')
                )) !!}
            </div>

            <h5>{{trans('messages.what_your_interests')}}</h5>
            <div class="form-group">
                {!! Form::select('interests[]',
                $data->interests,
                '',
                array(
                'class' => 'form-control multiselect-interests-home',
                'multiple' => 'multiple',
                )) !!}
                <p class="help-block">{{trans('messages.help_what_your_interests')}}</p>
            </div>

            <div class="form-group">
                {!! Form::submit(trans('messages.signup'), array(
                'class' => 'btn btn-primary btn-block'
                )); !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
