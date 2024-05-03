@extends("layouts.app")
@section("content")
<h1 > All posts </h1>
<div class = "container" style="postition:relative">

<a href="{{route('post.create' )}}" class="btn btn-success" style="postition:absolute right:0px">Add  </a>  
<form action="{{ route('post.restore') }}" method="POST">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-success mt-3">Restore Soft Deleted Posts</button>
    </form>
                  
<table class='table'> <tr> 
        <td> ID </td>
        <td> Created by </td>
        <td> Title </td> 
        <td> Title Slug </td> 
        <td> Body</td>
        <td> Created by</td>
        <td> Show</td>
        <td> Edit</td>
        <td> Delete</td>
        @foreach($posts as $post)
            <tr>
                <td> {{$post['id'] }}</td>
                <td> {{ $post->created_at->toFormattedDateString() }}</td>
                <td> {{$post['title'] }}</td>
                <td> {{$post['title_slug']}}</td>
                <td> {{$post['body']}}</td>
                <td> {{$post['posted_by']}} : {{$post->posted_by ? $post->user->name : "no creator"}}</td>
                <td> 
                    <a href="{{route('post.show',$post['id'] )}}" class="btn btn-info">Show  </a>
                </td>  
                @can('update', $post)  
                <td> 
                    <a href="{{route('post.edit',$post['id'] )}}" class="btn btn-warning">Edit  </a>
                </td> 
                @else
                    <td> You cannot edit this track </td>
                @endcan
                  
                @can('delete', $post)
                <td> 
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" value = "delete" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                @else
                    <td> You cannot delete this track </td>
                @endcan
                  
            </tr>

        @endforeach

    </table>
    {{ $posts->links() }}

</div>

@endsection