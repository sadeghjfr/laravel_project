@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد محصول</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.product.index')}}"> محصولات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد محصول</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ایجاد محصول
                        </h5>
                    </section>
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.product.store') }}" method="post" id="form" enctype="multipart/form-data">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="name">نام محصول</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm">
                                </div>
                                @error('name')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="category_id">انتخاب دسته</label>
                                    <select name="category_id"  class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach ($productCategories as $productCategory)
                                            <option value="{{ $productCategory->id }}" @if(old('category_id') == $productCategory->id) selected @endif>{{ $productCategory->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('category_id')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="brand_id">انتخاب برند</label>
                                    <select name="brand_id"  class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" @if(old('brand_id') == $brand->id) selected @endif>{{ $brand->original_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('brand_id')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="image">تصویر </label>
                                    <input type="file" name="image" class="form-control form-control-sm">
                                </div>
                                @error('image')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="weight">وزن</label>
                                    <input type="text" name="weight" value="{{ old('weight') }}" class="form-control form-control-sm">
                                </div>
                                @error('weight')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="length">طول</label>
                                    <input type="text" name="length" value="{{ old('length')}}" class="form-control form-control-sm">
                                </div>
                                @error('length')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="width">عرض</label>
                                    <input type="text" name="width" value="{{ old('width') }}" class="form-control form-control-sm">
                                </div>
                                @error('width')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="height">ارتفاع</label>
                                    <input type="text" name="height" value="{{ old('height') }}" class="form-control form-control-sm">
                                </div>
                                @error('height')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="price">قیمت محصول</label>
                                    <input type="text" name="price" value="{{ old('price') }}" class="form-control form-control-sm">
                                </div>
                                @error('price')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="published_at">تاریخ و ساعت انتشار</label>
                                    <input type="text" name="published_at" id="published_at" class="form-control form-control-sm d-none">
                                    <input type="text" id="published_at_view" class="form-control form-control-sm">
                                </div>
                                @error('published_at')
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
                                        <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
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
                                    <label for="marketable">قابل فروش بودن</label>
                                    <select name="marketable" class="form-control form-control-sm" id="marketable">
                                        <option value="0" @if(old('marketable') == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if(old('marketable') == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('marketable')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 mb-2 my-2">
                                <div class="form-group mb-1">
                                    <label for="tags">تگ ها</label>
                                    <input type="hidden" class="form-control form-control-sm"  name="tags" id="tags" value="{{ old('tags') }}">
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

                            <section class="col-12 border-top border-bottom py-3 my-3">
                                <section id="fields-container">
                                    <section class="row field-group">
                                        <section class="col-6 col-md-3">
                                            <div class="form-group mb-1">
                                                <input name="meta_key[]" type="text" class="form-control form-control-sm" placeholder="ویژگی ...">
                                            </div>
                                        </section>

                                        <section class="col-6 col-md-3">
                                            <div class="form-group mb-1">
                                                <input name="meta_value[]" type="text" class="form-control form-control-sm" placeholder="مقدار ...">
                                            </div>
                                        </section>

                                        <section class="col-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-field">حذف</button>
                                        </section>
                                    </section>
                                </section>

                                <section>
                                    <button id="btn-copy" type="button" class="btn btn-success btn-sm mt-2">افزودن</button>
                                </section>
                            </section>

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="introduction">توضیحات</label>
                                    <textarea name="introduction" id="introduction" class="form-control form-control-sm" rows="6">{{ old('introduction') }}</textarea>
                                </div>
                                @error('introduction')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 mt-3">
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
        CKEDITOR.replace('introduction');
    </script>

    @include('admin.scripts.date-time-picker-control')
    @include('admin.scripts.tags-control')

    <script>
        $(function () {
            $('#btn-copy').on('click', function () {
                let newField = $('.field-group').first().clone(true);
                newField.find('input').val('');
                $('#fields-container').append(newField);
            });

            $(document).on('click', '.remove-field', function () {
                if ($('.field-group').length > 1) {
                    $(this).closest('.field-group').remove();
                } else {
                    $(this).closest('.field-group').find('input').val('');
                }
            });
        });
    </script>

@endsection
