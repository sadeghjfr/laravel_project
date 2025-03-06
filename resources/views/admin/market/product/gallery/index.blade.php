@extends('admin.layouts.master')

@section('head-tag')
<title>گالری</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> فروشگاه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.product.index')}}"> محصولات</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> گالری</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <a href="{{ route('admin.market.gallery.create', $product->id) }}" class="btn btn-info btn-sm">ایجاد تصویر جدید برای {{$product->name}} </a>
                <div class="max-width-16-rem">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover h-150px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> تصویر کالا</th>
                            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->images as $image)

                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ asset($image->image['indexArray'][$image->image['currentImage']] ) }}" alt="" width="50" height="50">
                            </td>

                            <td class="width-16-rem">
                                <form class="d-inline" action="{{ route('admin.market.gallery.destroy', ['product' => $product->id , 'gallery' => $image->id] ) }}" method="post">
                                    @csrf
                                    {{ method_field('delete') }}
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
