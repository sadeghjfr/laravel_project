@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش انبار</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.market.store.index')}}"> انبار</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش انبار</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش انبار
                    </h5>
                </section>
                <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.market.store.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <section class="row">



                        <section class="col-12 mb-2">
                            <div class="form-group mb-1">
                                <label for="marketable_number">تعداد قابل فروش</label>
                                <input type="text" name="marketable_number" value="{{ old('marketable_number', $product->marketable_number) }}" class="form-control form-control-sm">
                            </div>
                            @error('marketable_number')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 mb-2">
                            <div class="form-group mb-1">
                                <label for="sold_number">تعداد فروخته شده</label>
                                <input type="text" name="sold_number" value="{{ old('sold_number', $product->sold_number) }}" class="form-control form-control-sm">
                            </div>
                            @error('sold_number')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 mb-2">
                            <div class="form-group mb-1">
                                <label for="frozen_number">تعداد رزرو شده</label>
                                <input type="text" name="frozen_number" value="{{ old('frozen_number', $product->frozen_number) }}" class="form-control form-control-sm">
                            </div>
                            @error('frozen_number')
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
