@extends('admin.layouts.master')

@section('head-tag')
    <title>محصولات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> محصولات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm">ایجاد محصول
                        جدید </a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>تصویر</th>
                            <th>قیمت</th>
                            <th>دسته بندی</th>
                            <th>فعال سازی</th>
                            <th>قابل فروش</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($products as $product)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$product->name}}</td>
                                <td><img src="@if($product->image !=null) {{asset($product->image['indexArray']['small'])}} @endif"
                                        class="rounded" alt="image" width="50" height="50"></td>
                                <td>{{priceFormat($product->price)}} تومان</td>
                                <td>{{$product->category->name}}</td>
                                <td>
                                    <label>
                                        <input id="{{$product->id}}" onchange="changeStatus({{$product->id}})"
                                               data-url="{{route('admin.market.product.status', $product->id)}}"
                                               type="checkbox" @if($product->status===1) checked @endif>
                                    </label>
                                </td>

                                <td>
                                    <label>
                                        <input id="{{$product->id}}-marketable"
                                               onchange="changeStatus({{$product->id}}, '-marketable')"
                                               data-url="{{route('admin.market.product.marketable', $product->id)}}"
                                               type="checkbox" @if($product->marketable===1) checked @endif>
                                    </label>
                                </td>

                                <td class="width-8-rem text-left has-dropdown">
                                    <div class="dropdown" style="">
                                        <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle"
                                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-expanded="false">
                                            <i class="fa fa-tools"></i> عملیات
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a href="{{route('admin.market.gallery.index', $product->id)}}" class="dropdown-item text-right">گالری</a>
                                            <a href="{{route('admin.market.color.index', $product->id)}}" class="dropdown-item text-right">رنگ ها</a>
                                            <a href="{{route('admin.market.guarantee.index', $product->id)}}" class="dropdown-item text-right">گارانتی</a>
                                            <a href="{{route('admin.market.product.edit', $product->id)}}" class="dropdown-item text-right"> ویرایش</a>
                                            <form class="d-inline" action="{{route('admin.market.product.destroy', $product->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="dropdown-item text-right delete" type="submit">حذف</button>
                                            </form>
                                        </div>
                                    </div>
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

    @include('admin.scripts.status-control')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
