@extends('layouts.main')
@section('title', 'Article')
@section('content')
<article class="blog-post">
    <div class="post-thumb">
      <img style="width: 728px" src="{{ productImage($post->image) }}" class="img-fluid rounded" alt="">
    </div>
    <div class="spacer"></div>
    <h2 class="blog-post-title">{{ $post['title'] }}</h2>
    <p class="blog-post-meta">{{ date('F d, Y', strtotime($post['created_at'])) }} by <a href="#">{{ $post->author }}</a></p>

    <p>{{ strip_tags($post->body) }}</p>
    
    
</article>
<hr>
<div class="post-bottom overflow">
  <div class="d-flex nav justify-content-between">
      <a href="#" class="nav-link"><i class="me-2 post-icon fa fa-tag"></i>Category</a>
      <div id="love-count" data-id="{{ $post->id }}" class="nav-link love-count"><i id="fa-heart" class="me-2 post-icon fa fa-heart"></i><span id="count">{{ $post->likes }}</span> Love</div>
      <a href="#" class="nav-link"><i class="me-2 post-icon fa fa-comments"></i>{{ $comments->count() }} Comments</a>
      <div class="spacer"></div>
  </div>
</div>
<hr>
<br>
<div class="col-md-12 bootstrap snippets">
  <div class="panel">
    <h2>Write Your Comment</h2>
    
      <div class="mar-top clearfix my-4 ps-3">
        <form method="POST" action="{{ route('comments.store', ['post_id' => $post->id]) }}">
          @csrf
          <div class="my-3">
            <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
          </div>
          <div class="my-3">
            <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
          </div>
          <div class="my-3">
            <textarea name="body" class="form-control mb-2" rows="5" placeholder="What are you thinking?">{{ old('body') }}</textarea>
            @error('body')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
          </div>
          <button class="btn btn-sm btn-primary pull-right" type="submit">Share</button>
        </form>
      </div>
      
    </div>
    <hr>
    @if ($comments->count() > 0)
      <div class="panel">
        <h2>Comments</h2>
        @foreach($comments as $comment)
        <div class="panel-body mt-4">
          <div class="media-block">
            <div class="media-body">
              <div class="mb-4">
                <span class="box-inline display-6">{{ $comment->name }}</span><small class="text-muted">&nbsp says:</small>
              </div>
              <p class="ms-3">{{ $comment->body }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
@section('extra-js')
    <script>
      (function(){
        var liked = @json(session('liked'));
        const classname = document.querySelector('#love-count')
        const count = document.querySelector('#count')
        const icon = document.querySelector('#fa-heart')
        const id = parseInt(classname.getAttribute('data-id'))
        
        

        classname.addEventListener('click', function() {
          if (!liked.includes(id)) {
            let type = 'like'
            axios.patch(`/posts/like/${id}`, {
              params: {
                type: type
              }
            })
            .then(function (response) {
              liked = response.data.liked
              count.innerHTML = response.data.currentCount
              icon.style.color = 'red'
            })
            .catch(function (error) {
              console.log(error)
            });
          }

          if (liked.includes(id)) {
            let type = 'unlike'

            axios.patch(`/posts/like/${id}`, {
              params: {
                type: type
              }
            })
            .then(function (response) {
              liked = response.data.liked
              count.innerHTML = response.data.currentCount
              icon.style.color = '#92929274'
            })
            .catch(function (error) {
              console.log(error)
            });
          }
        })
      })();
    </script>
@endsection