@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کاربر</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.index') }}"> کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کاربر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">

                    <section class="main-body-container-header">
                        <h5>
                            ویرایش کاربر
                        </h5>
                    </section>

                    <a href="{{ route('admin.user.index') }}" class="btn btn-info btn-sm">بازگشت</a>

                </section>

                <section>
                    <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="first_name">نام</label>
                                    <input type="text" name="first_name" class="form-control form-control-sm" value="{{ old('first_name', $user->first_name) }}">
                                </div>
                                @error('first_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control form-control-sm" value="{{ old('last_name', $user->last_name) }}">
                                </div>
                                @error('last_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            {{--<section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="email">ایمیل (اختیاری)</label>
                                    <input type="text" name="email" class="form-control form-control-sm" value="{{ old('email', $user->email) }}">
                                </div>
                                @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="mobile"> شماره موبایل</label>
                                    <input type="text" name="mobile" class="form-control form-control-sm" value="{{ old('mobile', $user->mobile) }}">
                                </div>
                                @error('mobile')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="password">کلمه عبور</label>
                                    <input type="password" name="password" class="form-control form-control-sm">
                                </div>
                                @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="password_confirmation">تکرار کلمه عبور</label>
                                    <input type="password" name="password_confirmation"
                                           class="form-control form-control-sm">
                                </div>
                                @error('password_confirmation')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>--}}

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="user_type">نوع کاربر</label>
                                    <select name="user_type" id="user_type" class="form-control form-control-sm">
                                        <option value="0" @if(old('user_type', $user->user_type) == 0) selected @endif>مشتری</option>
                                        <option value="1" @if(old('user_type', $user->user_type) == 1) selected @endif>ادمین</option>
                                    </select>
                                </div>
                                @error('user_type')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if(old('status', $user->status) ==0 ) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status', $user->status) ==1 ) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="profile_photo_path">تصویر</label>
                                    <input type="file" name="profile_photo_path" id="image" class="form-control form-control-sm">
                                </div>
                                @error('profile_photo_path')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                </span>
                                @enderror
                            </section>
                            @if(!empty($user->profile_photo_path))
                                <img src="{{ asset($user->profile_photo_path) }}" width="75" height="75"
                                     id="imagePreview" class="rounded mt-1" alt="پروفایل">
                            @endif

                            <section class="col-12 mt-4">
                                <button class="btn btn-primary w-100">ثبت نهایی</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')
    @include('admin.scripts.image-preview-control')
@endsection
