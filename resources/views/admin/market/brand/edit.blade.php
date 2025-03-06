@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش برند</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.brand.index')}}"> برند ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش برند</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش برند
                        </h5>
                    </section>
                    <a href="{{ route('admin.market.brand.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.market.brand.update', $brand->id)}}" method="post" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="persian_name"> نام فارسی برند <span class="text-danger">*</span></label>
                                    <input value="{{old('persian_name', $brand->persian_name)}}" id="persian_name" name="persian_name" type="text" class="form-control form-control-sm">
                                </div>
                                @error('persian_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="original_name"> نام انگلیسی برند <span class="text-danger">*</span></label>
                                    <input value="{{old('original_name', $brand->original_name)}}" id="original_name" name="original_name" type="text" class="form-control form-control-sm">
                                </div>
                                @error('original_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm"  name="tags" id="tags" value="{{ old('tags', $brand->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
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
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if(old('status', $brand->status) ==0 ) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status', $brand->status) ==1 ) selected @endif>فعال</option>
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

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="logo"> لوگو<span class="text-danger">*</span> </label>
                                    <input name="logo" id="logo" type="file" class="form-control form-control-sm">
                                </div>
                                @error('logo')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror

                                @if(!empty($brand->logo))
                                    <section class="row">
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($brand->logo['indexArray'] as $key => $value )
                                            <section class="col-md-{{ 6 / $number }}">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="currentImage" value="{{ $key }}" id="{{ $number }}" @if($brand->logo['currentImage'] == $key) checked @endif>
                                                    <label for="{{ $number }}" class="form-check-label mx-2">
                                                        <img src="{{ asset($value) }}" class="w-100" alt="logo">
                                                    </label>
                                                </div>
                                            </section>
                                            @php
                                                $number++;
                                            @endphp
                                        @endforeach

                                    </section>
                                @endif

                            </section>


                            <section class="col-12">
                                <button class="btn btn-primary w-100 mt-3">ثبت نهایی</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    @include('admin.scripts.tags-control')

@endsection
