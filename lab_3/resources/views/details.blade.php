@extends("layouts.app")

@section("content")
<div class="container">
    <h1>Post Details</h1>
    <div class="d-flex flex-row justify-content-between">

    <div class="card" style="width: 25rem;">
            <img height="300"
                src="{{asset('images/'.$post->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">Post Body:{{$post->body}}</p>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">Back to all Posts </a>
    </div class="comments-section">
    <div >

   
    <div class="mt-4">
        <h2>Comments</h2>
        @if ($post->comments->count() > 0)
            <ul class="list-group">
                @foreach ($post->comments as $comment)
                    <li class="list-group-item">{{ $comment->body }}</li>
                @endforeach
            </ul>
        @else
            <p>No comments available.</p>
        @endif
    </div>
    <form action="{{ route('comment.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="content" placeholder="Enter your comment"></textarea>
        <button type="submit" class="btn btn-success">Submit Comment</button>
    </form>
    </div>
    </div>
</div>
@endsection
