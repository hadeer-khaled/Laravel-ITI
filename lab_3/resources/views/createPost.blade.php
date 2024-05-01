@extends("layouts.app")

@section("content")
    <h1>Create Post</h1>

    <div class="container w-50">
        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title"   value="{{old('title')}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="body">Body:</label>
                    <textarea class="form-control" id="body" name="body"  value="{{old('body')}}"></textarea>
                    @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="posted_by">Posted_by:</label>
                    <select class="form-control" id="posted_by" name="posted_by">
                        @foreach($users as $user)
                            <option value="{{ $user->name }}" {{ old('posted_by') == $user->name ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('posted_by')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
