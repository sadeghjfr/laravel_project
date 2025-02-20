@extends('admin.layouts.master')

@section('head-tag')
<title>رنگ محصول</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.product.index')}}"> محصولات</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> رنگ محصول</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mt-2 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.market.color.create', $product->id) }}" class="btn btn-info btn-sm">ایجاد رنگ جدید برای {{$product->name}} </a>
                <div class="max-width-16-rem">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover h-150px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رنگ محصول </th>
                            <th>افزایش قیمت </th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->colors as $color)

                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $color->color_name }}</td>
                            <td>{{number_format($color->price_increase)}} تومان</td>
                            <td class="width-8-rem text-left">
                                <form class="d-inline" action="{{ route('admin.market.color.destroy', ['product' => $product->id, 'productColor' => $color->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </form>
                            </td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
@section('script')

@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])


@endsection
