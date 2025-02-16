@extends('admin.layouts.master')

@section('head-tag')
<title>ویرایش نقش</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.home') }}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"><a href="#"> بخش کاربران</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{ route('admin.user.role.index') }}"> نقش ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش نقش</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <h5>
                    ویرایش نقش
                </h5>
                <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.role.update', $role->id) }}" method="post">
                    @method('put')
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-5">
                            <div class="form-group">
                                <label for="name">عنوان نقش</label>
                                <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control form-control-sm">
                            </div>
                            @error('name')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>
                        <section class="col-12 col-md-5">
                            <div class="form-group">
                                <label for="description">توضیح نقش</label>
                                <input type="text" name="description" value="{{ old('description', $role->description) }}" class="form-control form-control-sm">
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

                        <section class="col-12">
                            <section class="row border-top mt-3 py-3">

                            </section>
                        </section>

                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
