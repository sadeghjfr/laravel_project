@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش اطلاعیه پیامکی</title>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#"> اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.notify.sms.index')}}"> اطلاعیه پیامکی</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش اطلاعیه پیامکی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">


                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش اطلاعیه پیامکی
                        </h5>
                    </section>
                    <a href="{{ route('admin.notify.sms.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.notify.sms.update', $sms->id) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">عنوان پیامک</label>
                                    <input type="text" name="title" class="form-control form-control-sm"
                                        value="{{ old('title', $sms->title) }}">
                                </div>
                                @error('title')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">زمان انتشار</label>
                                    <input type="text" name="published_at" id="published_at"
                                        class="form-control form-control-sm d-none" value="{{ $sms->published_at }}">
                                    <input type="text" id="published_at_view"  class="form-control form-control-sm" value={{ $sms->published_at }}>
                                </div>
                                @error('published_at')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="status">وضعیت</label>
                                    <select name="status"  class="form-control form-control-sm" id="status">
                                        <option value="0" @if (old('status', $sms->status) == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if (old('status', $sms->status) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">متن پیامک</label>
                                    <textarea name="body" id="body" class="form-control form-control-sm"
                                        rows="6">{{ old('body', $sms->body) }}</textarea>
                                </div>
                                @error('body')
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


@section('script')

    @include('admin.scripts.date-time-picker-control')

@endsection
