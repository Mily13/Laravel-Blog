@extends('app')

@section('title', 'Edit')
@section('body-class', 'edit-body')

@section('content')

    <h2 id="edit-header" class="text-center text-white">Modify Blog post</h2>

    @if ($errors->any())
        <div class="alert alert-danger my-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="edit-form-container">
        <form id="edit-form" method="POST" action="{{ route('update-post', ['id' => $post->id]) }}">
            @csrf
            <div id="edit-title" class="form-item">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" maxlength="100" value="{{ $post->title }}" required>
            </div>
            <div id="edit-content" class="form-item">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="5" maxlength="4000" required>{{ $post->content }}</textarea>
            </div>
            <div id="edit-content" class="form-item">
                <label for="select2">Tags:</label>
                <select id="select2" class="js-example-responsive" name="tags[]" multiple="multiple" style="width: 75%">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->name }}" @selected(in_array($tag->id, $recentTags))>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button id="edit-button" type="submit" class="btn btn-warning">Modify</button>
        </form>
    </div>
    
@endsection
