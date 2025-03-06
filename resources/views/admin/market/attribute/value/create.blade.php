@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد مقدار ویژگی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.attribute.index') }}"> ویژگی‌های دسته‌بندی‌ها</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.value.index', $attribute->id) }}"> مقادیر ویژگی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد مقدار ویژگی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ایجاد مقدار برای ویژگی {{$attribute->name}} در دسته بندی {{$attribute->category->name}}
                        </h5>
                    </section>
                    <a href="{{ route('admin.market.value.index', $attribute->id) }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.value.store', $attribute->id) }}" method="POST">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="product_id">انتخاب محصول</label>
                                    <select name="product_id" id="product_id" class="form-control form-control-sm">
                                        <option value=""> محصول را انتخاب کنید</option>
                                        @foreach ($attribute->category->products as $product)
                                            <option value="{{ $product->id }}"
                                                    @if(old('product_id') == $product->id) selected @endif>{{ $product->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('product_id')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="value">مقدار {{ $attribute->unit ? '(' . $attribute->unit . ')' : ''  }}</label>
                                    <input type="text" name="value" value="{{ old('value') }}"
                                           class="form-control form-control-sm">
                                </div>
                                @error('value')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="price_increase">افزایش قیمت (تومان)</label>
                                    <input type="text" name="price_increase" value="{{ old('price_increase') }}"
                                           class="form-control form-control-sm">
                                </div>
                                @error('price_increase')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="type">نوع</label>
                                    <select name="type" class="form-control form-control-sm" id="type">
                                        <option value="0" @if(old('type') == 0) selected @endif>ساده</option>
                                        <option value="1" @if(old('type') == 1) selected @endif>انتخابی</option>
                                    </select>
                                </div>
                                @error('type')
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
