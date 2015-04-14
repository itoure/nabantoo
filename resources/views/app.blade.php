<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Rendez-Vous in the real life</title>

    <!-- Bootstrap core CSS -->
    {!! Html::style('bootstrap/css/bootstrap.min.css') !!}

    <!-- Custom styles for this website -->
    {!! Html::style('css/select2.min.css') !!}
    {!! Html::style('css/rdv_app.css') !!}
    {!! Html::style('css/bootstrap-datetimepicker.min.css') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('DashboardController@getIndex')}}">Rendez-Vous</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{action('DashboardController@getIndex')}}">Home</a></li>
                <li><a href="{{action('RendezvousController@getCreate')}}">Create RendezVous</a></li>
                <li><a href="{{action('UserController@getCreate')}}">Create Account</a></li>
                <li><a href="{{action('UserController@getAccount')}}">My Account</a></li>
                <li><a href="{{action('Auth\AuthController@getLogout')}}">Logout</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')
</div>


<div id="loading" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
            {!! HTML::image('img/spinner.gif') !!}
        </div>
    </div>
</div>

<div id="confirm-event" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
            {!! HTML::image('img/confirm.jpg') !!}
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyaT28hHyLxs-uGcKc_VSy9mHhfxZqBqs&libraries=places"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
{!! Html::script('bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
{!! Html::script('js/rdv_app.js') !!}
{!! Html::script('js/rdv_maps.js') !!}
{!! Html::script('js/rdv_user.js') !!}
{!! Html::script('js/holder.min.js') !!}
{!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
{!! Html::script('js/isotope.pkgd.min.js') !!}

</body>
</html>
