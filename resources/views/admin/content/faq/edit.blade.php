@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش سوال</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بلاگ</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.faq.index')}}"> سوالات متداول</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش سوال</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش سوال
                        </h5>
                    </section>
                    <a href="{{ route('admin.content.faq.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.content.faq.update', $faq->id)}}" method="post" id="form">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="question">سوال</label>
                                    <input id="question" name="question" value="{{old('question', $faq->question)}}" type="text" class="form-control form-control-sm">
                                </div>
                                @error('question')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if(old('status', $faq->status) ==0 ) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('status', $faq->status) ==1 ) selected @endif>فعال</option>
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

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group mb-1">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm"  name="tags" id="tags" value="{{ old('tags', $faq->tags) }}">
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
                                    <label for="">پاسخ</label>
                                    <textarea name="answer" id="answer"  class="form-control form-control-sm" rows="6">{{old('answer', $faq->answer)}}</textarea>
                                </div>
                                @error('answer')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
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
        CKEDITOR.replace('answer');
    </script>

    @include('admin.scripts.tags-control')

@endsection
