@extends('admin.layouts.master')

@section('head-tag')
    <title>ویژگی‌های دسته‌بندی‌ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویژگی‌های دسته‌بندی‌ها</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <a href="{{ route('admin.market.attribute.create') }}" class="btn btn-info btn-sm">ایجاد ویژگی جدید</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام ویژگی</th>
                            <th>واحد اندازه گیری</th>
                            <th>دسته والد</th>
                            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($attributes as $attribute)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->unit }}</td>
                                <td>{{ $attribute->category->name }}</td>
                                <td class="width-22-rem">
                                    <a href="{{ route('admin.market.value.index', $attribute->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> مقادیر</a>
                                    <a href="{{ route('admin.market.attribute.edit', $attribute->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{ route('admin.market.attribute.destroy', $attribute->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete" type="submit"><i
                                                class="fa fa-trash-alt"></i> حذف
                                        </button>
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

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection

