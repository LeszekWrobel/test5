@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <div class="row">

                         

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                       
                                {{ session('status') }}
                       
                            </div>
                        @endif

                        @include ('inc/messages')
                    
                        @if (request()->routeIs('index'))
                            <div class="col-8"><h1>{{ __('Ogłoszenia') }}</h1></div>
                            <div class="col-4 mt-2 text-end">   
                                <a href="{{ route('home') }}" class="btn btn-outline-dark" role="button">
                                 {{ $foo }}
                                </a>
                            </div>

                        @else
                            <div class="col-8"><h1>{{ __('Twoje Ogłoszenia') }}</h1></div>
                            <div class="col-4 mt-2 text-end">                     
                               <a class="btn btn-outline-dark" href="{{ route('posts.create') }}" role="button">Dodaj ogłoszenie</a>
                            </div>
                        @endif   
                    </div>
                </div>

                <div class="card-body">
                   
                        @foreach($posts as $post)

                        <div class="card mb-3" style="">
                          <div class="row g-0">
                            <div class="col-md-4">
                               <img src="{{$post->image}}" class="img-thumbnail w-50" alt="...">
                            </div>
                            <div class="col-md-8">
                              <div class="card-body">

                                <h3 class="card-title">{{$post->title}}</h3>
                                
                                <p class="card-text"><small class="text-muted">Dodano : {{$post->created_at}}<br/>
                                Ostatnia aktualizacja : {{$post->updated_at}}</small></p>

                                     <div class="row">
                                        <div class="col-6 my-2">
                                             <a href="posts/{{$post->id}}" class="btn btn-outline-dark btn-sm shadow p-1 mb-6  ">Zobacz szczegóły</a>
                                        </div>
                                         @if(auth()->check() && auth()->user()->is_admin == 1)
                                        <div class="col-3 my-2 text-end">
                                            <a class="btn btn-primary " href="posts/{{ $post->id }}/edit" >Edit</a>
                                        </div>
                                        <div class="col-3 mt-2 ">
                                            <!-- <form method="POST" action="{{route('posts.destroy',$post->id)}}"> -->
                                             <form onclick="return confirm('Chcesz usunąć post ?')" action="{{route('posts.destroy',$post->id)}}" method="POST">
        
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" >Delete</button>
                                             </form>
                                        </div>
                                         @endif
                                     </div>
                                
                              </div>
                            </div>
                          </div>
                        </div>

                        @endforeach

                        <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-center">                         
                                {{ $posts->links() }}
                          </ul>
                        </nav>      
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
