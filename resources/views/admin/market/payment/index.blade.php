@extends('admin.layouts.master')

@section('head-tag')
    <title>پرداخت ها</title>
@endsection

@section('content')

    <section class="d-flex justify-content-between align-items-center">

        <ol class="breadcrumb mb-0 w-100 ml-2">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> پرداخت ها</li>

        </ol>

        <div class="max-width-16-rem my-0">
            <input type="text" class="form-control form-control-sm form-text my-2" placeholder="جستجو">
        </div>

    </section>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="container-fluid mt-3">

                    <nav>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link" id="online-tab" data-toggle="tab" href="#online" role="tab"
                                   aria-controls="online" aria-selected="false" data-tab-id="online">پرداخت های
                                    آنلاین</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="offline-tab" data-toggle="tab" href="#offline"
                                   role="tab"
                                   aria-controls="offline" aria-selected="false" data-tab-id="offline">پرداخت های
                                    کارت به کارت</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cash-tab" data-toggle="tab" href="#cash"
                                   role="tab"
                                   aria-controls="cash" aria-selected="false" data-tab-id="cash">پرداخت های نقدی</a>
                            </li>
                        </ul>
                    </nav>

                    <section class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="online" role="tabpanel" aria-labelledby="online-tab">
                            @include('admin.market.payment.items', ['items' => $onlinePayments])
                        </div>
                        <div class="tab-pane fade" id="offline" role="tabpanel" aria-labelledby="offline-tab">
                            @include('admin.market.payment.items', ['items' => $offlinePayments])
                        </div>
                        <div class="tab-pane fade" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                            @include('admin.market.payment.items', ['items' => $cashPayments])
                        </div>
                    </section>

                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    @include('admin.scripts.tab-control')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
