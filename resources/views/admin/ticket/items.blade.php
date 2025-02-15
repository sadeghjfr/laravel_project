
    <section class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>نویسنده تیکت</th>
                <th>عنوان تیکت</th>
                <th>دسته تیکت</th>
                <th>اولویت تیکت</th>
                <th>ارجاع شده از</th>
                <th>پاسخ داده شده</th>
                <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($items as $ticket)

                <tr class="bg-{{$ticket->children->all() ? 'custom-green' : 'custom-yellow'}}">

                    <th>{{$loop->iteration}}</th>
                    <td>{{$ticket->user->fullName ?? '-'}}</td>
                    <td>{{$ticket->subject}}</td>
                    <td>{{$ticket->category->name ?? '-'}}</td>
                    <td>{{$ticket->priority->name ?? '-'}}</td>
                    <td>{{$ticket->admin->user->fullName ?? '-'}}</td>
                    <td>@if($ticket->children->all()!=null) <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</td>

                    <td class="width-16-rem text-left">
                        <a href="{{ route('admin.ticket.show', $ticket->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> مشاهده</a>
                        @if($status == 'open' || $status == 'close')
                            <a href="{{ route('admin.ticket.status', $ticket->id) }}" class="btn btn-{{ $ticket->status == 'close' ? 'success' : 'warning' }} btn-sm text-white"> {{ $ticket->status == 'close' ? 'باز کردن' : 'بستن' }}</a>
                            <form class="d-inline" action="{{route('admin.ticket.destroy', $ticket->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </form>
                        @endif
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </section>
