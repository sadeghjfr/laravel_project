@extends('admin.layouts.master')

@section('head-tag')
<title>تخفیف عمومی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#"> فروشگاه</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> تخفیف عمومی</li>
    </ol>
  </nav>

  <section class="row">
    <section class="col-12">
        <section class="main-body-container  mt-0">

            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <a href="{{ route('admin.market.discount.commonDiscount.create') }}" class="btn btn-info btn-sm">ایجاد تخفیف عمومی</a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان مناسبت</th>
                            <th>درصد تخفیف</th>
                            <th>حداکثر تخفیف</th>
                            <th>تاریخ شروع</th>
                            <th>تاریخ پایان</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($commonDiscounts as $commonDiscount)

                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <th>{{ $commonDiscount->title }}</th>
                            <th>{{ $commonDiscount->percentage }}%</th>
                            <th>{{ priceFormat($commonDiscount->discount_ceiling) }} تومان</th>
                            <td>{{ jalaliDate($commonDiscount->start_date) }}</td>
                            <td>{{ jalaliDate($commonDiscount->end_date) }}</td>
                            <td class="width-16-rem">
                                <a href="{{ route('admin.market.discount.commonDiscount.edit', $commonDiscount->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{ route('admin.market.discount.commonDiscount.destroy', $commonDiscount->id) }}" method="post">
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
