@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش پست</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بلاگ</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.content.post.index')}}"> پست ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پست</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش پست
                        </h5>
                    </section>
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.post.update', $post->id) }}" method="POST"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">عنوان پست</label>
                                    <input type="text" class="form-control form-control-sm" name="title"
                                           value="{{ old('title', $post->title) }}">
                                </div>
                                @error('title')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">انتخاب دسته</label>
                                    <select name="category_id"  class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach ($postCategories as $postCategory)
                                            <option value="{{ $postCategory->id }}"
                                                    @if(old('category_id', $post->category_id) == $postCategory->id) selected @endif>{{ $postCategory->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('category_id')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                           value="{{ old('tags', $post->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
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
                                    <select name="status"  class="form-control form-control-sm" id="status">
                                        <option value="0" @if(old('status', $post->status) == 0) selected @endif>
                                            غیرفعال
                                        </option>
                                        <option value="1" @if(old('status', $post->status) == 1) selected @endif>فعال
                                        </option>
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
                                    <label for="commentable">امکان درج کامنت</label>
                                    <select name="commentable" class="form-control form-control-sm"
                                            id="commentable">
                                        <option value="0"
                                                @if(old('commentable', $post->commentable) == 0) selected @endif>غیرفعال
                                        </option>
                                        <option value="1"
                                                @if(old('commentable', $post->commentable) == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('commentable')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">تاریخ و ساعت انتشار</label>
                                    <input class="form-control form-control-sm d-none"  type="text" id="published_at" name="published_at" value="{{$post->published_at}}">
                                    <input type="text" id="published_at_view" class="form-control form-control-sm" value="{{$post->published_at}}">
                                </div>
                                @error('published_at')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 mb-4">
                                <div class="form-group mb-1">
                                    <label for="">تصویر </label>
                                    <input type="file" name="image" id="image" class="form-control form-control-sm">
                                </div>
                                @error('image')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror

                                @if(!empty($post->image))
                                    <section class="row">
                                        @php
                                            $number = 1;
                                        @endphp
                                        @foreach ($post->image['indexArray'] as $key => $value )
                                            <section class="col-md-{{ 6 / $number }}">
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="currentImage"
                                                           value="{{ $key }}" id="{{ $number }}"
                                                           @if($post->image['currentImage'] == $key) checked @endif>
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


                            <section class="col-12">
                                <div class="form-group mb-1">
                                    <label for="">خلاصه پست</label>
                                    <textarea name="summary" id="summary" class="form-control form-control-sm"
                                              rows="6">{{ old('summary', $post->summary) }}</textarea>
                                </div>
                                @error('summary')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group mb-1">
                                    <label for="">متن پست</label>
                                    <textarea name="body" id="body" class="form-control form-control-sm"
                                              rows="6">{{ old('body', $post->body) }}</textarea>
                                </div>
                                @error('body')
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
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>

    @include('admin.scripts.date-time-picker-control')
    @include('admin.scripts.tags-control')

@endsection
