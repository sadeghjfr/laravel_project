@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')

    <section class="d-flex justify-content-between align-items-center">

            <ol class="breadcrumb mb-0 w-100 ml-2">
                <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}"> خانه</a></li>
                <li class="breadcrumb-item font-size-12"> <a href="#"> بخش فروش</a></li>
                <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
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
                                <a class="nav-link" id="unseen-tab" data-toggle="tab" href="#unseen" role="tab"
                                   aria-controls="unseen" aria-selected="true" data-tab-id="unseen">خوانده نشده</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="waiting-tab" data-toggle="tab" href="#waiting" role="tab"
                                   aria-controls="waiting" aria-selected="false" data-tab-id="waiting">در انتظار تایید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab"
                                   aria-controls="approved" aria-selected="false" data-tab-id="approved">تایید شده</a>
                            </li>
                        </ul>
                    </nav>

                    <section class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="unseen" role="tabpanel" aria-labelledby="unseen-tab">
                            @include('admin.market.comment.items', ['items' => $unseenComments, 'status' => 'unseen'])
                        </div>
                        <div class="tab-pane fade" id="waiting" role="tabpanel" aria-labelledby="waiting-tab">
                            @include('admin.market.comment.items', ['items' => $waitingComments, 'status' => 'waiting'])
                        </div>
                        <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                            @include('admin.market.comment.items', ['items' => $approvedComments, 'status' => 'approved'])
                        </div>
                    </section>

                </section>

            </section>
        </section>
    </section>


@endsection

@section('script')

    @include('admin.scripts.tab-control', ['section' => ''])
    @include('admin.scripts.status-control')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection


