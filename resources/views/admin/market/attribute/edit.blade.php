@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش ویژگی‌</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.attribute.index') }}"> ویژگی‌های دسته‌بندی‌ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش ویژگی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mt-2 mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش ویژگی‌
                        </h5>
                    </section>
                    <a href="{{ route('admin.market.attribute.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.attribute.update', $attribute->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="name">نام فرم</label>
                                    <input type="text" name="name" value="{{ old('name', $attribute->name) }}"
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

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="unit">واحد اندازه گیری</label>
                                    <input type="text" name="unit" value="{{ old('unit', $attribute->unit) }}"
                                           class="form-control form-control-sm">
                                </div>
                                @error('unit')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="category_id">انتخاب دسته</label>
                                    <select name="category_id" id="category_id" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if(old('category_id', $attribute->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
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
