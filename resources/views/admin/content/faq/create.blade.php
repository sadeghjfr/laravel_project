@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد سوال جدید</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.faq.index')}}"> سوالات متداول</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد سوال</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد سوال
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.faq.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{route('admin.content.faq.store')}}" method="post">
                        <section class="row">

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="">سوال</label>
                                    <input id="name" type="text" class="form-control form-control-sm">
                                </div>
                            </section>

                            <section class="col-12">
                                <div class="form-group">
                                    <label for="">پاسخ</label>
                                    <textarea name="answer" id="answer"  class="form-control form-control-sm" rows="6"></textarea>
                                </div>
                            </section>

                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('answer');
    </script>

@endsection
