<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use App\Models\User;
use App\Http\Controllers\PostsController;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // url:/viewdeail?post_id=2
        $post_id = request()->get('post_id');
        return view('image.create', compact('post_id'));
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
            'image_path' => ['required','max:5048']
        ]);

        $data = [];
        if ($request->hasFile('image_path'))
        {
          $image_path = $request->file('image_path');
          foreach ($image_path as $file)
          {
            //$posts = Post::all();
              $post_id = $request->get('post_id');
              $destinationPath = public_path('images_path/'.$post_id);
              $user_id = auth()->user()->id;
              $file_name = $user_id.'-'.$post_id.'-'.time().'-'.$file->getClientOriginalName();
              $file->move($destinationPath, $file_name);
              $data[] = $file_name;
             ;
          }
        }
        $post = $request->get('post_id');
        return redirect()->route('posts.show', ['post' => $post])->with('success', 'Images added successfully !');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       $file_name = $request->get('file_name');
       unlink('images_path/'.$id.'/'.$file_name);
        //return back()->with('status', 'Your immage has been deleted successfully !');
        // return redirect()->action([PostsController::class, 'show'])->with('status','Post "'.($post->title).'" deleted successfully !');
       return redirect()->route('posts.show', ['post' => $id])->with('success', 'Image '.$file_name.' deleted successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
