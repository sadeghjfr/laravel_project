@extends('admin.layouts.master')

@section('head-tag')
<title>نمایش پرداخت</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.payment.index') }}"> پرداخت ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش پرداخت</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">


            <section class="row mb-2 mr-2 main-body-container-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">پرداخت</h5>
                <div>
                    <a href="" class="btn btn-dark btn-sm text-white" id="print"><i class="fa fa-print"></i> چاپ</a>
                    <a href="{{ route('admin.market.payment.index') }}" class="btn btn-info btn-sm ml-3">بازگشت</a>
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover h-150px" id="printable">

                    <tbody>

                    <tr class="border-bottom">
                        <th class="text-right">شناسه پرداخت</th>
                        <td class="text-right font-weight-bolder">
                            {{ $payment->id }}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">پرداخت کننده</th>
                        <td class="text-right font-weight-bolder">
                            {{$payment->user->fullName ?? '-'}}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">شناسه پرداخت کننده</th>
                        <td class="text-right font-weight-bolder">
                            {{$payment->user->id ?? '-'}}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">موبایل پرداخت کننده</th>
                        <td class="text-right font-weight-bolder">
                            {{$payment->user->mobile ?? '-'}}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">مبلغ پرداختی</th>
                        <td class="text-right font-weight-bolder">
                            {{ number_format($payment->paymentable->amount) }} تومان
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">وضعیت پرداخت</th>
                        <td class="text-right font-weight-bolder">
                            {{$payment->status_fa ?? '-'}}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">نوع پرداخت</th>
                        <td class="text-right font-weight-bolder">
                            {{$payment->type_fa ?? '-'}}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">بانک</th>
                        <td class="text-right font-weight-bolder">
                            {{ $payment->paymentable->gateway ?? '-' }}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">شماره تراکنش</th>
                        <td class="text-right font-weight-bolder">
                            {{ $payment->paymentable->transaction_id ?? '-' }}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">تاریخ پرداخت</th>
                        <td class="text-right font-weight-bolder">
                            {{ jalaliDate($payment->paymentable->pay_date) ?? '-' }}
                        </td>
                    </tr>

                    <tr class="border-bottom">
                        <th class="text-right">دریافت کننده</th>
                        <td class="text-right font-weight-bolder">
                            {{ $payment->paymentable->cash_receiver ?? '-' }}
                        </td>
                    </tr>

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
