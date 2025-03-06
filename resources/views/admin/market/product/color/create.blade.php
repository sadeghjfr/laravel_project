@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد رنگ</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.product.index')}}"> محصولات</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.color.index', $product->id) }}"> رنگ محصول</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد رنگ</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد رنگ برای {{$product->name}}
                    </h5>
                </section>
                <a href="{{ route('admin.market.color.index', $product->id) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.market.color.store', $product->id) }}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="color_name">نام رنگ</label>
                                <input type="text" name="color_name" value="{{ old('color_name') }}" class="form-control form-control-sm">
                            </div>
                            @error('color_name')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="price_increase"> افزایش قیمت محصول</label>
                                <input type="text" name="price_increase" value="{{ old('price_increase') }}" class="form-control form-control-sm">
                            </div>
                            @error('price_increase')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>


                        <section class="col-12">
                            <button class="btn btn-primary mt-2 w-100">ثبت نهایی</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
