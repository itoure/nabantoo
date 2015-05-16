@foreach ($data->participantsList as $participant)
<dl class="participants">
    <dt>
        @if (!empty($participant->usr_photo))
        {!! Html::image('files/user/'.$participant->usr_photo, '', array('class' => 'img-user30 img-rounded')) !!}
        @else
        <img class="img-circle" src="holder.js/30x30?text={{ $participant->usr_first_letter }}" alt="">
        @endif
        <a href="{{action('UserController@getProfile', array('user_id'=> $participant->usr_id))}}">{{ $participant->usr_firstname }}</a>
    </dt>
</dl>
@endforeach

@if (empty($data->participantsList))
No participants
@endif