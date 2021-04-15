<!doctype html>
<html lang="en">
  <head>
@extends('layouts.app')

@section('content')
    <title>إنشاء منشور جديد</title>

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
        <div class="col-md-8" style="direction:  rtl;text-align: right;">
            <form method="post" action="{{url('post')}}" enctype="multipart/form-data">
           @csrf
            <div class="row">
                <div class="col-md-12 mb-6">
                <label for="file_label">قم برفع صورة</label>
                <input type="file" class="form-control" id="file_label" name="image_path" required>
                </div>
                <div class="col-md-12 mb-6">
                <label for="post_body">حول الصورة</label>
                <textarea class="form-control" id="post_body" placeholder="" name="body" required></textarea>
                <div class="invalid-feedback">
                    قل شيئاً عن الصورة
                </div>
                </div>
            </div>
            <div class="row" style="margin-top:  5%;">
                <div class="col-md-12 mb-6">
                <button class="btn btn-primary btn-lg btn-block" type="submit">نشر الصورة</button>
                </div>  
            </div>  
            </form>
        </div>
        </div>
    </div>
    </div>
</body>    
@endsection

</html>