@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
    <div class="container">
        @if (auth()->user() == $user)
            <h4 class="">تعديل البيانات الشخصية</h4>
            <hr>
            <form method="POST" action="{{ route('users.update',$user) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row bg-white p-5">
                    <div class="col-lg-4 text-center mb-5">
                        <img id="avatar_img" src="{{ asset($user->avatar) }}" class="rounded shadow w-75 h-75"
                            alt="avatar">
                        <input type="file" id="avatar_file" name="avatar" class="d-none">
                    </div>

                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label class="col-lg-3">اسم المستخدم </label>
                            <div class="col-lg-9">
                                <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3" id="email">البريد الإلكتروني</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="email" type="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-9">
                                <input type="submit" class="btn btn-outline-primary" value="حفظ التعديلات ">
                                <input type="reset" class="btn btn-outline-secondary" value="إلغاء">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <h4 class="">البيانات الشخصية</h4>
            <hr>
            
            <div class="container text-muted">
                <div class="row  bg-white p-3 mb-4">
                    <div class="col-md-3 text-center">                      
                        <img class="profile mb-2 rounded shadow w-75 h-75" src="{{asset($user->avatar) }}" alt="" />
                    </div>
            
                    <div class="col-md-9 text-md-right text-center">
                        <h2>{{$user->name}}</h2>
                        <p style="font-size: 16px" class="word-break text-lg">عدد الإعلانات: {{$user->ads->count()}}</p>   
                        
                    </div>
                </div>
            
                
            </div>
        @endif

        <hr>
        <h3 class="mb-4">{{ auth()->id() == $user->id ? 'إعلاناتي' : 'إعلاناته' }}</h3>
        @include('partials.ads',['ads'=>$user->ads])
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#avatar_img').click(function() {
                $("input[id='avatar_file']").click();
            });


            $("#avatar_file").change(function() {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#avatar_img").addClass("avatar_preview").attr("src", reader.result);
                }
                reader.readAsDataURL(event.target.files[0]);
            });

        });

    </script>
@endsection
