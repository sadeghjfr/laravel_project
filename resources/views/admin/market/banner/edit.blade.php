@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش بنر</title>
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="#"> فروشگاه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.banner.index')}}"> بنر ها</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page">ویرایش بنر</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش بنر
                    </h5>
                </section>
                <a href="{{ route('admin.market.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.market.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="">عنوان بنر</label>
                                <input type="text" class="form-control form-control-sm" name="title"  value="{{ old('title', $banner->title) }}">
                            </div>
                            @error('title')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="">موقعیت</label>
                                <input type="text" name="position" value="{{ old('position', $banner->position) }}" class="form-control form-control-sm">
                            </div>
                            @error('position')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="status">وضعیت</label>
                                <select name="status" class="form-control form-control-sm" id="status">
                                    <option value="0" @if (old('status', $banner->status) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if (old('status', $banner->status) == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="">آدرس URL</label>
                                <input type="text" name="url" value="{{ old('url', $banner->url) }}" class="form-control form-control-sm">
                            </div>
                            @error('url')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 mb-2">
                            <div class="form-group mb-1">
                                <label for="image">تصویر</label>
                                <input type="file" class="form-control form-control-sm" name="image" id="image">
                            </div>
                            @error('image')
                            <span class="text-danger" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="row">

                            @php
                                $number = 1;
                            @endphp

                            @foreach ($banner->image['indexArray'] as $key => $value )
                                <section class="col-md-{{ 6 / $number }}">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="currentImage" value="{{ $key }}" id="{{ $number }}" @if($banner->image['currentImage'] == $key) checked @endif>
                                        <label for="{{ $number }}" class="form-check-label mx-2">
                                            <img src="{{ asset($value) }}" class="w-100" alt="">
                                        </label>
                                    </div>
                                </section>

                                @php
                                    $number++;
                                @endphp

                            @endforeach

                        </section>


                        <section class="col-12">
                            <button class="btn btn-primary w-100 mt-4">ثبت نهایی</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
