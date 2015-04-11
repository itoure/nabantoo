@extends('app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12 text-center" style="margin-top: 50px;color: #FFF">
            <h1>Don't be afraid to meet unknown people</h1>
        </div>
    </div>

    <form class="form-signin well" style="margin-top: 50px;opacity: 0.85">
        <h3 class="form-signin-heading">Sign Up</h3>
        <label for="inputEmail" class="sr-only">Firstname</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Firstname" required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
    </form>

</div>
@endsection
