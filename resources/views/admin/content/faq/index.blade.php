@extends('admin.layouts.master')

@section('head-tag')
    <title>سوالات متداول</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بلاگ</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> سوالات متداول</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <a href="{{route('admin.content.faq.create')}}" class="btn btn-info btn-sm">ایجاد سوال جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>سوال</th>
                            <th>پاسخ</th>
                            <th>فعال سازی</th>
                            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($faqs as $key => $faq)

                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$faq->question}}</td>
                            <td>{{$faq->answer}}</td>
                            <td>
                                <label>
                                    <input id="{{$faq->id}}" onchange="changeStatus({{$faq->id}})" data-url="{{route('admin.content.faq.status', $faq->id)}}" type="checkbox" @if($faq->status===1) checked @endif>
                                </label>
                            </td>

                            <td class="width-16-rem">
                                <a href="{{route('admin.content.faq.edit', $faq->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{route('admin.content.faq.destroy', $faq->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                </form>
                            </td>

                        </tr>

                        @endforeach

                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection

@section('script')

    @include('admin.scripts.status-control')

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
