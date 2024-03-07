@extends('app')

@section('title', 'Posts')
@section('body-class', 'posts-body')

@section('content')

<div class="filter-container">
    <button id="filter-button" class="btn btn-outline-light mb-3">
        Filter Blogs<i class="bi bi-caret-down-fill ms-1"></i>
    </button>

    <div id="collapsing-form">
        <form id="filter-form" method="GET" action="{{ route('filter-post') }}">
            @csrf
            <div class="tags-filter">
                <label for="select2"><b>Tags:</b></label>
                <select id="select2" class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width: 100%">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" @selected(in_array($tag->id, $filterTags))>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="submit-filter-button">
                <button type="submit" class="btn btn-outline-dark">Filter<i class="bi bi-search ms-2"></i></button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <i id="close-alert-button" class="bi bi-x-square-fill"></i>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-warning">
        {{ session('error') }}
        <i id="close-alert-button" class="bi bi-x-square-fill"></i>
    </div>
@endif

<div id="posts-container">
    @foreach ($posts as $post)
        <div class="post">
            <div class="left-content">
                <div class="image">
                    <img src="{{ asset('images/SD_Blog.jpg') }}" class="image" alt="Blog Picture">
                </div>
                <div class="content-buttons">
                    <form method="POST" action="{{ route('delete-post', ['id' => $post->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <form method="GET" action="{{ route('edit-post', ['id' => $post->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-warning">Modify</button>
                    </form>
                </div>
            </div>
            <div class="content">
                <div class="content-title">
                    <h3><a href="{{ route('show-post', ['id' => $post->id]) }}">{{ $post->title }}</a></h3>
                </div>
                <div class="content-content">
                    <p>{{ substr($post->content, 0, 300) . "..." }}</p>
                </div>
                <div class="content-tags">
                    <b>Tags:</b>
                    @foreach ($post->tags as $tag)
                        <p>{{ $tag->name}}</p>
                    @endforeach
                </div>
                <div class="mobile-content-buttons">
                    <form method="POST" action="{{ route('delete-post', ['id' => $post->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <form method="GET" action="{{ route('edit-post', ['id' => $post->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-warning">Modify</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
