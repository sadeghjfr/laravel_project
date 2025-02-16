@extends('admin.layouts.master')

@section('head-tag')
<title>دسترسی های نقش</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
        <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.user.role.index') }}"> نقش ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسترسی های نقش</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mt-2  pb-2">
                <section class="col-12 col-md-5">
                    <div class="form-group">

                        <section><h6>نام نقش : {{ $role->name }}</h6></section>
                    </div>
                </section>

                <section class="col-12 col-md-5">
                    <div class="form-group">
                        <section><h6>توضیح نقش : {{ $role->description ?? '-' }}</h6></section>
                    </div>
                </section>
                <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.role.permission-update', $role->id) }}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12">
                            <section class="row border-top mt-3 py-3">

                                <section class="col-12 mb-2">
                                    <div class="form-group">
                                        <h5>
                                            دسترسی های نقش
                                        </h5>
                                    </div>
                                </section>


                                @php
                                    $rolePermissionsArray = $role->permissions->pluck('id')->toArray();
                                @endphp

                                @foreach ($permissions as $key => $permission)

                                <section class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->id }}" @if(in_array($permission->id, $rolePermissionsArray)) checked @endif/>
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


                                <section class="col-12">
                                    <button class="btn btn-primary mt-md-4">ثبت نهایی</button>
                                </section>

                            </section>
                        </section>

                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
