@extends("layouts.app")

@section("content")
    <h1>Edit Post</h1>
    <form action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{$post['title']}}"><br>
        
        <label for="body">Body:</label><br>
        <textarea id="body" name="body">{{$post['body']}}</textarea><br>
        
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>
        
        <button type="submit">Submit</button>
    </form>
@endsection