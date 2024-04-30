@extends("layouts.app")

@section("content")
<div class="container w-50">
    <h1>Post Details</h1>
    <div class="card" style="width: 18rem;">
            <img height="300"
                src="{{asset('images/'.$post->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">Post Body:{{$post->body}}</p>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back to all Posts </a>
        </div>

@endsection
