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
    <div>
        <div class="row">
            <p class="col-8 offset-2 text-center">{{ $post->description }}</p></br>
        </div> 
    </div>
<div>
    <div class="row col-8 offset-4">
        @if ( $post->file )
            <div><img src="/uploads/{{ $post->file }}" class="thumb img-fluid" style="width:250px; height:250px; float:left; border-radius:50%; margin-right:25px; margin-left:25px;"></div>
        @endif
    </div>
</div>
</div><br><br>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2 pb-5">
            <form action="/post/{{ $post->id }}" method="POST">
                <textarea name="comment" class="form-control" cols="30" rows="10" placeholder="Write something ..."></textarea><br>
                <div class="col text-center">
                    <button type="submit" name="comment_submit" class="btn btn-primary">Add Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="text-center"><h2>Comments</h2></div><br>

<div class="row">
    @foreach ($comments as $comment)
    <div class="col-8 offset-2 text-center">
        <div class="media g-mb-30 media-comment">
            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
              <div class="g-mb-15">
                <h5 class="h5 g-color-gray-dark-v1 mb-0"></h5>
                <span class="g-color-gray-dark-v4 g-font-size-12">{{ date_format(date_create($comment->created_at),"d-m-Y") }}</span>
              </div>      
              <p>{{ $comment->comment }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection