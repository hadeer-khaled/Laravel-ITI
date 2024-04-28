@extends("layouts.app")
@section("content")
<h1 style="background-color: white;"> All posts </h1>
    <table class='table'> <tr> 
        <td> ID </td>
        <td> Title </td> 
        <td> Content</td>
        @foreach($posts as $post)
            <tr>
                <td> {{$post['id'] }}</td>
                <td> {{$post['title']}}</td>
                <td> {{$post['content']}}</td>

            </tr>

        @endforeach

    </table>
@endsection