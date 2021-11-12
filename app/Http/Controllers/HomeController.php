<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $top3 = Post::orderBy('likes', 'desc')->take(3)->get();
        $post = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('home', ['posts' => $post, 'top3' => $top3]);
        // $post_count = $post = Post::where('title', 'Lorem')->count();
        // $post = Post::all();
        // $post = Post::find(1); // finds id=1
        // $post = Post::findOrFail(1); // finds id=1 or not found if it doesn't exist
        // $post = Post::where('title', 'Lorem')->get();
        // $post = Post::where('title', 'Lorem')->where('id', 1)->get(); //both should be true
        // $post = Post::where('title', 'Lorem')->orWhere('id', 2)->get(); //matching with one condition is enough
        // $post = Post::where('title', 'Lorem')->take(1)->get(); //gives only one result
        // $post = Post::where('id', '>', '0')->latest()->get(); //the latest results
        // $post = Post::where('title', 'like', '%ore%')->latest()->get(); //using LIKE
        // return View('posts', ['name' => 'index', 'content' => $post]);
        // return View('posts', ['name' => 'index', 'content' => 'All Posts']);
    }

}
