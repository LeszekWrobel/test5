<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use App\Models\User;

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
        //return view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {/*
         $attributes =  request()->validate([
            'image_path' => ['required','mimes:jpg,png,jpeg']
        ]);

        $images = new Images::
        if ($request->image_name)
        $newImageName = request('user_id').'-'.time().'-'.request('image_path')->getClientOriginalName();
        $post->image_path = $newImageName;
        $request->image_path->move(public_path('images_path'), $newImageName);
        // $post->save();

        public function schooldetailviewid(Request $request)
{ 
   
    $school_id = $request->get('id');

    return view("viewdeatil/school_id=$school_id", compact('school_id'));
}
*/
        if ($request->hasFile('image_path'))
        {
          $image_path = $request->file('image_path');
          foreach ($image_path as $files)
          {
             //$posts = Post::all();
              $post_id = $request->get('post_id');
              $destinationPath = public_path('images_path');
              $user_id = auth()->user()->id;
              $file_name = $user_id.'-'.time().'-'.$files->getClientOriginalName();
              $files->move($destinationPath, $file_name);
              $data[] = $file_name;
             ;
          }
      }
      //dd($data  );
      $file= new Post();
      $file->name=json_encode($data);
      //dd( $file->name);
      $file->name->save();

       return back()->withSuccess('Great! Image has been successfully uploaded.');
       // return redirect()->action([PostController::class, 'index'])->with('status', 'Your post  "'.($post->title).'" created successfully !');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
