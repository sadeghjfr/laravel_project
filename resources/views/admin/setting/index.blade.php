@extends('admin.layouts.master')

@section('head-tag')
    <title>تنظیمات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> تنظیمات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان سایت</th>
                            <th>توضیحات سایت</th>
                            <th>کلمات کلیدی سایت</th>
                            <th>لوگو سایت</th>
                            <th>آیکون سایت</th>
                            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>1</th>
                            <td>{{ $setting->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($setting->description, 20) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($setting->keywords, 20) }}</td>
                            <td><img class="rounded" src="{{ asset($setting->logo ) }}" alt="logo" width="100" height="50"></td>
                            <td><img class="rounded" src="{{ asset($setting->icon ) }}" alt="icon" width="50" height="50"></td>
                            <td class="width-22-rem">
                                <a href="{{route('admin.setting.edit', $setting->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </section>

            </section>
        </section>
    </section>

@endsection
