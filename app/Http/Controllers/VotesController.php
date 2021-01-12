<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class VotesController extends Controller
{
    public function upvote(Request $request)
    {
        $post_id = $request->input('id');
        $upvotesOb = DB::table('posts')
        ->select('upvotes')
        ->where('id', "$post_id")
            ->first();
        $upvotes = $upvotesOb->upvotes;
        $upvotes += 1;
        DB::update("update posts set upvotes = $upvotes where id = ?",["$post_id"]);

        if( $request->input('show') )
        {
            $post = Post::find($post_id);
            return redirect("/posts/$post_id")
            ->with('post', $post)
            ->with('success', 'Upvoted');
        }
        else
            return redirect('/posts')->with('success', 'Upvoted');
    }
    public function downvote(Request $request)
    {
        $post_id = $request->input('id');
        $downvotesOb = DB::table('posts')
        ->select('downvotes')
        ->where('id', "$post_id")
            ->first();
        $downvotes = $downvotesOb->downvotes;
        $downvotes += 1;
        DB::update("update posts set downvotes = $downvotes where id = ?",["$post_id"]);

        if( $request->input('show') )
        {
            $post = Post::find($post_id);
            return redirect("/posts/$post_id")
            ->with('post', $post)
            ->with('success', 'Downvoted');
        }
        else
            return redirect('/posts')->with('success', 'Downvoted');
    }
}
