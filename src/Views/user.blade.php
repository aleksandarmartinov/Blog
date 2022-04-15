@extends('layouts/app')

@include('partials.navbar_user')

@section('content')

<div class="jumbotron text-center">
    <h4>Posts of {{ $_SESSION['logged_user']->name }}</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            @foreach($posts as $post)
                <div class="card mb-3">
                <div class="card-header">
                <h3>
                {{$post->title;}}
                <form action="/post/{{ $post->id }}/delete" method="POST">
                    
                    <button type="submit" class="float-right btn btn-sm btn-danger">Remove</button>
                </form>
                </h3>
                </div>
                <div class="card-body">
                    {{$post->description}}
                </div>
                <div class="card-footer">
                    <button class="btn btn-info btn-sm float-right">
                        {{ date_format(date_create($post->created_at),"Y-m-d") }}
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>