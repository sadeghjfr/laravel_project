@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> بخش تیکت ها</li>
            <li class="breadcrumb-item font-size-12"> تیکت ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center my-2 mx-3">

                    {{--<a href="#" class="btn btn-info btn-sm disabled">ایجاد تیکت </a>--}}

                    <div class="max-width-16-rem ml-2">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>

                </section>

                <section class="container-fluid mt-3">

                    <nav>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab"
                                   aria-controls="new" aria-selected="true" data-tab-id="new">تیکت های جدید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="open-tab" data-toggle="tab" href="#open" role="tab"
                                   aria-controls="open" aria-selected="false" data-tab-id="open">تیکت های باز</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="close-tab" data-toggle="tab" href="#close" role="tab"
                                   aria-controls="close" aria-selected="false" data-tab-id="close">تیکت های بسته</a>
                            </li>
                        </ul>
                    </nav>

                    <section class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
                            {{--@include('admin.ticket.items', ['items' => $newTickets])--}}
                            @include('admin.ticket.items')
                        </div>
                        <div class="tab-pane fade" id="open" role="tabpanel" aria-labelledby="open-tab">
                            {{--@include('admin.ticket.items', ['items' => $openTickets])--}}
                            @include('admin.ticket.items')
                        </div>
                        <div class="tab-pane fade" id="close" role="tabpanel" aria-labelledby="close-tab">
                            {{--@include('admin.ticket.items', ['items' => $closeTickets])--}}
                            @include('admin.ticket.items')
                        </div>
                    </section>

                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    @include('admin.scripts.tab-control')
    @include('admin.scripts.status-control')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
