@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش دسته بندی</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.ticket.category.index') }}"> دسته بندی تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش دسته بندی</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ویرایش دسته بندی
                        </h5>
                    </section>
                    <a href="{{ route('admin.ticket.category.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>

                    <form action="{{ route('admin.ticket.category.update', $ticketCategory->id) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">

                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">نام دسته</label>
                                    <input type="text" class="form-control form-control-sm" name="name" id="name"
                                           value="{{ old('name', $ticketCategory->name) }}">
                                </div>
                                @error('name')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>


                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" class="form-control form-control-sm" id="status">
                                        <option value="0" @if (old('status', $ticketCategory->status) == 0) selected @endif>غیرفعال</option>
                                        <option value="1" @if (old('status', $ticketCategory->status) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                                @enderror
                            </section>

                            <section class="col-12 my-3 ">
                                <button class="btn btn-primary btn-sm">ثبت نهایی</button>
                            </section>

                        </section>

                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
