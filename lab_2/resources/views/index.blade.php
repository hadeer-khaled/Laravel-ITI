@extends("layouts.app")
@section("content")
<h1 > All posts </h1>
<div class = "container" style="postition:relative">

<a href="{{route('post.create' )}}" class="btn btn-success" style="postition:absolute right:0px">Add  </a>
    <table class='table'> <tr> 
        <td> ID </td>
        <td> Title </td> 
        <td> Content</td>
        <td> Actions</td>
        @foreach($posts as $post)
            <tr>
                <td> {{$post['id'] }}</td>
                <td> {{$post['title']}}</td>
                <td> {{$post['body']}}</td>
                <td> 
                <a href="{{route('post.show',$post['id'] )}}" class="btn btn-info">Show  </a>
                |
                <a href="{{route('post.delete',$post['id'] )}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>

                </td>

            </tr>

        @endforeach

    </table>
</div>

@endsection