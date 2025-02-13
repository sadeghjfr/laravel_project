@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش کاربر مشتری</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران </a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.customer.index') }}"> کاربران مشتری </a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش کاربر مشتری </li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش کاربر مشتری
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.customer.update', $user->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="first_name">نام</label>
                                    <input type="text" name="first_name" class="form-control form-control-sm"
                                           value="{{ old('first_name', $user->first_name) }}">
                                </div>
                                @error('first_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control form-control-sm"
                                           value="{{ old('last_name', $user->last_name) }}">
                                </div>
                                @error('last_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="profile_photo_path">تصویر</label>
                                    <input type="file" name="profile_photo_path" class="form-control form-control-sm">
                                    <img src="{{ asset($user->profile_photo_path) }}" alt="" width="100" height="50"
                                         class="mt-3">
                                </div>
                                @error('profile_photo_path')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
