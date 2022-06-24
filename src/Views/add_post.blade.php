@extends('layouts/app')

@include('partials.navbar_post')

@section('content')

<div class="jumbotron text-center">
    <h4>Dodajte Post</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <form action="/blog/add_post" method="POST" enctype="multipart/form-data">

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
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
                </select><br>
                <input type="text" name="post_title" placeholder="Title" class="form-control" value="<?php echo isset($_SESSION['title']) ? $_SESSION['title'] : ''; ?>" @php unset($_SESSION['title']) @endphp><br>
                <textarea name="post_description" placeholder="Description" colls="30" rows="10" class="form-control"><?php echo isset($_SESSION['description']) ? ($_SESSION['description']) : ''; ?> @php unset($_SESSION['description']) @endphp</textarea><br>
                Izaberite sliku : 
                <input type="file" name="file"><br><br>
                <button type="submit" name="postSubBtn" class="form-control btn btn-primary">Dodaj</button>
            </form>
        </div>
    </div>
</div>

@endsection