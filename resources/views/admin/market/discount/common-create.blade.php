@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد تخفیف عمومی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.discount.commonDiscount') }}">
                    تخفیف عمومی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد تخفیف عمومی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mt-2 mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>ایجاد تخفیف عمومی</h5>
                    </section>

                    <a href="{{ route('admin.market.discount.commonDiscount') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.commonDiscount.store') }}" method="POST">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="title">عنوان مناسبت</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
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
                                    <label for="percentage">درصد تخفیف</label>
                                    <input type="text" class="form-control form-control-sm" name="percentage"
                                           value="{{ old('percentage') }}">
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
                                    <label for="discount_ceiling">سقف تخفیف (تومان)</label>
                                    <input type="text" name="discount_ceiling" value="{{ old('discount_ceiling') }}"
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
                                    <label for="minimal_order_amount">حداقل مبلغ خرید (تومان)</label>
                                    <input type="text" name="minimal_order_amount"
                                           value="{{ old('minimal_order_amount') }}"
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
                                    <label for="start_date">تاریخ شروع</label>
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
                                    <label for="end_date">تاریخ پایان</label>
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

    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>


    <script>
        $(document).ready(function () {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date'
            }),
                $('#end_date_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#end_date'
                })
        });
    </script>
@endsection
