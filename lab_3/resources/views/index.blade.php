@extends("layouts.app")
@section("content")
<h1 > All posts </h1>
<div class = "container" style="postition:relative">

<a href="{{route('post.create' )}}" class="btn btn-success" style="postition:absolute right:0px">Add  </a>
    <table class='table'> <tr> 
        <td> ID </td>
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
                <td> {{$post['title'] }}</td>
                <td> {{$post['title_slug']}}</td>
                <td> {{$post['body']}}</td>
                <td> {{$post['posted_by']}}</td>
                <td> 
                    <a href="{{route('post.show',$post['id'] )}}" class="btn btn-info">Show  </a>
                </td>    
                <td> 
                    <a href="{{route('post.edit',$post['id'] )}}" class="btn btn-warning">Edit  </a>
                </td>  
                <td> 
                   
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" value = "delete" class="btn btn-danger">Delete</button>
                    </form>

                </td>

            </tr>

        @endforeach

    </table>
    {{ $posts->links() }}

</div>

@endsection