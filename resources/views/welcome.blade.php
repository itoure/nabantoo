<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon.png">

    <title>Rendez-Vous in the real life</title>

    <!-- Bootstrap core CSS -->
    {!! Html::style('bootstrap/css/bootstrap.min.css') !!}

    <!-- Custom styles for this website -->
    {!! Html::style('formvalidation/css/formValidation.min.css') !!}
    {!! Html::style('css/select2.min.css') !!}
    {!! Html::style('css/rdv_home.css') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('HomeController@getIndex')}}">Nabantoo <small>{do it with people}</small></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {!! Form::open(array('action' => 'Auth\AuthController@postLogin', 'class' => 'navbar-form navbar-right')) !!}

            <div class="form-group">
                {!! Form::email('email', null, array(
                'placeholder' => 'Email',
                'class' => 'form-control'
                )) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password', array(
                'placeholder' => trans('messages.password'),
                'class' => 'form-control'
                )) !!}
            </div>

            {!! Form::submit(trans('messages.signin'), array('class' => 'btn btn-success')); !!}

            {!! Form::close() !!}

        </div><!--/.navbar-collapse -->
    </div>
</nav>

@yield('content')

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyaT28hHyLxs-uGcKc_VSy9mHhfxZqBqs&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
{!! Html::script('bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('formvalidation/js/formValidation.min.js') !!}
{!! Html::script('formvalidation/js/framework/bootstrap.min.js') !!}
{!! Html::script('js/holder.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
{!! Html::script('js/bootbox.min.js') !!}
{!! Html::script('js/rdv_home.js') !!}
{!! Html::script('js/rdv_maps.js') !!}

</body>
</html>
