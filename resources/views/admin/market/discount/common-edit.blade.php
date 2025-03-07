@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش تخفیف عمومی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.discount.commonDiscount') }}">
                    تخفیف عمومی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش تخفیف عمومی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش تخفیف عمومی
                        </h5>
                    </section>
                    <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.commonDiscount.update', $commonDiscount->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">عنوان مناسبت</label>
                                    <input type="text" name="title" value="{{ old('title', $commonDiscount->title) }}"
                                           class="form-control form-control-sm">
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
                                    <label for="">درصد تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" name="percentage"
                                           value="{{ old('percentage', $commonDiscount->percentage) }}">
                                </div>
                                @error('percentage')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">حداکثر تخفیف (تومان)</label>
                                    <input type="text" name="discount_ceiling"
                                           value="{{ old('discount_ceiling', $commonDiscount->discount_ceiling) }}"
                                           class="form-control form-control-sm">
                                </div>
                                @error('discount_ceiling')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">حداقل مبلغ خرید (تومان)</label>
                                    <input type="text" name="minimal_order_amount"
                                           value="{{ old('minimal_order_amount', $commonDiscount->minimal_order_amount) }}"
                                           class="form-control form-control-sm">
                                </div>
                                @error('minimal_order_amount')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">تاریخ شروع</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control form-control-sm d-none" value="{{old('start_date', $commonDiscount->start_date)}}">
                                    <input type="text" id="start_date_view" class="form-control form-control-sm" value="{{old('start_date', $commonDiscount->start_date)}}">
                                </div>
                                @error('start_date')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">تاریخ پایان</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control form-control-sm d-none" value="{{old('end_date', $commonDiscount->end_date)}}">
                                    <input type="text" id="end_date_view" class="form-control form-control-sm" value="{{old('end_date', $commonDiscount->end_date)}}">
                                </div>
                                @error('end_date')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="status">وضعیت</label>
                                    <select name="status" class="form-control form-control-sm" id="status">
                                        <option value="0"
                                                @if (old('status', $commonDiscount->status) == 0) selected @endif>
                                            غیرفعال
                                        </option>
                                        <option value="1"
                                                @if (old('status', $commonDiscount->status) == 1) selected @endif>فعال
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


@section('script')
    @include('admin.scripts.discount-date-picker-control')
@endsection
