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
    {!! Html::style('css/select2.min.css') !!}
    {!! Html::style('css/rdv_app.css') !!}
    {!! Html::style('css/bootstrap-datetimepicker.min.css') !!}
    {!! Html::style('font-awesome/css/font-awesome.min.css') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{action('DashboardController@getIndex')}}">Nabantoo <small>{do it with people}</small></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{action('RendezvousController@getCreate')}}">{{trans('messages.create_event')}}</a></li>
                </ul>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li>
                            {!! Html::image('files/user/'.$user->usr_photo, '', array('class' => 'img-user40 img-rounded')) !!}
                        </li>

                        <li><a href="{{action('UserController@getAccount')}}">{{trans('messages.my_account')}}</a></li>
                        <li><a href="{{action('Auth\AuthController@getLogout')}}">{{trans('messages.logout')}}</a></li>
                    </ul>
                </div>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

<div class="container">
    @yield('content')

    <div class="footer hide">
        <p>#Nabantoo</p>
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
