@foreach ($data->participantsList as $participant)
    <a data-toggle="tooltip" data-placement="top" title="{{ $participant->usr_firstname }}" href="{{action('UserController@getProfile', array('user_id'=> $participant->usr_id))}}">
        @if (!empty($participant->usr_photo))
        {!! Html::image('files/user/'.$participant->usr_photo, '', array('class' => 'img-user30 img-rounded')) !!}
        @else
        <img class="img-rounded" src="holder.js/30x30?text={{ $participant->usr_first_letter }}" alt="">
        @endif
    </a>
@endforeach

@if (empty($data->participantsList))
No participants.
@endif

<script type="application/javascript">
    $('[data-toggle="tooltip"]').tooltip();
</script>