@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.category.index') }}"> دسته بندی</a>
            </li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">


                <section class="d-flex justify-content-between align-items-center mt-2 mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش دسته بندی
                        </h5>
                    </section>
                    <a href="{{ route('admin.market.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.category.update', $productCategory->id) }}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">نام دسته</label>
                                    <input type="text" name="name" value="{{ old('name', $productCategory->name) }}"
                                           class="form-control form-control-sm">
                                </div>
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">منو والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        <option value="">منوی اصلی</option>
                                        @foreach ($parent_categories as $parent_category)

                                            <option value="{{ $parent_category->id }}"
                                                    @if(old('parent_id', $productCategory->parent_id) == $parent_category->id) selected @endif>{{ $parent_category->name }}</option>

                                        @endforeach

                                    </select>
                                </div>
                                @error('parent_id')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
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
                                @foreach ($productCategory->image['indexArray'] as $key => $value )
                                    <section class="col-md-{{ 6 / $number }} mb-3">
                                        <div class="form-check d-flex flex-column align-items-center">
                                            <input type="radio" class="form-check-input mb-2" name="currentImage"
                                                   value="{{ $key }}" id="{{ $number }}"
                                                   @if($productCategory->image['currentImage'] == $key) checked @endif>
                                            <label for="{{ $number }}" class="form-check-label mx-2">
                                                <img src="{{ asset($value) }}" class="w-100 img-thumbnail rounded shadow-sm" style="object-fit: cover; aspect-ratio: 1/1; transition: transform 0.3s ease; cursor: pointer;" alt="">
                                            </label>
                                        </div>
                                    </section>
                                    @php
                                        $number++;
                                    @endphp
                                @endforeach
                            </section>



                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" class="form-control form-control-sm" id="status">
                                        <option value="0"
                                                @if (old('status', $productCategory->status) == 0) selected @endif>
                                            غیرفعال
                                        </option>
                                        <option value="1"
                                                @if (old('status', $productCategory->status) == 1) selected @endif>فعال
                                        </option>
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

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="show_in_menu">وضعیت نمایش در منو</label>
                                    <select name="show_in_menu" class="form-control form-control-sm"
                                            id="show_in_menu">
                                        <option value="0"
                                                @if (old('show_in_menu', $productCategory->status) == 0) selected @endif>
                                            غیرفعال
                                        </option>
                                        <option value="1"
                                                @if (old('show_in_menu', $productCategory->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                    </select>
                                </div>
                                @error('show_in_menu')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm" name="tags" id="tags"
                                           value="{{ old('tags', $productCategory->tags) }}">
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

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="">توضیحات</label>
                                    <textarea name="description" id="description"  class="form-control form-control-sm" rows="6">
                                    {{ old('description', $productCategory->description) }}
                                </textarea>
                                </div>
                                @error('description')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
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

