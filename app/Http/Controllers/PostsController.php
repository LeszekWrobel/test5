<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
 use File;


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
           
             'image_path' => ['required','mimes:jpg,png,jpeg','max:5048']
           // 'image' => 'image|nullable|max:1999'
        ]);
       

        $post = new Post;
        $post->title = request('title');
        $post->description = request('description');
        //$post->image_path = request('image_path');
        $post->user_id = request('user_id');//$post->user_id = auth()->user()->id; // moved to view
        $newImageName = request('user_id').'-'.time().'-'.request('image_path')->getClientOriginalName();//.'.'.request('image_path')->guessExtension();
        $post->image_path = $newImageName;
        $post->save();

        $request->image_path->move(public_path('images_path'), $newImageName);
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
    $post_id = $post->id;

    //$files = File::files(public_path('images_path/'.$post_id));

    // If you would like to retrieve a list of 
    // all files within a given directory including all sub-directories
    $filename = public_path('images_path/'.$post_id);
    if (is_dir($filename)) { 
    $files = File::allFiles(public_path('images_path/'.$post_id));
    }else{ $files = null;}

    return view('posts.show',compact('post','files','filename'));
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
       $attributes =  request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'image_path' => ['required','max:5048']
             ]);
  
       $newImageName = auth()->user()->id.'-'.time().'-'.request('image_path');//.'.'.request('image_path')->guessExtension();
       $post->image_path = $newImageName;
       $post->update(request(['title','description','image_path']));
    //    $request->image_path->move(public_path('images_path'), $post->image_path);
    // $request->image_path->move(public_path('images_path'), $newImageName);
    //dd(($request->hasFile('image_path')));
    if ($request->hasFile('image_path')) {
    $destinationPath = public_path('images_path');//'path/th/save/file/';
    $files = $request->file('image_path'); // will get all files
    // dd($files->getClientOriginalName());
  //  foreach ($files as $file) {//this statement will loop through all files.
        $file_name = $files->getClientOriginalName(); //Get file original name
        $files->move($destinationPath , $file_name); // move files to destination folder
    }

  /*
      $destinationPath = public_path('images_path');
              $user_id = auth()->user()->id;
              $file_name = $user_id.'-'.time().'-'.$file->getClientOriginalName();
              $file->move($destinationPath, $file_name);
*/
    //dd($request->image_path);
     // $request->image_path->move(public_path('images_path'),$newImageName);
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
