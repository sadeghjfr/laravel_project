@extends('admin.layouts.master')

@section('head-tag')
    <title>نمایش نظر</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}"> خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بلاگ</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.content.comment.index')}}"> نظرات</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> نمایش نظر</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="card mb-3">

                    <section class="d-flex justify-content-between align-items-center bg-custom-pink">
                        <section class="card-header text-white w-100">
                            {{$comment->user->fullName}} - شناسه : {{$comment->user->id}}
                        </section>
                        <a href="{{ route('admin.content.comment.index') }}" class="btn btn-info btn-sm ml-2">بازگشت</a>
                    </section>

                    <section class="card-body">
                        <h5 class="card-title"> پست : {{$comment->commentable->title}}</h5>
                        <p class="card-text">{{$comment->body}}</p>
                    </section>
                </section>

                @foreach($comment->children as $answerComment)

                    <section class="card mb-3">

                        <section class="d-flex justify-content-between align-items-center bg-custom-light-green">
                            <section class="card-header text-white w-100">
                                پاسخ ادمین :
                            </section>
                            <form class="d-inline" action="{{route('admin.content.comment.deleteAnswer', $answerComment->id)}}"
                                  method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger ml-2 btn-sm delete" type="submit">حذف</button>
                            </form>
                        </section>

                        <section class="card-body">
                            <p class="card-text">{{$answerComment->body}}</p>
                        </section>
                    </section>

                @endforeach

                @if($comment->parent == null)

                    <section>
                        <form action="{{ route('admin.content.comment.answer', $comment->id) }}" method="post">
                            @csrf
                            <section class="row">
                                <section class="col-12 mb-2">
                                    <div class="form-group mb-1">
                                        <label for="body">پاسخ ادمین </label>
                                        <textarea name="body" class="form-control form-control-sm"
                                                  rows="4">{{old('body')}}</textarea>
                                    </div>
                                    @error('body')
                                    <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                    @enderror
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

@section('script')

    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
