@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد پیج</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بلاگ</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.page.index')}}">پیج ساز</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پیج</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد پیج
                    </h5>
                </section>
                <a href="{{ route('admin.content.page.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.content.page.store')}}" method="post" id="form">
                    @csrf

                    <section class="row">

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="title">عنوان </label>
                                <input value="{{old('title')}}" name="title" id="title" type="text" class="form-control form-control-sm">
                            </div>
                            @error('title')
                            <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if(old('status')==0) selected @endif>غیر فعال</option>
                                    <option value="1" @if(old('status')==1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 mb-2">
                            <div class="form-group mb-1">
                                <label for="tags">تگ ها</label>
                                <input value="{{old('tags')}}" name="tags" id="tags" type="hidden" class="form-control form-control-sm">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                </select>
                            </div>
                            @error('tags')
                            <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                            @enderror
                        </section>


                        <section class="col-12 mb-2">
                            <div class="form-group mb-1">
                                <label for="description">محتوا</label>
                                <textarea name="body" id="body" type="text" class="form-control form-control-sm" rows="6">{{old('body')}}</textarea>
                            </div>
                            @error('body')
                            <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                            @enderror
                        </section>

                        <section class="col-12 mt-4">
                            <button class="btn btn-primary w-100">ثبت نهایی</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>

    @include('admin.scripts.tags-control')

@endsection
