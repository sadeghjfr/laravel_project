@extends('admin.layouts.master')

@section('head-tag')
<title>پست ها</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#"> بلاگ</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> پست ها</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <a href="{{ route('admin.content.post.create') }}" class="btn btn-info btn-sm">ایجاد پست </a>
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان پست</th>
                            <th>تصویر</th>
                            <th>دسته بندی</th>
                            <th>زمان انتشار</th>
                            <th>فعال سازی</th>
                            <th>امکان درج نظر</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($posts as $key => $post)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$post->title}}</td>
                            <td><img class="rounded" src="{{asset($post->image)}}" alt="تصویر" width="75" height="50"></td>
                            <td>{{$post->postCategory->name}}</td>
                            <td>{{jalaliDate($post->published_at, '%A, %d %B %Y - %H:i')}}</td>
                            <td>
                                <label>
                                    <input id="{{$post->id}}" onchange="changeStatus({{$post->id}})" data-url="{{route('admin.content.post.status', $post->id)}}" type="checkbox" @if($post->status===1) checked @endif>
                                </label>
                            </td>

                            <td>
                                <label>
                                    <input id="{{$post->id}}-commentable" onchange="changeStatus({{$post->id}}, '-commentable')" data-url="{{route('admin.content.post.commentable', $post->id)}}" type="checkbox" @if($post->commentable===1) checked @endif>
                                </label>
                            </td>

                            <td class="width-16-rem">
                                <a href="{{route('admin.content.post.edit', $post->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form class="d-inline" action="{{route('admin.content.post.destroy', $post->id)}}" method="post">
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

    @include('admin.scripts.status-control')
    @include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
