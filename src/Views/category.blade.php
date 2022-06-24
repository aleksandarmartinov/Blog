@extends('layouts/app')

@include('partials.navbar')

@section('content')

<div class="jumbotron text-center">
    <h4>Posts</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">

            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-header"><a href="/post/{{ $post->id }}"><h3>{{ $post->title }}</h3></a></div>
                    <div class="card-body"><p>{{ $post->description }}</p></div>
                    <div class="card-footer">
                        <button class="btn btn-info btn-sm float-right">
                            {{ date_format(date_create($post->created_at),"Y-m-d") }}
                        </button>
                        <a href="/user_posts/{{ $post->user_id }}" class="btn btn-warning btn-sm float-left">
                            {{ $user->getUserWithId($post->user_id)->name }}
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection