<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $post = Post::orderBy('created_at', 'desc')->paginate(5);
        // return view('home', ['title' => 'Home', 'posts' => $post]);
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
        return redirect(route('home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title' => 'required|unique:posts',
            'author' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        try {

            $post = new Post();
            $post->title = $validated_data['title'];
            $post->author = $validated_data['author'];
            $post->body = $validated_data['body'];
            if ($request->image) {
                $imagename = time() . '.' . $request->image->extension();
                $request->image->storeAs('public/posts', $imagename);
                $post->image = $imagename;
            }
            $post->save();
            flash('Your Post Submited')->success();
            return redirect('posts');
        } catch (\Exception $th) {
            flash('Post upload unsuccessful', 'danger');
            return redirect(route('posts.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $liked = session('liked');
        $comments = $post->comments()->latest()->get();
        return view('single', ['title' => 'Article', 'post' => $post, 'comments' => $comments, 'liked' => $liked]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('edit_post', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // return redirect(route('posts.edit', ['post' => $post]));
        $validated_data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->image) {
            $imagename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/posts', $imagename);
            $post->image = $imagename;
        }

        $post->title = $validated_data['title'];
        $post->author = $validated_data['author'];
        $post->body = $validated_data['body'];

        try {
            $post->save();
            flash('Post Edited')->success();
            return redirect('posts');
        } catch (\Exception $th) {
            flash('Post update unsuccessful', 'danger');
            return redirect(route('posts.edit', ['post' => $post]));
        }
    }

    // public function post_update(Request $request, Post $post)
    // {
    //     $validated_data = $request->validate([
    //         'title' => 'required',
    //         'author' => 'required',
    //         'body' => 'required',
    //         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    //     ]);

    //     if ($request->image) {
    //         $imagename = time() . '.' . $request->image->extension();
    //         $request->image->storeAs('public/posts', $imagename);
    //         $post->image = $imagename;
    //     }

    //     $post->title = $validated_data['title'];
    //     $post->author = $validated_data['author'];
    //     $post->body = $validated_data['body'];

    //     try {
    //         $post->save();
    //         flash('Post Edited')->success();
    //         return redirect('posts');
    //     } catch (\Exception $th) {
    //         flash($th->getMessage(), 'danger');
    //         return redirect(route('posts.edit', ['post' => $post]));
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        flash('Post Deleted')->success();
        return redirect('posts');
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');
        // $posts = Product::where('name', 'like', "%$query%")
        //                    ->orWhere('details', 'like', "%$query%")
        //                    ->orWhere('description', 'like', "%$query%")
        //                    ->paginate(10);

        $posts = (new Search())
            ->registerModel(Post::class, 'title', 'body', 'author')
            ->search($query);

        // dd($posts->all());
        return view('search', ['posts' => $posts->all()]);
    }
}
