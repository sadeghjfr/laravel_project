@extends('admin.layouts.master')

@section('head-tag')
    <title>منو</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.home')}}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بلاگ</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{route('admin.content.menu.index')}}"> منو</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد منو</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <section class="main-body-container-header">
                        <h5>
                            ایجاد منو
                        </h5>
                    </section>
                    <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.menu.store') }}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">عنوان منو</label>
                                    <input type="text" name="name" class="form-control form-control-sm"
                                           value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">منو والد</label>
                                    <select name="parent_id"  class="form-control form-control-sm">
                                        <option value="">منوی اصلی</option>
                                        @foreach ($menus as $menu)

                                            <option value="{{ $menu->id }}"
                                                    @if(old('parent_id') == $menu->id) selected @endif>{{ $menu->name }}</option>

                                        @endforeach

                                    </select>
                                </div>
                                @error('parent_id')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
                                </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mb-2">
                                <div class="form-group mb-1">
                                    <label for="">آدرس URL</label>
                                    <input type="text" name="url" value="{{ old('url') }}"
                                           class="form-control form-control-sm">
                                </div>
                                @error('url')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{$message}}
                                    </strong>
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
