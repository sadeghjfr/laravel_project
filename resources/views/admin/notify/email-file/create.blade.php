@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد فایل اطلاعیه ایمیلی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#"> اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.notify.email.index')}}"> اطلاعیه ایمیلی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.notify.email-file.index', $email->id)}}"> فایل های اطلاعیه ایمیلی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد فایل اطلاعیه ایمیلی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">


            <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد فایل اطلاعیه ایمیلی
                    </h5>
                </section>
                <a href="{{ route('admin.notify.email-file.index', $email->id) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.notify.email-file.store', $email->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="file">فایل</label>
                                <input type="file" class="form-control form-control-sm" name="file" id="file">
                            </div>
                            @error('file')
                            <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                        @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="status">وضعیت</label>
                                <select name="status" class="form-control form-control-sm" id="status">
                                    <option value="0" @if(old('status') == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
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
