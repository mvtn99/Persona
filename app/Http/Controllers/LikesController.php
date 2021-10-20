<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->params['type'] == 'like') {
            $post = Post::find($id);
            $post->likes++;
            $post->save();
            $request->session()->push('liked', $post->id);
            $liked = session('liked');
            session()->flash('success_message', 'Quantity was updated successfully!');
            return response()->json(['currentCount' => $post->likes, 'liked' => $liked, 'success' => true]);
        }

        if ($request->params['type'] == 'unlike') {
            $post = Post::find($id);
            $post->likes--;
            $post->save();
            $newLike = $request->session()->pull('liked');
            $newLike = array_diff($newLike, [$post->id]);
            $request->session()->put('liked', $newLike);
            $liked = session('liked');
            return response()->json(['currentCount' => $post->likes, 'liked' => $liked, 'success' => true]);
        }
    }
}
