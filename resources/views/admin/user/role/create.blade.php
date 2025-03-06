@extends('admin.layouts.master')

@section('head-tag')
    <title>ایجاد نقش</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.role.index') }}"> نقش ها</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">

                <section class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                    <h5>
                        ایجاد نقش
                    </h5>
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.user.role.store') }}" method="post">
                        @csrf
                        <section class="row">

                            <section class="col-12 col-md-5 mb-2">
                                <div class="form-group mb-1">
                                    <label for="name">عنوان نقش</label>
                                    <input name="name" type="text" class="form-control form-control-sm" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-5 mb-2">
                                <div class="form-group mb-1">
                                    <label for="description">توضیح نقش</label>
                                    <input name="description" type="text" class="form-control form-control-sm"
                                           value="{{ old('description') }}">
                                </div>
                                @error('description')
                                <span class="text-danger" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-2 text-start mb-2">
                                <button type="submit" class="btn btn-primary mt-md-4 w-100">ثبت نهایی</button>
                            </section>


                            <section class="col-12 border-top mt-3 py-3">
                                <h5>
                                    دسترسی های این نقش
                                </h5>
                                <section class="row mt-3">

                                    @foreach ($permissions as $key => $permission)


                                        <section class="col-md-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->id }}">
                                                <label for="{{ $permission->id }}" class="form-check-label mr-3 mt-1">{{ $permission->name }}</label>
                                            </div>
                                            <div class="mt-2">
                                                @error('permissions.' . $key)
                                                <span class="text-danger" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </section>

                                    @endforeach

                                </section>
                            </section>

                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>

@endsection
