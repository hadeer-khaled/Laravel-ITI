@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $user['name'] }}</h5>
                    <p class="card-text">{{ $user['email'] }}</p>

                    {{-- <p>Created {{$user->getCreatedAt()}}</p> --}}
                </div>

            </div>
        </div>

        <div class="mt-4">
                <h2>Posts</h2>
                @if ($user->posts->count() > 0)
                        <div class="row">
                        @foreach ($user->posts as $post)
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->body }}</p>
                                    </div>

                                </div>
                                @endforeach
                            </div>
                @else
                    <p>No Posts available.</p>
                @endif
                </div>
            </div>
</div>
@endsection