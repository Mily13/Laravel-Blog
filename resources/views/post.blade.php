@extends('app')

@section('title', 'Post')
@section('body-class', 'post-body')

@section('content')

    <div id="post-container">
        <div id="post-image">
            <img src="{{ asset('images/SD_Blog.jpg') }}" class="card-img" alt="Picture">
        </div>
        <div id="post-content">
            <div class="post-title">
                <h3>{{ $post->title }}</h3>
            </div>
            <div class="post-content">
                <p>{{ $post->content }}</p>
            </div>
            <div class="content-tags">
                <b>Tags:</b>
                @foreach ($post->tags as $tag)
                    <p>{{ $tag->name}}</p>
                @endforeach
            </div>
        </div>
    </div>

@endsection
