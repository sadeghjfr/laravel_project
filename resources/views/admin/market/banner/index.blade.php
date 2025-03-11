@extends('admin.layouts.master')

@section('head-tag')
<title>بنر ها</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="#"> فروشگاه</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page"> بنر ها</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <a href="{{route('admin.market.banner.create')}}" class="btn btn-info btn-sm">ایجاد بنر جدید</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان بنر</th>
                            <th>آدرس</th>
                            <th>تصویر</th>
                            <th>فعال</th>
                            <th>جایگاه</th>
                            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($banners as $key => $banner)

                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->url }}</td>
                            <td>
                                <img src="{{ asset($banner->image['indexArray'][$banner->image['currentImage']] ) }}" alt="" width="100" height="50">
                            </td>
                            <td>
                                <label>
                                    <input id="{{ $banner->id }}" onchange="changeStatus({{ $banner->id }})" data-url="{{ route('admin.market.banner.status', $banner->id) }}" type="checkbox" @if ($banner->status === 1)
                                    checked
                                    @endif>
                                </label>
                            </td>

                            <td>
                               {{ $banner->position_name }}
                            </td>
                            <td class="width-16-rem">
                                <a href="{{ route('admin.market.banner.edit', $banner->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.market.banner.destroy', $banner->id) }}" method="post">
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
@include('admin.scripts.status-control')

@endsection
