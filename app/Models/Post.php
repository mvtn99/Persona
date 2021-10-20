<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Searchable
{
    use HasFactory;
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getSearchResult(): SearchResult
    {
        // $url = route('home', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            // $url
        );
    }
}
