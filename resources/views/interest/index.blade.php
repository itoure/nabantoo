@extends('app')

@section('content')

<div class="row">

    <div class="col-md-12">
        <a class="btn btn-default" href="{{action('InterestController@create')}}" role="button">Add Interest</a>
        <table class="top30 table table-striped">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>

            @foreach ($data->interestList as $interest)
            <tr>
                <td>{{$interest->int_name}}</td>
                <td>{{$interest->cat_name}}</td>
                <td> {!! Html::image('img/interests/'.$interest->int_image, '', array('class' => 'img-int-admin img-rounded')) !!}</td>
                <td>
                    <a class="btn btn-default btn-xs" href="{{action('InterestController@edit', array('interest_id'=> $interest->int_id))}}" role="button">Edit</a>
                    <a class="btn btn-default btn-xs" href="{{action('InterestController@edit', array('interest_id'=> $interest->int_id))}}" role="button">Remove</a>
                </td>
            </tr>
            @endforeach

        </table>

    </div>


</div>


@endsection
