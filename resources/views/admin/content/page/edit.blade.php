@extends('admin.layouts.master')

@section('head-tag')
    <title>پیج ساز</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.page.index')}}">پیج ساز</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش پیج</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش پیج
                        </h5>
                    </section>
                    <a href="{{ route('admin.content.page.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.page.update', $page->id) }}" method="post" id="form">
                        @csrf
                        @method('put')

                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">عنوان </label>
                                    <input type="text" name="title"  value="{{ old('title', $page->title) }}" class="form-control form-control-sm">
                                </div>
                                @error('title')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="0" @if (old('status', $page->status) == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if (old('status', $page->status) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group mb-1">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                           value="{{ old('tags', $page->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                    </select>
                                </div>
                                @error('tags')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12">
                                <div class="form-group mb-1">
                                    <label for="">محتوا</label>
                                    <textarea name="body" id="body"  class="form-control form-control-sm" rows="6">{{ old('body', $page->body) }}</textarea>
                                </div>
                                @error('body')
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
        CKEDITOR.replace('body');
    </script>

    @include('admin.scripts.tags-control')

@endsection
