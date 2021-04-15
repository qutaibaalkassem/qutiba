<!doctype html>
<html lang="en">
  <head>
@extends('layouts.app')

@section('content')

    <title>إضافة منشور جديد</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/album.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="card mb-8 box-shadow">             
              <img class="card-img-top" src="{{asset('storage/'.$post->image_path)}}" alt="Card image cap">
              <div class="card-body" style="direction: rtl;">
                <form method="POST" action="{{route('post.update' , $post->id)}}">
                {{ csrf_field() }}
                  <input type="hidden" name="image_path" value="{{$post->image_path}}">
                  <textarea class="form-control" id="post_body" placeholder="" name="body" required>{{$post->body}}</textarea>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group" style="margin-top: 5px;">
                      <button type="submit" class="btn btn-sm btn-outline-secondary">حفظ التعديلات</button>
                    </div>
                    <small class="text-muted"></small>
                  </div>
                  <input name="_method" type="hidden" value="PATCH">
                </form>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </body>    
    @endsection
</html>    