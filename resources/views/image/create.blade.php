@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row mt-3" >
                        <div class="col-5"><h1>Dodaj zdjęcia do posta {{$post_id}}</h1></div>

                            <div class="col-7 text-end">
                            <a class="btn btn-outline-dark "  href="{{ URL::previous() }}" >return</a>
                            </div>
               
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <!--
                             <div class="form-group row g-3">
                                <label form="image_path">Dodaj zdjęcie</label>
                                <input id="image_path" type="file"
                                class="form-control{{ $errors->has('image_path') ? ' is-invalid' : ''}}" name="image_path">
                            </div>-->


                                <form class="row m-3" method="POST" action="/image" enctype="multipart/form-data">
                                {{csrf_field()}}
                                    <input type="hidden" name="post_id" value="{{$post_id}}">
                                    <div class="mb-3">
                                          <label form="image_path" class="form-label">Multiple files input example</label>
                                          <input
                                                type="file"
                                                name="image_path[]"
                                                class="form-control{{ $errors->has('image_path') ? ' is-invalid' : ''}}"
                                                asset="image/*"
                                                multiple
                                           >

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
    </div>
</div>
@endsection
