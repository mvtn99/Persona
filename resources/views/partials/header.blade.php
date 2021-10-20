{{-- <div class="container">
    
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="link-secondary" href="{{ url('posts/create') }}">Create New Post</a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="{{ url('posts') }}">Persona</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="link-secondary" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
          </a>
          <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
        </div>
      </div>
  </div> --}}


  
  <nav class="navbar navbar-light bg-light fixed-md-nowrap shadow mb-5 px-3">
    <a class="link-secondary btn btn-light btn-lp ms-4" href="{{ route('posts.create') }}">Create New Post</a>
    <a class="text-end blog-header-logo text-dark col-sm-3 col-md-2 me-2" href="{{ route('home') }}">
        <h1 class="display-4">Persona</h1>
    </a>
    <div class="pt-3" aria-label="Search">
      <form action="{{ route('search') }}" method="GET">
        <div class="input-group">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg></button>
          <input type="text" value="{{ request()->input('query') }}" class="form-control" name="query" placeholder="Search for product" required>
          @error('query')
            <small class="text-danger">
                {{ $message }}
            </small>
          @enderror
        </div>
      </form>
    </div>
</nav>

