@extends('admin.layouts.master')

@section('head-tag')
    <title>مقادیر ویژگی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.attribute.index') }}"> ویژگی‌های دسته‌بندی‌ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> مقادیر ویژگی</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mt-2 mb-3 pb-2">
                    <a href="{{ route('admin.market.value.create', $attribute->id) }}" class="btn btn-info btn-sm">
                        ایجاد مقدار برای ویژگی {{$attribute->name}} در دسته بندی {{$attribute->category->name}}
                    </a>
                    <div class="max-width-16-rem">
                        <a href="{{ route('admin.market.attribute.index', $attribute->id) }}" class="btn btn-info btn-sm">بازگشت</a>
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ویژگی</th>
                            <th>دسته بندی</th>
                            <th>محصول</th>
                            <th>مقدار</th>
                            <th>افزایش قیمت</th>
                            <th>نوع</th>
                            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($attribute->values as $value)

                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->category->name }}</td>
                                <td>{{ $value->product->name }}</td>
                                <td>{{ json_decode($value->value)->value }} {{$attribute->unit}}</td>
                                <td>{{ number_format(json_decode($value->value)->price_increase) . ' تومان' }}</td>
                                <td>{{ $value->type == 0 ? 'ساده' : 'انتخابی'}}</td>
                                <td class="width-22-rem">
                                    <a href="{{ route('admin.market.value.edit', ['attribute' => $attribute->id , 'value' => $value->id] ) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{ route('admin.market.value.destroy', ['attribute' => $attribute->id , 'value' => $value->id] ) }}" method="post">
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

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection

