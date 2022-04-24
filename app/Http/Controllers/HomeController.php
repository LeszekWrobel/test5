<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    
    public function __construct()
    {
        $this->middleware('auth');
    }
 */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
    {
       // dd(Auth::id());
      // return('HomeController');
       if (! auth()->check()) {return redirect()->route('login')->withErrors(['Musisz być zalogowany']);}

     $posts = Post::all();
      //$posts = Post::paginate(3);
     
       $posts = Post::latest()->where('user_id', auth()->user()->id)->paginate(3);
     //$posts = Post::latest()->limit(5)->get();
      return view('welcome', compact('posts'));
    }
}
