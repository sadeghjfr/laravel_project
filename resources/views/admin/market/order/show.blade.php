@extends('admin.layouts.master')

@section('head-tag')
    <title>فاکتور سفارش</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.market.order.index')}}"> سفارشات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> فاکتور سفارش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="row mb-2 mr-2 main-body-container-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">فاکتور</h5>
                    <div>
                        <a href="" class="btn btn-dark btn-sm text-white" id="print"><i class="fa fa-print"></i> چاپ</a>
                        <a href="{{ route('admin.market.order.detail', $order->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-book"></i> جزئیات</a>
                        <a href="{{ route('admin.market.order.index') }}" class="btn btn-info btn-sm ml-3">بازگشت</a>
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150px" id="printable">

                        <tbody>

                        <tr class="border-bottom">
                            <th class="text-right">شناسه سفارش</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->id }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-right">نام مشتری</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->user->fullName ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">آدرس</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->address ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">شهر</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->city->name ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">کد پستی</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->postal_code ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">پلاک</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->no ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">واحد</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->unit ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">نام گیرنده</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->recipient_first_name ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">نام خانوادگی گیرنده</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->recipient_last_name ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">موبایل</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->address->mobile ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">نوع پرداخت</th>
                            <td class="text-right font-weight-bolder">
                                {{$order->payment->type_fa}}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">وضعیت پرداخت</th>
                            <td class="text-right font-weight-bolder">
                                {{$order->payment->status_fa}}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-right">تاریخ پرداخت</th>
                            <td class="text-right font-weight-bolder">
                                {{ jalaliDate($order->payment->paymentable->pay_date, 'H:i:s Y-m-d') ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-right">وضعیت سفارش</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->status_fa ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">زمان ارسال</th>
                            <td class="text-right font-weight-bolder">
                                @if($order->sent_at) {{jalaliDate($order->sent_at)}} @else {{'-'}} @endif
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">مجموع مبلغ سفارش (بدون تخفیف)</th>
                            <td class="text-right font-weight-bolder">
                                {{ priceFormat($order->order_final_amount) . ' تومان' ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">مجموع تمامی مبلغ تخفیفات</th>
                            <td class="text-right font-weight-bolder">
                                {{ priceFormat($order->order_discount_amount) . ' تومان' ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">مبلغ تخفیف همه محصولات</th>
                            <td class="text-right font-weight-bolder">
                                {{ priceFormat($order->order_total_products_discount_amount) . ' تومان' ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">هزینه ارسال</th>
                            <td class="text-right font-weight-bolder">
                                {{ priceFormat($order->delivery->amount) . ' تومان' ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">مبلغ نهایی</th>
                            <td class="text-right font-weight-bolder">
                                {{ priceFormat(($order->order_final_amount -  $order->order_discount_amount)+$order->delivery->amount) . ' تومان' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">بانک</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->payment->paymentable->gateway ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">کد تخفیف استفاده شده</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->coupon->code ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">تخفیف کد تخفیف</th>
                            <td class="text-right font-weight-bolder">
                                @if($order->coupon)
                                    @if($order->coupon->amount_type == 0)
                                        {{ '% ' . priceFormat($order->coupon->amount) ?? '-' }}
                                    @else
                                        {{ priceFormat($order->coupon->amount) . ' تومان' ?? '-' }}
                                    @endif
                                @else
                                    {{'-'}}
                                @endif

                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-right">تخفیف عمومی استفاده شده</th>
                            <td class="text-right font-weight-bolder">
                                {{ $order->commonDiscount->title ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-right">میزان تخفیف عمومی</th>
                            <td class="text-right font-weight-bolder">
                                @if($order->commonDiscount)
                                    {{ '% ' . $order->commonDiscount->percentage ?? '-' }}
                                @else
                                    {{'-'}}
                                @endif
                            </td>


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
