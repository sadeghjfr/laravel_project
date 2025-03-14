@extends('admin.layouts.master')

@section('head-tag')
    <title>گارانتی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.market.product.index')}}"> محصولات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page">گارانتی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <a href="{{ route('admin.market.guarantee.create', $product->id) }}" class="btn btn-info btn-sm">
                        ایجاد گارانتی جدید برای {{$product->name}} </a>
                    <div class="max-width-16-rem">
                        <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>گارانتی</th>
                            <th>افزایش قیمت</th>
                            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($product->guarantees as $guarantee)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $guarantee->name }}</td>
                                <td>{{priceFormat($guarantee->price_increase)}} تومان</td>
                                <td class="width-8-rem text-center">
                                    <form class="d-inline"
                                          action="{{ route('admin.market.guarantee.destroy', ['product' => $product->id, 'guarantee' => $guarantee->id]) }}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                class="fa fa-trash-alt"></i> حذف
                                        </button>
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
