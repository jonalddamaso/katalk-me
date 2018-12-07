<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\App\Comment;
use Auth;
use Session;


class CommentController extends Controller
{
    public function index(Request $request) {
    	

    	$comment = new App\Comment;
    	$comment->comment = $request->comment;
    	$comment->user_id = Auth::user()->id;
    	$comment->post_id = $request->post_id;
    	$comment->save();

    	Session::flash('success', 'Your comment was successfully added');
        $comments = App\Comment::orderBy('id', 'DESC')->get();
    	return redirect()->back()->with(compact('comments'));
    }
}
