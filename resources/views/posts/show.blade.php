@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Ogłoszenie {{$post->id}}</h1>

                    @if(!Auth::guest())
                        @if(Auth::user()->id == $post->user_id)
                            <a class="btn-sm btn-primary " href="{{ $post->id }}/edit" >Edytuj</a>
                        @endif
                    @endif

                </div>

                <div class="card mb-3" style="">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{$post->image}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title">{{$post->title}}</h3>
                                
                                <p class="card-text">{{$post->description}}</p>
                                     <div class="card-body">
                                         <p class="card-text"><small class="text-muted">Dodano : {{$post->updated_at}} <br/>
                                         Ostatnia aktualizacja : {{$post->created_at}}</small></p>
                                       
                                         <a href="{{ route('index') }}" class="btn btn-outline-dark btn-sm shadow p-1 mb-5">Wróć do       ogłoszeń</a>

                                         <div class="g-3 d-grid gap-2 d-md-block">

                                           
                                           
                                          
                                        </div>
                                        
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
