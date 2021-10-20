@extends('layouts.main')
    @section('title', 'Home')
    @section('content')
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        Latest Articles
      </h3>
      @foreach ($posts as $post)
      <article class="blog-post">
        <div class="post-thumb">
          <a href="{{ route('posts.show', ['post' => $post]) }}"><img style="width: 728px" src="{{ productImage($post->image) }}" class="img-fluid rounded" alt=""></a>
        </div>
        <div class="spacer"></div>
        <a class="blog-post-title" href="{{ route('posts.show', ['post' => $post]) }}"><h2>{{ $post->title }}</h2></a>
        <p class="blog-post-meta">{{ date('F d, Y', strtotime($post['created_at'])) }} by <a href="#">{{ $post->author }}</a></p>

        <p>{{ strip_tags(substr($post->body, 0, 250)) }}</p>
        <a href="{{ route('posts.show', ['post' => $post]) }}" class="btn btn-primary">Read More</a>
        <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-secondary">Edit</a>
        <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}" class="d-inline">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">Delete</button>
        </form>
        <hr><br>
        
      </article>
      @endforeach
            
      
            
      {{ $posts->links() }}
      {{-- <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
      </nav> --}}
    @endsection
</body>
</html>