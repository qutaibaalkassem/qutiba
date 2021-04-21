@extends('layouts.app')

@section('content')

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-6"> 
        <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
          <h6 class="border-bottom border-gray pb-2 mb-0">طلبات المتابعة</h6>
          <!-- Foreach -->
          @foreach($follow_requests as $request)
          <div class="media text-muted pt-3">
            <img src="{{asset('storage/'.$request->from_user->avatar)}}" alt="" class="col-sm-2 mr-2 rounded" style="margin-right: -3%;width: 50px;height: 50px;">
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray" >
              <div class="d-flex justify-content-between align-items-center w-100">
                <strong class="text-gray-dark">{{$request->from_user->name}}</strong>
                
                <!-- رفض الطلب -->
                <form method="POST" action="{{route('follow.destroy' ,$request->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="رفض الطلب">
                    <input name="redirect_to" type="hidden" value="user/follower">
                </form>

                <!-- قبول الطلب -->
                <form method="POST" action="{{route('follow.update' ,$request->id)}}">
                    @csrf
                    @method('PATCH')
                    <input type="submit" class="btn btn-success" value="قبول الطلب">
                </form>

              </div>
              <span class="d-block">تاريخ الطلب {{$request['created_at']}}</span>
            </div>
          </div>
          <!-- End Foreach -->
          @endforeach
          <small class="d-block text-right mt-3">
            <a href="#">جميع الطلبات</a>
          </small>
        </div>
      </div>  
      <!-- Part 2 -->
                <div class="col-md-6">
            <div class="my-3 p-3 bg-white rounded box-shadow" style="direction:  rtl;text-align:  right;">
                <h6 class="border-bottom border-gray pb-2 mb-0">الأصدقاء</h6>
                <!-- Foreach -->
             @foreach($followers as $follower)
                <!-- User define -->
                @php 
                    $user = $follower->from_user->id == auth()->user()->id ? $follower->to_user : $follower->from_user;
                @endphp
                <div class="media text-muted pt-3">
                <img src="{{asset('storage/'.$user->avatar)}}" alt="" class="col-sm-2 mr-2 rounded" style="margin-right: -3%;width: 50px;height: 50px;">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                    <a href="/user/{{$user->id}}/posts"><strong class="text-gray-dark">{{$user->name}}</strong></a>
                    <!-- حذف الصداقة -->
                    <form method="POST" action="{{route('follow.destroy' ,$follower->id)}}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-outline-danger" value="{{ $follower->from_user->id == auth()->user()->id ? 'إلغاء المتابعة' : 'حذف من المتابعين ' }} ">
                    <input name="redirect_to" type="hidden" value="user/follower">
                </form>

                    </div>
                    <span class="d-block"> {{ $follower->from_user->id == auth()->user()->id ? 'تتابعه منذ' : 'يتابعك منذ' }} {{$follower['created_at']}} </span>
                </div>
                </div>
                <!-- End Foreach -->
            @endforeach
                <small class="d-block text-right mt-3">
                <a href="#">جميع التحديثات</a>
                </small>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection