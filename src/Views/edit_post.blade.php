@extends('layouts/app')

@include('partials.navbar_post')

@section('content')

<div class="jumbotron text-center">
    <h4>Izmenite Vas Post</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/blog/edit_post/{{ $post->id }}" method="POST" enctype="multipart/form-data">

                @if(isset($_SESSION['ERROR_MESSAGE']) && is_array($_SESSION['ERROR_MESSAGE']) && count($_SESSION['ERROR_MESSAGE']) >0)
                @foreach($_SESSION['ERROR_MESSAGE'] as $msg)  
                        <div style="color: red; text-align: center;">{{$msg}}</div><br>    
                @endforeach
                    @php
                        unset($_SESSION['ERROR_MESSAGE'])
                    @endphp               
                @endif
                <select name="category" class="form-control form-select">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ ($post->cat_id === $category->id) ? 'selected' : '' }}>{{ $category->category }}</option>               
                    @endforeach
                </select><br>
                <input type="text" name="post_title" placeholder="Title" class="form-control" value="{{ $post->title }}"><br>
                <textarea name="post_description" placeholder="Description" colls="30" rows="10" class="form-control">{{ $post->description }}</textarea><br>
                Izaberite sliku : 
                <input type="file" name="file"><br><br>
                <button type="submit" name="editBtn" class="form-control btn btn-warning">Edit</button>
            </form>
        </div>
    </div>
</div>

@endsection