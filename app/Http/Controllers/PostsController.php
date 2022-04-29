<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{/**
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = Post::all();
       $posts = Post::latest()->paginate(3);
       return view('welcome', compact('posts') , ['foo'=>'Twoje ogłoszenia']);
     
    }
/*
     public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->check()) {return redirect()->route('login')->withErrors(['Musisz być zalogowany']);}

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
            'description' => ['required', 'min:3'],
           
            //'image' => ['image','nullable','max:1999']
           // 'image' => 'image|nullable|max:1999'
        ]);
       
         $post = new Post;
        $post->title = request('title');
        $post->description = request('description');
      //  $post->image = request('image');
        $post->user_id = auth()->user()->id;
        $post->save();
        return redirect()->action([HomeController::class, 'index'])->with('status', 'Your post  "'.($post->title).'" created successfully !');
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
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       // $post = new Post::all();
       return view('posts/edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {/*
        $post = Post::find();
        $post->title = request('title');
        $post->description = request('description');
        $post->image = request('image');
        $post->user_id = auth()->user()->id;;
        $post->save();
*/
     
     $post->update(request(['title','description','image']));
      // return redirect('/posts')->with('status', 'Post updated!'); // works for status
      //  return redirect()->route('posts.index')->withErrors(['Your updated successfully']); // work for errors
      return redirect()->action([HomeController::class, 'index'])->with('status', 'Post "'.($post->title).'" updated successfully !');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->action([HomeController::class, 'index'])->with('status','Post "'.($post->title).'" deleted successfully !');
    }
}
