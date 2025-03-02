@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش فروش شگفت انگیز</title>
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.discount.amazingSale') }}"> فروش شگفت انگیز</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش  فروش شگفت انگیز</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mt-2 mb-3 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش فروش شگفت انگیز
                    </h5>
                </section>
                <a href="{{ route('admin.market.discount.amazingSale') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.market.discount.amazingSale.update', $amazingSale->id) }}" method="POST">
                    @csrf
                    @method("PUT")
                     <section class="row">


                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="product_id">انتخاب دسته</label>
                                <select name="product_id" id="product_id" class="form-control form-control-sm">
                                    <option value="">دسته را انتخاب کنید</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @if(old('product_id', $amazingSale->product_id) == $product->id) selected @endif>{{ $product->name }}</option>
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
                                <label for="">درصد تخفیف</label>
                                <input type="text" class="form-control form-control-sm" name="percentage" value="{{ old('percentage', $amazingSale->percentage) }}">
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
                                <label for="">تاریخ شروع</label>
                                <input type="text" name="start_date" id="start_date" class="form-control form-control-sm d-none" value="{{ old('start_date', $amazingSale->start_date) }}">
                                <input type="text" id="start_date_view" class="form-control form-control-sm" value="{{ old('start_date', $amazingSale->start_date) }}">
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
                                <input type="text" name="end_date" id="end_date" class="form-control form-control-sm d-none" value="{{ old('end_date', $amazingSale->end_date) }}">
                                <input type="text" id="end_date_view" class="form-control form-control-sm" value="{{ old('end_date', $amazingSale->end_date) }}">
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
                                    <option value="0" @if (old('status', $amazingSale->status) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if (old('status', $amazingSale->status) == 1) selected @endif>فعال</option>
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
