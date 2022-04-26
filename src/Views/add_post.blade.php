@extends('layouts/app')

@include('partials.navbar_post')

@section('content')

<div class="jumbotron text-center">
    <h4>Dodajte Post</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/add_post" method="POST">
            @if(isset($_SESSION['ERROR_MESSAGE']) && is_array($_SESSION['ERROR_MESSAGE']) && count($_SESSION['ERROR_MESSAGE']) >0)

            @foreach($_SESSION['ERROR_MESSAGE'] as $msg)  
                        <div style="color: red; text-align: center;">{{$msg}}</div><br>    
            @endforeach
                @php
                    unset($_SESSION['ERROR_MESSAGE'])
                @endphp
            @endif
            <input type="text" name="post_title" placeholder="Title" class="form-control"><br>
            <textarea name="post_description" placeholder="Description" colls="30" rows="10" class="form-control"></textarea><br>
            <button type="submit" name="postSubBtn" class="form-control btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
</div>

@endsection