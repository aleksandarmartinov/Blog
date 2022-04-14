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
            <input type="text" name="post_title" placeholder="Title" class="form-control" required><br>
            <textarea name="post_description" placeholder="Description" colls="30" rows="10" class="form-control" required></textarea><br>
            <button type="sybmit" name="postSubBtn" class="form-control btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
</div>

@endsection