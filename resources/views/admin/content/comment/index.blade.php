@extends('admin.layouts.master')

@section('head-tag')
    <title>نظرات</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نظرات</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نظرات
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 pb-2">
                    {{--<a href="#" class="btn btn-info btn-sm disabled">ایجاد نظر </a>--}}
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کاربر</th>
                            <th>پاسخ به</th>
                            <th>نظر</th>
                            <th>پست</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($comments as $key => $comment)

                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{$comment->user->fullName}}</td>
                                <td>{{ $comment->parent_id ? $comment->parent->user->fullName : '-' }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($comment->body, 10) }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($comment->commentable->title, 20) }}</td>

                                <td>
                                    @if($comment->parent_id == null)
                                        @switch($comment->status)
                                            @case('unseen') <p style="color: red">{{'خوانده نشده'}}</p> @break
                                            @case('waiting')<p style="color: darkorange">{{'در انتظار تایید'}}</p>@break
                                            @case('approved')<p style="color: green">{{'تایید شده'}}</p>@break
                                        @endswitch
                                    @endif
                                </td>

                                <td class="width-16-rem text-left">

                                    <a href="{{ route('admin.content.comment.show', $comment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> نمایش</a>

                                    @if($comment->parent_id == null)
                                        <form class="d-inline" action="{{route('admin.content.comment.status', $comment->id)}}" method="get">
                                            @csrf
                                            @switch($comment->status)
                                                @case('waiting')
                                                    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-check"></i>تایید</button>
                                                    @break
                                                @case('approved')
                                                    <button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-clock"></i> عدم تایید</button>
                                                    @break
                                            @endswitch
                                        </form>
                                    @endif

                                    <form class="d-inline" action="{{route('admin.content.comment.destroy', $comment->id)}}" method="post">
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


