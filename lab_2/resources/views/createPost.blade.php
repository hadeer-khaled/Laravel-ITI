@extends("layouts.app")

@section("content")
    <h1>Create Post</h1>
    <div class="container w-50">
        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="body">Body:</label>
                    <textarea class="form-control" id="body" name="body"></textarea>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user_name">Select User:</label>
                    <select class="form-control" id="user_name" name="user_name">
                        @foreach($users as $user)
                            <option value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
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
