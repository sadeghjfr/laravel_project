@extends('admin.layouts.master')

@section('head-tag')
    <title>سفارشات</title>
@endsection

@section('content')


    <section class="d-flex justify-content-between align-items-center">

        <ol class="breadcrumb mb-0 w-100 ml-2">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سفارشات</li>

        </ol>

    </section>

    <div class="max-width-16-rem my-0">
        <input type="text" class="form-control form-control-sm form-text my-2" placeholder="جستجو">
    </div>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container mt-0">

                <section class="container-fluid mt-3">

                    <nav>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab"
                                   aria-controls="new" aria-selected="false" data-tab-id="new">سفارشات جدید</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="waiting-tab" data-toggle="tab" href="#waiting"
                                   role="tab"
                                   aria-controls="waiting" aria-selected="false" data-tab-id="waiting">در انتظار ارسال</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="sent-tab" data-toggle="tab" href="#sent"
                                   role="tab"
                                   aria-controls="sent" aria-selected="false" data-tab-id="sent">ارسال شده</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="delivered-tab" data-toggle="tab" href="#delivered"
                                   role="tab"
                                   aria-controls="delivered" aria-selected="false" data-tab-id="delivered">تحویل شده</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="canceled-tab" data-toggle="tab" href="#canceled"
                                   role="tab"
                                   aria-controls="canceled" aria-selected="false" data-tab-id="canceled">باطل شده</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="returned-tab" data-toggle="tab" href="#returned"
                                   role="tab"
                                   aria-controls="returned" aria-selected="false" data-tab-id="returned">مرجوع شده</a>
                            </li>

                        </ul>
                    </nav>

                    <section class="tab-content" id="myTabContent">

                        <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                            @include('admin.market.order.items', ['items' => $newOrders])
                        </div>

                        <div class="tab-pane fade" id="waiting" role="tabpanel" aria-labelledby="waiting-tab">
                            @include('admin.market.order.items', ['items' => $waitingOrders])
                        </div>

                        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
                            @include('admin.market.order.items', ['items' => $sentOrders])
                        </div>

                        <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered-tab">
                            @include('admin.market.order.items', ['items' => $deliveredOrders])
                        </div>

                        <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">
                            @include('admin.market.order.items', ['items' => $canceledOrders])
                        </div>

                        <div class="tab-pane fade" id="returned" role="tabpanel" aria-labelledby="returned-tab">
                            @include('admin.market.order.items', ['items' => $returnedOrders])
                        </div>

                    </section>

                </section>

            </section>
        </section>
    </section>


@endsection

@section('script')

    @include('admin.scripts.tab-control', ['section' => '/order'])
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
