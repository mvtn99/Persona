<div class="p-4 p-md-5 mb-4 text-white rounded bg-dark hero-box" style="background-image: url({{ productImage($top3[0]->image) }})">
  <div class="col-md-6 px-0">
    <h1 class="display-4 fst-italic">{{ $top3[0]->title }}</h1>
    <p class="lead my-3">{{ strip_tags(substr($top3[0]->body, 0, 180)) }}</p>
    <p class="lead mb-0"><a href="{{ route('posts.show', ['post' => $top3[0]]) }}" class="text-white fw-bold">Continue reading...</a></p>
  </div>
</div>

<div class="row mb-2">
  <div class="col-md-6">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-primary">World</strong>
        <h3 class="mb-0">{{ $top3[1]->title }}</h3>
        <div class="mb-1 text-muted">{{ date('F d', strtotime($top3[1]->created_at)) }}</div>
        <p class="card-text mb-auto">{{ strip_tags(substr($top3[1]->body, 0, 80)) }}</p>
        <a href="{{ route('posts.show', ['post' => $top3[1]]) }}" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img src="{{ productImage($top3[1]->image) }}" class="img-fluid h-100 img-thumbnail" width="200" height="500" focusable="false">

      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success">Design</strong>
        <h3 class="mb-0">{{ $top3[2]->title }}</h3>
        <div class="mb-1 text-muted">{{ date('F d', strtotime($top3[2]->created_at)) }}</div>
        <p class="mb-auto">{{ strip_tags(substr($top3[1]->body, 0, 80)) }}</p>
        <a href="{{ route('posts.show', ['post' => $top3[1]]) }}" class="stretched-link">Continue reading</a>
      </div>
      <div class="col-auto d-none d-lg-block">
        <img src="{{ productImage($top3[2]->image) }}" class="img-fluid h-100 img-thumbnail" width="200" height="250" focusable="false">

      </div>
    </div>
  </div>
</div>