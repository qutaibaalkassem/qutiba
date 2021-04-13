@extends('layouts.app')

@section('title','الملف الشخصيى')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="text-center">
                <img src="{{asset('storage/'.auth()->user()->avatar)}}" alt="" width="82px" height="82px">
                <h3>
                    {{ auth()->user()->name}}
                </h3>
            </div>
            <div class="card-body text-right">
                <form action="{{route('user.update',$user)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">اسم الحساب</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{auth()->user()->name}}">
                        @error('name')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">الاسم الأول</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{auth()->user()->first_name}}">
                        @error('first_name')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">الاسم الأخير</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="{{auth()->user()->last_name}}">
                        @error('last_name')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{auth()->user()->email}}">
                        @error('email')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" name="password" id="password" class="form-control" >
                        @error('password')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                @enderror
                    </div>

                    
                    <div class="form-group">
                        <label for="password-confirmation">تأكيد كلمة المرور</label>
                        <input type="password" name="password-confirmation" id="password-confirmation" class="form-control" >
                        @error('"password-confirmation')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                @enderror
                    </div>

                    <div class="forme-group">
                        <label for="avatar">تغير الصورة الشخصية</label>
                        <div class="custom-file">
                            <input type="file" name="avatar" id="avatar" class="custom-file-input">
                            <label for="avatar" id="image-label" class="custom-file-label text-left" data-browse="استعرض"></label>
                            @error('avatar')
                    <div class="text-danger">
                        <small>{{$message}}</small>
                    </div>
                @enderror
                        </div>
                    </div>

                    <div class="form-group row" dir="rtl">
                            <label for="birth_date" class="col-md-4 col-form-label text-md">{{ __('تاريخ الميلاد') }}</label><br>
                            <div class="col-12">
                                <input class="form-control" type="date" value="{{auth()->user()->birth_date}}" id="birth_date" name="birth_date">
                                @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                         </div>

                    <div class="form-group d-flex mt-5 flex-row-reverse">
                        <button type="submit" class="btn btn-primary mr-2">حفظ التعديلات</button>
                        <button type="submit" class="btn btn-light" form="logout">تسجيل الخروج</button>
                    </div>
                </form>
                
                <form action="/logout" id="logout" method="POST">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>

@endsection