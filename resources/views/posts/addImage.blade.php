@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <h1>Dodaj zdjęcia</h1>
                <a class="btn btn-outline-dark" href="{{ URL::previous() }}" >return</a>
                </div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form class="row m-3" method="POST" action="/posts" enctype="multipart/form-data">
                        {{csrf_field()}}

                            <div class="mb-3">
                                  <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                                  <input class="form-control" type="file" id="formFileMultiple" multiple>
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
