@extends('admin.layouts.master')

@section('head-tag')
    <title>دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        دسته بندی
                    </h5>
                </section>

                {{--@include('admin.alerts.alert-section.success')--}}

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('admin.content.category.create')}}" class="btn btn-info btn-sm">ایجاد دسته بندی</a>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته بندی</th>
                            <th>دسته والد</th>
                            <th>اسلاگ</th>
                            <th>تصویر</th>
                            <th>تگ ها</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($postCategories as $key => $postCategory)


                            <tr>
                                <th>{{$key+1}}</th>
                                <td>{{$postCategory->name}}</td>
                                <td>{{empty($postCategory->parent_id) ? '-' : $postCategory->parent->name}}</td>
                                <td>{{$postCategory->slug}}</td>
                                <td><img src="@if($postCategory->image !=null) {{asset($postCategory->image['indexArray'][$postCategory->image['currentImage']])}} @endif" alt="image" width="50" height="50"></td>
                                <td>{{$postCategory->tags}}</td>
                                <td>
                                    <label>
                                        <input id="{{$postCategory->id}}" onchange="changeStatus({{$postCategory->id}})" data-url="{{route('admin.content.category.status', $postCategory->id)}}" type="checkbox" @if($postCategory->status===1) checked @endif>
                                    </label>
                                </td>

                                <td class="width-16-rem">
                                    <a href="{{route('admin.content.category.edit', $postCategory->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{route('admin.content.category.destroy', $postCategory->id)}}" method="post">
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
