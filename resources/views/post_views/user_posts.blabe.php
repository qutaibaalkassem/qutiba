<!doctype html>
<html lang="en">
  <head>
@extends('layouts.app')

@section('content')
    <title>عرض منشور </title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/album.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">
        @foreach($posts as $post)
          <div class="col-md-4">
            <div class="card mb-4 box-shadow">
            <!-- post image -->
              <img class="card-img-top" src="{{asset('storage/'.$post->image_path)}}" alt="Card image cap" style="height: 250px">
              <div class="card-body" style="height:  116px;">
                <!-- post body -->
                <p class="card-text" style="text-align: right;direction:  rtl;">{{$post->body}}</p>
                <br>
              </div>
              <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                <!-- post actions -->
                  <form action="{{route('post.destroy',$post->id)}}" method="POST">
                    <div class="btn-group">
                      <a class="btn btn-sm btn-outline-secondary" href="{{route('post.show',$post->id)}}">عرض</a>
                      <a class="btn btn-sm btn-outline-secondary" href="{{route('post.edit',$post->id)}}">تعديل</a>
                        {{ csrf_field() }}
                        @method('DELETE')
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-sm btn-outline-secondary" >حذف</button>
                    </div>
                  </form>
                  <!-- post date -->
                  <small class="text-muted">{{$post->created_at}}</small>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <!-- Paginations -->
      </div>
    </div>
  </body>
  @endsection

</html>