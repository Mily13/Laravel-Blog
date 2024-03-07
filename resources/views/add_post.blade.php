@extends('app')

@section('title', 'New')
@section('body-class', 'new-body')

@section('content')

    <h2 id="add-header" class="text-center text-white">Create your new Blog post</h2>

    @if ($errors->any())
        <div class="alert alert-danger my-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
            <div>{{ session('success') }}</div>
    @endif

    <div id="add-form-container">
        <form id="add-form" method="POST" action="{{ route('store-post') }}">
            @csrf
            <div id="add-title" class="form-item">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" maxlength="100" value="{{ old('title') }}" required>
            </div>
            <div id="add-content" class="form-item">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="5" maxlength="4000" required>{{ old('content') }}</textarea>
            </div>
            <div id="add-content" class="form-item">
                <label for="select2">Tags:</label>
                <select id="select2" class="js-example-responsive" name="tags[]" multiple="multiple" style="width: 75%">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="add-button" type="submit" class="btn btn-warning">Create</button>
        </form>
    </div>

@endsection
