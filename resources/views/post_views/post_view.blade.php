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
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="card mb-8 box-shadow">             
            <div class="card-header" style="background-color:  white;">
               <div class="media text-muted pt-3" style="direction:  rtl;">
                  <img src="{{asset('storage/'.$post->user->avatar)}}" alt="" class="col-sm-2 rounded" style="margin-right: -3%; width: 50px;height: 50px;">
                  <div class="media-body pb-3 mb-0" style="text-align: right;direction:  rtl;" >
                    <p class="card-text" style="text-align: right;direction:  rtl;"></p>
                  </div>
                </div>
                @can('delete' , $post)
                <form action="{{route('post.destroy',$post->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-secondary">حذف</button>

                </form>
                @endcan
            </div>  
            <img class="card-img-top" src="{{asset('storage/'.$post->image_path)}}" alt="Card image cap">
            <div class="card-body">
              <p class="card-text" style="text-align: right;direction:  rtl;">{{$post->body}}</p>
              @if(sizeof($userLike)==1)
              <form action="{{ route('like.destroy', $post->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <div class="row">
                      <div class="btn-group" style="margin-top:  4px;">
                        <button class="btn btn-sm btn-outline-secondary" type="button" ><i class="fa fa-heart" style="margin-right:  10%;"></i><label id="count_id">{{$count}}</label></button> 
                        <button class="btn btn-sm btn-outline-secondary" id="btn_value_id"> إلغاء الإعجاب </button>
                      </div>
                  </div>

              </form>


              @else
              <div class="d-flex justify-content-between align-items-center">
                <form method="POST" action="{{url('like')}}">
                  @csrf
                  <input type="hidden" name="post_id" value="{{$post->id}}">
                  <div class="row">
                      <div class="btn-group" style="margin-top:  4px;">
                        <button class="btn btn-sm btn-outline-secondary" type="button" ><i class="fa fa-heart" style="margin-right:  10%;"></i><label id="count_id">{{$count}}</label></button> 
                        <button class="btn btn-sm btn-outline-secondary" id="btn_value_id"> أعجبني </button>
                      </div>
                  </div>
                  <small class="text-muted"></small>
                </form>
                @endif
              </div>
            </div>
            <div class="card-footer" style="direction:  rtl;text-align:  right;">
              <div class="media text-muted pt-3">
                <img src="{{asset('storage/'.auth()->user()->avatar)}}" alt="" class="col-sm-2 rounded" style="margin-top:  1%;margin-right: -3%; width: 50px;height: 50px;">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark"></strong>
                  </div>
                  <form action="{{url('comment')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-10">
                        <input type="text" name="comment" class="form-control" placeholder="أضف تعليقاً" style="width:  100%;">
                      </div>
                      <input type="hidden" name="post_id" value="{{$post->id}}">
                      <div class="col-md-2" style="margin-top:  4px;">  
                        <input type="submit" class="btn btn-sm btn-outline-secondary" name="send" value="إضافة التعليق">
                      </div>  
                    </div>
                  </form> 
                </div>
              </div>
                 @foreach($post_comment->comments as $comment)
                  <div class="media text-muted pt-3">
                    <img src="{{asset('storage/'.$comment->user->avatar)}}" alt="" class="col-sm-2 rounded" style="margin-top:  1%;margin-right: -3%; width: 50px;height: 50px;">
                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <strong class="text-gray-dark">{{$comment->user->name}}</strong><br>

                            @if($comment->user_id == auth()->user()->id)
                              <form action="{{route('comment.destroy' , $comment->id)}}"  method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-outline-danger" value="حذف التعليق">
                              </form>
                            @endif


                        </div>
                        <span class="d-block">{{$comment->comment}}</span>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</body>    
@endsection

</html>