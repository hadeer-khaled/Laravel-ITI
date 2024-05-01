@extends("layouts.app")

@section("content")
    <h1>Edit Post</h1>
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="{{ $post->title }}"><br>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <label for="body">Body:</label><br>
        <textarea id="body" name="body">{{ $post->body }}</textarea><br>
        @error('body')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="posted_by">Select User:</label>
                <select class="form-control" id="posted_by" name="posted_by">
                    @foreach($users as $user)
                        <option value="{{ $user->name }}" {{ $post->posted_by == $user->name ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('posted_by')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image"><br>
        
        <button type="submit" class="btn btn-info mt-3">Submit</button>
    </form>
@endsection
