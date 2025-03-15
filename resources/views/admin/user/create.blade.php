@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد کاربر جدید</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.index') }}"> کاربران</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر جدید</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">

                    <section class="main-body-container-header">
                        <h5>
                            ایجاد کاربر جدید
                        </h5>
                    </section>

                    <a href="{{ route('admin.user.index') }}" class="btn btn-info btn-sm">بازگشت</a>

                </section>

                <section>
                    <form action="{{ route('admin.user.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="first_name">نام</label>
                                    <input type="text" name="first_name" class="form-control form-control-sm" value="{{ old('first_name') }}">
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
                                    <input type="text" name="last_name" class="form-control form-control-sm" value="{{ old('last_name') }}">
                                </div>
                                @error('last_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="email">ایمیل</label>
                                    <input type="text" name="email" class="form-control form-control-sm" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="mobile">شماره موبایل</label>
                                    <input type="text" name="mobile" class="form-control form-control-sm" value="{{ old('mobile') }}">
                                </div>
                                @error('mobile')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            {{-- <section class="col-12 col-md-6 mb-2">
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
                                    <label for="profile_photo_path">تصویر</label>
                                    <input type="file" name="profile_photo_path" class="form-control form-control-sm">
                                </div>
                                @error('profile_photo_path')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="status">وضعیت</label>
                                    <select name="status" class="form-control form-control-sm" id="status">
                                        <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="user_type">نوع کاربر</label>
                                    <select name="user_type" id="user_type" class="form-control form-control-sm">
                                        <option value="0" @if(old('user_type') == 0) selected @endif>مشتری</option>
                                        <option value="1" @if(old('user_type') == 1) selected @endif>ادمین</option>
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

                            <section class="col-12 mt-2">
                                <button class="btn btn-primary w-100">ثبت نهایی</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
