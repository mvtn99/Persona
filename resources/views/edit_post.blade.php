@extends('layouts.admin')
@section('content')
<div class="col-9 mx-auto">
    <div class="container">
        <div class="my-4">
            <h2>Edit Post</h2>
        </div>
        <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="my-4">
                <label for="category" class="form-label">Title:</label>
                <input name="title" type="text" class="form-control" id="category" value="{{ $post->title }}">
                @error('title')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="my-4">
                <label for="author" class="form-label">Author:</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $post->author }}">
                @error('author')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="my-4">
                <label for="body" class="form-label">Write your post:</label>
                <textarea name="body" style="resize: none;" class="form-control h-100" id="body" rows="18">{{ $post->body }}</textarea>
                @error('body')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <img class="img-fluid" src="{{ productImage($post->image) }}" alt="">
            <div class="my-4">
                <label for="image" class="form-label">Upload an image:</label>
                <input name="image" type="file" class="form-control" id="image">
                @error('image')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
</div>
<br><br>
<script>
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection