@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Edytujesz ogłoszenie nr {{$post->id}}</h1>
                    <a class="btn btn-outline-dark" href="{{ URL::previous() }}" >return</a>
                </div>
                <div class="card-body">
           <!--         @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif -->
                        <form class="row m-3" method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                                              

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label">Tytuł</label>

                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" value="{{$post->title}}">

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="textarea" class="col-md-4 col-form-label">Opis</label>

                                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : ''}}" name="description" id="floatingTextarea2" style="height: 100px">{{$post->description}}</textarea>
  
                                <input type="hidden" name="user_id" value="">

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                             <div class="form-group row g-3">
                                <label form="image_path">Dodaj zdjęcie</label>
                                <input id="image_path" type="file"
                                class="form-control{{ $errors->has('image_path') ? ' is-invalid' : ''}}"
                                name="image_path"
                                value="{{$post->image_path}}">

                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                           
                            <div class="g-3">
                                <button class="btn btn-primary" type="submmit">Zapisz zmiany</button>
                            </div>
                        </form>
                @include ('inc/messages')

                
            </div>
        </div>
    </div>
</div>
@endsection
