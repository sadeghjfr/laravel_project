@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد تصویر</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.product.index')}}"> محصولات</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.gallery.index', $product->id) }}"> گالری</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد تصویر</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد تصویر
                    </h5>
                </section>
                <a href="{{ route('admin.market.gallery.index', $product->id) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.market.gallery.store', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="col-12 mb-4">
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

                        <section class="col-12">
                            <button class="btn btn-primary w-100">ثبت نهایی</button>
                        </section>

                </form>
            </section>

        </section>
    </section>
</section>

@endsection
