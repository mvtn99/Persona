<?php

use Illuminate\Support\Facades\Route;

function currentRoute()
{
    $name = Route::currentRouteName();
    return $name;
}

function productImage($path)
{
    return $path && file_exists('storage/posts/' . $path) ? asset('storage/posts/' . $path) : asset('img/not-found.png');
}
