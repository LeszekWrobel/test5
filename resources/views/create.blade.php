@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Dodaj ogłoszenie</h1></div>
               
                <div class="card-body">

                @include('inc/messages')
                   
                        <form class="row m-3" method="POST" action="/posts" enctype="multipart/form-data">
                        {{csrf_field()}}
                                              

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label">Tytuł</label>

                                <input id="title" type="text"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" value="{{old('title')}}">

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="textarea" class="col-md-4 col-form-label">Opis</label>

                                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : ''}}" name="description" id="floatingTextarea2" style="height: 100px">{{old('description')}}</textarea>
  
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row g-3">
                                <label form="image_path">Dodaj zdjęcie</label>
                                <input id="image_path" type="file"
                                class="form-control{{ $errors->has('image_path') ? ' is-invalid' : ''}}" name="image_path">

                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="g-3">
                                <button class="btn btn-primary" type="submmit">Dodaj</button>
                            </div>
                        </form>
                @include ('inc/messages')

                
            </div>
        </div>
    </div>
</div>
@endsection
