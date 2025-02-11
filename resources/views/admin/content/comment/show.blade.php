@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.comment.index')}}"> نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        نمایش نظر
                    </h5>

                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">

                    <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm ml-5">بازگشت</a>

                    @if($comment->parent_id==null)
                    {{'وضعیت : '}}
                    @switch($comment->status)
                        @case('unseen'){{'خوانده نشده'}}@break
                        @case('waiting'){{'در انتظار تایید'}}@break
                        @case('approved'){{'تایید شده'}}@break
                    @endswitch

                    <form class="d-inline mr-5" action="{{route('admin.content.comment.status', $comment->id)}}" method="get">
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

                </section>

                <section class="card-body">
                    <h5 class="card-title">عنوان پست : {{$comment->commentable->title}} </h5>
                    <h5 class="card-title">  کد پست : {{$comment->commentable_id}}</h5>
                </section>

                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                       کاربر :  {{$comment->user->fullName}} - کد کاربر :  {{$comment->user_id}}
                    </section>

                    <section class="card-body">
                        <p class="card-text">{{$comment->body}}</p>

                    @if($comment->parent_id != null)
                            <section class="card-header text-white bg-custom-yellow">
                                پاسخ به :  {{$comment->parent->user->fullName}} - کد کاربر :  {{$comment->parent->user->id}}
                            </section>

                        <p class="card-text mr-1 mt-2">{{$comment->parent->body}}</p>
                        @endif
                    </section>
                </section>

                @if($comment->parent_id==null)
                    <section>
                        <form action="{{route('admin.content.comment.answer', $comment->id)}}" method="POST">
                            @csrf
                            <section class="row">
                                <section class="col-12">
                                    <div class="form-group">
                                        <label for="">پاسخ ادمین</label>
                                        <textarea id="body" name="body" class="form-control form-control-sm" rows="4"></textarea>
                                    </div>
                                </section>
                                <section class="col-12">
                                    <button class="btn btn-primary btn-sm">ثبت</button>
                                </section>
                            </section>
                        </form>
                    </section>
                @endif

            </section>
        </section>
    </section>

@endsection
