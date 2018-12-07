<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\Like;
use Auth;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $posts = Post::paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        Post::create($request->all());

        return redirect('/profile/{username}');

        // Post::create([
        //     'user_id' => Auth::user()->id,
        //     'content' => $request->content,
        //     'live' => $request->live,
        //     'post_on' => $request->post_on
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::orderBy('created_at', 'desc')->get();
        $post = Post::findOrFail($id);
       
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
       
       return view('posts.edit', compact('post'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if( ! isset($request->live))
            $post->update(array_merge($request->all(), ['live' => false]));
        else
            $post->update($request->all());

        return redirect('/profile/{username}');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // $post = Post::findOrFail($id);
         // $post->delete();
        Post::destroy($id);

         return redirect('/profile/{username}');
    }

    public function likePost(Request $request) {
        dd('$request');
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);

        if (!$post) {
            return null;
        }

        $user = Auth::user();
        $like = $user()->where('post_id', $post_id)->first();
        if($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like){
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();

        }

        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;

        if ($update){
            $like->update();
        } else {
            $like->save();
        }

        return null;
    }
}

