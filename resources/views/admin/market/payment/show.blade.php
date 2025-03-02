@extends('admin.layouts.master')

@section('head-tag')
<title>نمایش پرداخت</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.market.payment.index') }}"> پرداخت ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش پرداخت</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="card mb-3">
                <section class="d-flex justify-content-between align-items-center bg-custom-pink">
                    <section class="card-header text-white w-100">
                       پرداخت کننده :  {{$payment->user->fullName}} - شناسه : {{$payment->user->id}}
                    </section>
                    <a href="{{ route('admin.market.payment.index') }}" class="btn btn-info btn-sm ml-2">بازگشت</a>
                </section>
                <section class="card-body">
                    <h5 class="card-title"> مبلغ : {{ number_format($payment->paymentable->amount) }} تومان</h5>
                    <p class="card-text">  نوع پرداخت : {{$payment->type_fa}}</p>
                    <p class="card-text">  وضعیت پرداخت : {{$payment->status_fa}}</p>
                    <p class="card-text"> بانک : {{ $payment->paymentable->gateway ?? '-' }}</p>
                    <p class="card-text"> شماره تراکنش : {{ $payment->paymentable->transaction_id ?? '-' }}</p>
                    <p class="card-text"> تاریخ پرداخت : {{ jalaliDate($payment->paymentable->pay_date) ?? '-' }}</p>
                    <p class="card-text">  دریافت کننده : {{ $payment->paymentable->cash_receiver ?? '-' }}</p>
                </section>
            </section>

        </section>
    </section>
</section>

@endsection
