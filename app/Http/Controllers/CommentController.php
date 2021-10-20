<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required'
        ]);

        $comment = new Comment();
        $comment->name = $validated_data['name'];
        $comment->email = $validated_data['email'];
        $comment->body = $validated_data['body'];
        $comment->post_id = $request->post_id;
        $comment->save();
        flash('Your Comment Submited')->success();
        return back();
    }
}
