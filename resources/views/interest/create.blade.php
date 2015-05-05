@extends('app')

@section('content')

<div class="row">

    <div class="col-md-5">

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

        {!! Form::open(array('action' => 'InterestController@store', 'files' => true)) !!}

        <div class="form-group">
            {!! Form::text('name', null, array(
            'placeholder' => 'Name',
            'class' => 'form-control'
            )) !!}
        </div>

        <h5>Category</h5>
        <div class="form-group">
            {!! Form::select('category', $data->arrCategory, '', array('class' => '')) !!}
        </div>

        <h5>Image</h5>
        <div class="form-group">
            {!! Form::file('image') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add', array(
            'class' => 'btn btn-primary'
            )); !!}
        </div>

        {!! Form::close() !!}

    </div>


</div>


@endsection
