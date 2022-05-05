@extends('layouts/app')

@include('partials.navbar_singlepost')

@section('content')

<div class="jumbotron text-center">
    <h4>Posts of </h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            @foreach($posts as $post)
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="/post/{{ $post->id }}"><h3>{{ $post->title; }}</h3></a>
                    </div>
                    <div class="card-body">{{ $post->description }}</div>
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

@endsection
