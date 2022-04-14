@extends('layouts/app')

@include('partials.navbar')

@section('content')

<div class="jumbotron text-center">
    <h4>Login</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="/login" method="POST">
                @if(isset($_SESSION['ERROR_MESSAGE']) && is_array($_SESSION['ERROR_MESSAGE']) && count($_SESSION['ERROR_MESSAGE']) >0)

	                @foreach($_SESSION['ERROR_MESSAGE'] as $msg)  
		                    <div style="color: red; text-align: center;">{{$msg}}</div><br>    
                    @endforeach
                    @php
	                    unset($_SESSION['ERROR_MESSAGE'])
                    @endphp
                    
                @endif
                <input type="text" name="login_email" placeholder="Email" class="form-control" ><br>
                <input type="password" name="login_password" placeholder="Password" class="form-control"><br>
                <button class="form-control btn btn-primary" name="loginBtn">Login</button>
            </form>
        </div>
    </div>
</div>

@endsection