<section class="table-responsive">
    <table class="table table-striped table-hover h-150px" style="height: 10rem">
        <thead>
        <tr>
            <th>#</th>
            <th>سفارش دهنده</th>
            <th>مبلغ نهایی</th>
            <th>وضعیت پرداخت</th>
            <th>شیوه ارسال</th>
            <th>وضعیت سفارش</th>
            <th>تاریخ ارسال</th>
            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $order)

            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $order->user->fullName }}</td>
                <td>{{ priceFormat(($order->order_final_amount -  $order->order_discount_amount)+$order->delivery->amount) }} تومان</td>
                <td>{{$order->payment->status_fa}}</td>
                <td>{{ $order->delivery->name }}</td>
                <td>{{$order->status_fa}}</td>
                <td>@if($order->sent_at) {{jalaliDate($order->sent_at)}} @else {{'-'}} @endif</td>
                <td class="width-16-rem has-dropdown">
                    <a href="{{ route('admin.market.order.show', $order->id) }}"
                       class="btn btn-info btn-sm"> نمایش</a>
                    <div class="dropdown d-inline">
                        <a href="#" class="btn btn-success btn-sm dropdown-toggle"
                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-expanded="false">وضعیت
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                            <a href="{{route('admin.market.order.waiting', $order->id)}}" class="dropdown-item text-right">در انتظار</a>
                            <a href="{{route('admin.market.order.sent', $order->id)}}" class="dropdown-item text-right">ارسال شده</a>
                            <a href="{{route('admin.market.order.delivered', $order->id)}}" class="dropdown-item text-right">تحویل شده</a>

                        </div>
                    </div>

                    <div class="dropdown d-inline">
                        <a href="#" class="btn btn-warning btn-sm dropdown-toggle"
                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-expanded="false">عملیات
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                            <a href="{{route('admin.market.order.return', $order->id)}}" class="dropdown-item text-right">مرجوعی</a>
                            <a href="{{route('admin.market.order.cancel', $order->id)}}" class="dropdown-item text-right">باطل کردن</a>
                            <form class="d-inline" action="{{route('admin.market.order.destroy', $order->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="dropdown-item text-right delete" type="submit">حذف کردن</button>
                            </form>
                        </div>
                    </div>

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
</section>
