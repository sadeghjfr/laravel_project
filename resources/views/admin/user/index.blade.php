@extends('admin.layouts.master')

@section('head-tag')
    <title>کاربران</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> بخش کاربران</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center my-2 mx-3">

                    <a href="{{ route('admin.user.create') }}" class="btn btn-info btn-sm ml-2 mt-1">ایجاد کاربر جدید</a>

                    <div class="max-width-16-rem ml-2">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>

                </section>

                <section class="container-fluid mt-3">

                    <nav>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab"
                                   aria-controls="admin" aria-selected="true" data-tab-id="admin">کاربران ادمین</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="customer-tab" data-toggle="tab" href="#customer" role="tab"
                                   aria-controls="customer" aria-selected="false" data-tab-id="customer">کاربران مشتری</a>
                            </li>
                        </ul>
                    </nav>

                    <section class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                            @include('admin.user.items', ['users' => $admins, 'isAdmin' => true])
                        </div>
                        <div class="tab-pane fade" id="customer" role="tabpanel" aria-labelledby="customer-tab">
                            @include('admin.user.items', ['users' => $customers, 'isAdmin' => false])
                        </div>
                    </section>

                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    <script type="text/javascript">
        function changeActive(id) {
            var element = $("#" + id + '-active')
            var url = element.attr('data-url')
            var elementValue = !element.prop('checked');

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('فعال سازی کاربر با موفقیت انجام شد')
                        } else {
                            element.prop('checked', false);
                            successToast('غیر فعال سازی کاربر با موفقیت انجام شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی بوجود امده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });

            function successToast(message) {

                var successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5500).queue(function () {
                    $(this).remove();
                })
            }

            function errorToast(message) {

                var errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';

                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(5500).queue(function () {
                    $(this).remove();
                })
            }
        }
    </script>

    @include('admin.scripts.tab-control')
    @include('admin.scripts.status-control')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
