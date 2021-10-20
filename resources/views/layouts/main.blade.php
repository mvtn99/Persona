<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="{{ asset('js/bootstrap.bundle.js') }}" defer></script>
    <title>Persona | @yield('title')</title>
</head>
<body>
@include('partials.header')
<main class="container">
@include('flash::message')
@includeWhen(currentRoute() == 'home', 'hero', ['status' => 'complete'])
<div class="row g-5">
    <div class="col-md-8">
        @yield('content')
    </div>    
    @include('partials.sidebar')
</div>
</main>
@include('partials.footer')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@yield('extra-js', '')
</body>
</html>