@extends('layouts/app')

@include('partials.navbar_singlepost')

@section('content')

<div class="jumbotron text-center">
    <h4>Blog Text</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2 text-center">
            <h2 class="">{{ $post->title }}</h2>
        </div>
    </div>  
    <p class="col-8 offset-2 text-center">{{ $post->description }}</p>
</div>

@endsection