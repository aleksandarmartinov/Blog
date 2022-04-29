@extends('layouts/app')

@include('partials.navbar')

@section('content')

<div class="jumbotron text-center">
    <h4>Register</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="/register" method="POST">
                @if(isset($_SESSION['ERROR_MESSAGE']) && is_array($_SESSION['ERROR_MESSAGE']) && count($_SESSION['ERROR_MESSAGE']) >0)

	                @foreach($_SESSION['ERROR_MESSAGE'] as $msg)  
		                    <div style="color: red; text-align: center;">{{ $msg }}</div><br>    
                    @endforeach
                    @php
	                    unset($_SESSION['ERROR_MESSAGE'])
                    @endphp
                    
                @endif
                <input type="name" name="register_name" placeholder="Name" class="form-control"><br>
                <input type="text" name="register_email" placeholder="Email" class="form-control"><br>
                <input type="password" name="register_password" placeholder="Password" class="form-control"><br>
                <button class="form-control btn btn-warning" name="registerBtn">Register</button>
            </form>
        </div>
    </div>
</div>
   
@endsection