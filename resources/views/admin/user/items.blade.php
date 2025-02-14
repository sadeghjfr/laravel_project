<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>ایمیل</th>
            <th>شماره موبایل</th>
            <th>نام و نام خانوادگی</th>
            <th>فعال سازی</th>
            <th>وضعیت</th>
            @if($isAdmin)
                <th>نقش</th>
            @endif
            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($users as $key => $user)

            <tr>
                <th>{{ $key + 1 }}</th>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ $user->full_name }}</td>
                <td>
                    <label>
                        <input id="{{ $user->id }}-active" onchange="changeActive({{ $user->id }})"
                               data-url="{{ route('admin.user.activation', $user->id) }}" type="checkbox"
                               @if ($user->activation === 1)
                                   checked
                            @endif>
                    </label>
                </td>
                <td>
                    <label>
                        <input id="{{ $user->id }}" onchange="changeStatus({{ $user->id }})"
                               data-url="{{ route('admin.user.status', $user->id) }}" type="checkbox"
                               @if ($user->status === 1)
                                   checked
                            @endif>
                    </label>
                </td>
                @if($isAdmin)
                    <td>سوپر ادمین</td>
                @endif
                <td class="width-22-rem text-left">
                    @if($isAdmin)
                        <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> نقش</a>
                    @endif
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i> ویرایش</a>
                    <form class="d-inline" action="{{ route('admin.user.destroy', $user->id) }}"
                          method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف
                        </button>
                    </form>
                </td>
            </tr>

        @endforeach


        </tbody>
    </table>
</section>

