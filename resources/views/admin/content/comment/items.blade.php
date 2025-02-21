<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>کاربر</th>
            <th>پست</th>
            <th>نظر</th>
            <th>پاسخ داده شده</th>
            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($items as $key => $comment)

            <tr class="bg-{{$comment->children->all() ? 'custom-green' : 'custom-yellow'}}">
                <th>{{ $key + 1 }}</th>
                <td>{{$comment->user->fullName}}</td>
                <td>{{ \Illuminate\Support\Str::limit($comment->commentable->title, 30)}}</td>
                <td>{{ \Illuminate\Support\Str::limit($comment->body, 30) }}</td>

                <td>@if($comment->children->all()!=null)
                        <i class="fa fa-check text-success"></i>
                    @else
                        <i class="fa fa-times text-danger"></i>
                    @endif</td>

                <td class="width-16-rem text-left">
                    <a href="{{ route('admin.content.comment.show', $comment->id) }}" class="btn btn-info btn-sm"><i
                            class="fa fa-eye"></i> مشاهده</a>
                    @if($status == 'waiting' || $status == 'approved')
                        <a href="{{ route('admin.content.comment.status', $comment->id) }}"
                           class="btn btn-{{ $comment->status == 'waiting' ? 'success' : 'warning' }} btn-sm text-white"> {{ $comment->status == 'waiting' ? 'تایید کردن' : 'عدم تایید' }}</a>
                        <form class="d-inline" action="{{route('admin.content.comment.destroy', $comment->id)}}"
                              method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i>
                                حذف
                            </button>
                        </form>
                    @endif
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>
</section>
