@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد کوپن تخفیف</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.discount.coupon') }}"> کوپن تخفیف</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کوپن تخفیف</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ایجاد کوپن تخفیف
                        </h5>
                    </section>
                    <a href="{{ route('admin.market.discount.coupon') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.market.discount.coupon.store') }}" method="POST">
                        @csrf

                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">کد کوپن</label>
                                    <input type="text" name="code" value="{{ old('code') }}" class="form-control form-control-sm">
                                </div>
                                @error('code')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">نوع کوپن</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0">عمومی</option>
                                        <option value="1">خصوصی</option>
                                    </select>
                                </div>
                            </section>
                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">کاربران</label>
                                    <select name="user_id" id="users" class="form-control form-control-sm" disabled>

                                        <option value="">یک کاربر را انتخاب کنید</option>

                                        @foreach ($users as $user)

                                            <option @if(old('user_id') == $user->id) selected @endif value="{{ $user->id }}">{{ $user->fullName }}</option>

                                        @endforeach

                                    </select>
                                </div>
                                @error('user_id')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">واحد تخفیف</label>
                                    <select name="amount_type" id="amount_type" class="form-control form-control-sm">
                                        <option value="0" @if(old('amount_type') == 0) selected @endif>درصد</option>
                                        <option value="1" @if(old('amount_type') == 1) selected @endif>تومان</option>
                                    </select>
                                </div>
                                @error('amount_type')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">میزان تخفیف</label>
                                    <input type="text" name="amount" value="{{ old('amount') }}" class="form-control form-control-sm">
                                </div>
                                @error('amount')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">سقف تخفیف</label>
                                    <input type="text" name="discount_ceiling" value="{{ old('discount_ceiling') }}" class="form-control form-control-sm">
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
                                    <label for="">تاریخ شروع</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control form-control-sm d-none" value="{{old('start_date')}}">
                                    <input type="text" id="start_date_view" class="form-control form-control-sm" value="{{old('start_date')}}">
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
                                    <input type="text" name="end_date" id="end_date" class="form-control form-control-sm d-none" value="{{old('end_date')}}">
                                    <input type="text" id="end_date_view" class="form-control form-control-sm" value="{{old('end_date')}}">
                                </div>
                                @error('end_date')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12">
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


    @include('admin.scripts.discount-date-picker-control')


    <script>
        $("#type").change(function(){

            if($('#type').find(':selected').val() == '1')
                $('#users').removeAttr('disabled');

            else
                $('#users').attr('disabled', 'disabled');


        });

    </script>



@endsection
