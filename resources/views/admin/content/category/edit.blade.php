@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بلاگ</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.category.index')}}"> دسته بندی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">


                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش دسته بندی
                        </h5>
                    </section>
                    <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.content.category.update', $postCategory->id)}}" method="post" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="name">نام دسته</label>
                                    <input value="{{old('name', $postCategory->name)}}" name="name" id="name" type="text" class="form-control form-control-sm">
                                </div>
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="image">تصویر</label>
                                    <input name="image" id="image" type="file" class="form-control form-control-sm">
                                </div>
                                @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror

                                @if(!empty($postCategory->image))
                                    <section class="row">
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($postCategory->image['indexArray'] as $key => $value )
                                            <section class="col-md-{{ 6 / $number }}">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="currentImage" value="{{ $key }}" id="{{ $number }}" @if($postCategory->image['currentImage'] == $key) checked @endif>
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
                                @endif

                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if(old('status', $postCategory->status) ==0 ) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status', $postCategory->status) ==1 ) selected @endif>فعال</option>
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
                                    <label for="parent_id">دسته والد</label>
                                    <select name="parent_id" id="parent_id" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($parentCategories as $parentCategory)
                                            <option @if(old('parent_id', $postCategory->parent_id) == $parentCategory->id) selected @endif value="{{$parentCategory->id}}">{{$parentCategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 my-2">
                                <div class="form-group mb-1">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm"  name="tags" id="tags" value="{{ old('tags', $postCategory->tags) }}">
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

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" id="description" type="text" class="form-control form-control-sm" rows="6">{{old('description', $postCategory->description)}}</textarea>
                                </div>
                                @error('description')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

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

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('description');
    </script>

    @include('admin.scripts.tags-control')

@endsection
