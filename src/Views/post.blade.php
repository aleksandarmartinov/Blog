@extends('layouts/app')

@include('partials.navbar_singlepost')

@section('content')

<div class="jumbotron text-center">
    <h4>Blog Text</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2 text-center">
            <h1>{{$category->category}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2 text-center">
            <h2>{{ $post->title }}</h2>
        </div>
    </div>  
    <p class="col-8 offset-2 text-center">{{ $post->description }}</p></br>

    @if ( $post->file )
    <div class="col-6"><img src="/uploads/{{ $post->file }}" class="thumb img-fluid" style="width:250px; height:250px; float:left; border-radius:50%; margin-right:25px;"></div>
    @endif   

</div>

@endsection