@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row" >

                        <div class="col-5"><h1>Ogłoszenie {{$post->id}}</h1></div>

                        @if(!Auth::guest())
                            @if(Auth::user()->id == $post->user_id)

                                                             
                              
                                <div class="col-3 my-2 text-end">
                                    <a class="btn btn-outline-dark " href="{{ $post->id }}/edit" >Add images</a>
                                </div>
                                <div class="col-2 my-2 text-center ">
                                    <a class="btn btn-outline-primary" href="{{ $post->id }}/edit" >Edit</a>
                                </div>
                                <div class="col-2 mt-2 ">
                                     <form method="POST" action="{{route('posts.destroy',$post->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" onclick="return confirm('Chcesz usunąć post ?')" class="btn btn-outline-danger">Delete</button>
                                     </form>
                                </div>
                                 
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card mb-3" style="">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{$post->image}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body mt-3">
                                <h3 class="card-title my-4">{{$post->title}}</h3>
                                
                                <p class="card-text">{{$post->description}}</p>
                                     <div class="card-body">
                                         <p class="card-text"><small class="text-muted"> Ostatnia aktualizacja : {{$post->created_at}} <br/>
                                         Dodano : {{$post->updated_at}}</small></p>
                                       
                                         <a href="{{ route('index') }}" class="btn btn-outline-dark btn-sm shadow p-1 mb-5">Wróć do       ogłoszeń
                                         </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
