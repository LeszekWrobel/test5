<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;




class PostsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // return('PostContr');
      $posts = Post::all();
       $posts = Post::paginate(3);
     return view('welcome', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::all();
        return view('create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $attributes =  request()->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            //'image' => ['image','nullable','max:1999']
           // 'image' => 'image|nullable|max:1999'
        ]);
        //$auth_id = Users::users()->id;
         $post = new Post;
        $post->title = request('title');
        $post->description = request('description');
      //  $post->image = request('image');
        $post->user_id = $auth_id;// Auth::user()->id;//$auth_id;//users()->id();//Auth::users()->id();
       $post->save();
      //   $attributes['user_id'] = auth()->id();
      //Post::create($attributes);

       return redirect('/posts')->with('message', 'Your data updated successfully');
;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
