@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row d-flex">
        <div class="col-12">
            <h2>Add New Post</h2>
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-12">
            <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group my-3">
                    <label for="control-label">
                        Title
                    </label>
                    <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="{{ old('title') ?? $post->title }}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="control-label">
                        Author
                    </label>
                    <input type="text" class="form-control" placeholder="Author" id="author" name="author" value="{{ old('author') ?? $post->author }}">
                    @error('author')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label class="control-label">Categories</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-3">
                    <div class="control-label">Tags</div>
                    @foreach($tags as $tag)
                    <div class="form-check d-flex @error('tags') is-invalid @enderror">
                        <input type="checkbox" value="{{ $tag->id }}" class="m-2 shadow" name="tags[]" id="tag_{{ $tag->id }}" @if($post->tags->contains($tag->id)) checked @endif>
                        <label for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
                    @endforeach
                    @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <label for="content" class="control-label">Content</label>
                    <textarea class="form-control" placeholder="Content" id="content" name="content">{{ old('content') ?? $post->content }}</textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <button type="submit" class="btn btn-sm btn-secondary">
                        Save Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection