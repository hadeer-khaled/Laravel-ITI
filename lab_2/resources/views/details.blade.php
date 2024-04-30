@extends("layouts.app")

@section("content")
<div class="container w-50">
    <h1>Post Details</h1>
    <p> <span class="fw-bold">  Post Title: </span> {{$post->title}}</p>
    <p> <span class="fw-bold">  Post Body: </span> {{$post->body}}</p>
    </div>

@endsection
