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
                {{ $user->getUserWithId($post->user_id)->name }}
                    <div class="card mb-3">
                    <div class="card-header">
                    <a href="" method="GET">
                    <h3>{{ $post->title }}</h3>
                    </div>
                    </a>
                    <div class="card-body">
                        <p>{{ $post->description }}</p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-info btn-sm float-right">
                            {{ date_format(date_create($post->created_at),"Y-m-d") }}
                        </button>
                        <button class="btn btn-warning btn-sm float-left">
                            {{ $user->getUserWithId($post->user_id)->name }}
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


