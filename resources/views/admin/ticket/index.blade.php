@extends('admin.layouts.master')

@section('head-tag')
    <title>تیکت ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#"> خانه</a></li>
            {{--<li class="breadcrumb-item font-size-12"> <a href="#"> بخش تیکت ها</a></li>--}}
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تیکت ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">


                <section class="d-flex justify-content-between align-items-center mt-4 mb-3">

                    {{--<a href="#" class="btn btn-info btn-sm disabled">ایجاد تیکت </a>--}}

                    <section class="main-body-container-header">
                        <h5>تیکت ها</h5>
                    </section>

                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                {{--
                            <section class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نویسنده تیکت</th>
                                            <th>عنوان تیکت</th>
                                            <th>دسته تیکت</th>
                                            <th>اولویت تیکت</th>
                                            <th>ارجاع شده از</th>
                                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>1</th>
                                            <td>حامد احمدی	</td>
                                            <td>پرداخت انجام نمیشه!	</td>
                                            <td>دسته فروش	</td>
                                            <td>فوری</td>
                                            <td>-</td>
                                            <td class="width-16-rem text-left">
                                                <a href="{{ route('admin.ticket.show') }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهده</a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </section>
                --}}

                <section class="container-fluid mt-5">
                    <!-- تب‌ها (تمام عرض) -->
                    <nav>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">تیکت های جدید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false">تیکت های باز</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                   aria-controls="contact" aria-selected="false">تیکت های بسته</a>
                            </li>
                        </ul>
                    </nav>

                    <!-- محتوای تب‌ها -->
                    <section class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @include('admin.ticket.items')
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @include('admin.ticket.items')
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @include('admin.ticket.items')
                        </div>
                    </section>
                </section>


            </section>
        </section>
    </section>

@endsection
