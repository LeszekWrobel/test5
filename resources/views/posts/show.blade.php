@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @include ('inc/messages')
                    <div class="row" >
                        <h5>Ogłoszenie nr {{$post->id}}</h5>
                        @if(!Auth::guest())
                            @if(Auth::user()->id == $post->user_id)
                                <div class="d-grid gap-2 d-md-block text-end">
                                    <a class="btn btn-outline-dark " href="{{ route('image.create') }}?post_id={{$post->id}}" >
                                        Add images
                                    </a>
                                    <a class="btn btn-outline-primary" href="{{ $post->id }}/edit" >
                                        Edit
                                    </a>
                                
                                    <!--       <form method="POST" action="{{route('posts.destroy',$post->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" onclick="return confirm('Chcesz usunąć post ?')" class="btn btn-outline-danger">Delete</button> 
                                            </form>
                                                        -->
                                        <a href="{{route('posts.destroy',$post->id)}}" class="btn btn-outline-danger" onclick="
                                        var result = confirm('Are you sure you want to delete this record?');

                                        if(result){
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{$post->id}}').submit();
                                        }">
                                        Delete
                                    </a>

                                    <form method="POST" id="delete-form-{{$post->id}}" action="{{route('posts.destroy',$post->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card" style="">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-body">
                                <img src="{{asset('images_path/'.$post->image_path)}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-body">
                                <h3 class="card-title">{{$post->title}}</h3>
                                <p class="card-text">{{$post->description}}</p>
                                <p class="card-text"><small class="text-muted"> Ostatnia aktualizacja : {{$post->created_at}}      Dodano : {{$post->updated_at}}</small></p>
                                <a href="{{ route('index') }}" class="btn btn-outline-dark btn-sm shadow p-1 mb-1">
                                Wróć do ogłoszeń
                                </a>
                            </div>
                        </div>
                    </div>
                    @if (is_dir($filename)) 
                        @foreach($files as $file)
                            <div class="text-center m-3 ">
                                <img src="{{asset('images_path/'.$post->id.'/'.$file->getFilename())}}" class="img-fluid" alt="">
                            </div>
                          <!--  @if(!Auth::guest()) -->
                                @if(Auth::user()->id == $post->user_id || auth()->user()->is_admin == 1)
                                    <div class="m-2 text-center ">
                                        <form method="POST" action="{{route('image.update',$post->id)}}?file_name={{$file->getFilename()}}">
                                            @method('PATCH')
                                            @csrf
                                            <button type="submit"
                                                    onclick="return confirm('Chcesz usunąć post ?')"
                                                    class="btn btn-outline-danger">
                                                    Delete image
                                            </button>
                                        </form>
                                    </div>
                                @endif
                          <!--  @endif -->
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
