@extends('admin.layouts.master')

@section('head-tag')
<title>جزئیات سفارش</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}"> خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.market.order.index')}}"> سفارشات</a></li>
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.market.order.show', $order->id)}}"> فاکتور سفارش</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> جزئیات سفارش</li>
    </ol>
  </nav>


  <section class="row" >
    <section class="col-12">
        <section class="main-body-container">
            <section class="row mb-2 mr-2 main-body-container-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">جزئیات سفارش</h5>
                <div>
                    <a href="" class="btn btn-dark btn-sm text-white" id="print"><i class="fa fa-print"></i> چاپ</a>
                    <a href="{{route('admin.market.order.show', $order->id)}}" class="btn btn-info btn-sm ml-2">بازگشت</a>
                </div>
            </section>


            <section class="table-responsive">
                <table class="table table-striped table-hover h-150px" id="printable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>قیمت اولیه</th>
                            <th>تخفیف فروش فوق العاده</th>
                            <th>رنگ</th>
                            <th>گارانتی</th>
                            <th>قیمت نهایی محصول</th>
                            <th>تعداد</th>
                            <th>ویژگی ها</th>
                            <th>قیمت نهایی</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)

                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->singleProduct->name ?? '-' }}</td>
                            <td>{{ number_format($item->singleProduct->price) . ' تومان' ?? '-' }}</td>
                            <td>{{ number_format($item->amazing_sale_discount_amount) ?? '-' }} تومان</td>
                            <td>
                                @if($item->color)
                                    {{ $item->color->color_name ?? '-' }} <br>
                                    افزایش قیمت :
                                    {{ number_format($item->color->price_increase) . ' تومان' ?? '-' }}
                                @else
                                    {{'-'}}
                                @endif
                            </td>
                            <td>
                                @if($item->guarantee)
                                    {{ $item->guarantee->name ?? '-' }} <br>
                                    افزایش قیمت :
                                    {{ number_format($item->guarantee->price_increase) . ' تومان' ?? '-' }}
                                @else
                                    {{'-'}}
                                @endif
                            </td>
                            <td>{{ number_format($item->final_product_price) ?? '-' }} تومان</td>
                            <td>{{ $item->number }} </td>
                            <td>
                                @forelse($item->orderItemAttributes as $attribute)
                                {{ $attribute->categoryAttribute->name ?? '-' }}
                                :
                                    {{ json_decode($attribute->categoryAttributeValue->value, true)['value'] ?? '-' }} <br>
                                    افزایش قیمت : {{ number_format(json_decode($attribute->categoryAttributeValue->value, true)['price_increase']) . ' تومان' ?? '-' }}

                                    <br>
                                    <br>
                                @empty
                                -
                                @endforelse
                            </td>
                            <td>{{ number_format($item->final_total_price) ?? '-'}} تومان</td>

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

    @include('admin.scripts.print-control')

@endsection
