<section class="table-responsive">
    <table class="table table-striped table-hover" style="height: 10rem">
        <thead>
        <tr>
            <th>#</th>
            <th>پرداخت کننده</th>
            <th>مبلغ</th>
            <th>شماره تراکنش</th>
            <th>بانک</th>
            <th>وضعیت</th>
            <th class="max-width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($items as $payment)

            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $payment->user->fullname }}</td>
                <td>{{ number_format($payment->amount) . ' تومان' }}</td>
                <td>{{$payment->paymentable->transaction_id ?? '-'}}</td>
                <td>{{$payment->paymentable->gateway ?? '-'}}</td>
                <td>{{$payment->status_fa}}</td>

                <td class="width-16-rem has-dropdown">
                    <a href="{{ route('admin.market.payment.show', $payment->id) }}"
                       class="btn btn-info btn-sm"><i class="fa fa-edit"></i> نمایش</a>
                    <div class="dropdown d-inline">
                        <a href="#" class="btn btn-success btn-sm dropdown-toggle"
                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa fa-tools"></i> تغییر وضعیت
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" >
                            <a href="{{route('admin.market.payment.paid', $payment->id)}}" class="dropdown-item text-right"> پرداخت شده</a>
                            <a href="{{route('admin.market.payment.unpaid', $payment->id)}}" class="dropdown-item text-right">پرداخت نشده</a>
                            <a href="{{route('admin.market.payment.canceled', $payment->id)}}" class="dropdown-item text-right">باطل کردن</a>
                            <a href="{{route('admin.market.payment.returned', $payment->id)}}" class="dropdown-item text-right">بازگشت وجه</a>

                        </div>
                    </div>
                </td>
            </tr>

        @endforeach


        </tbody>
    </table>
</section>

