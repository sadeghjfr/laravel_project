@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد پیج</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوا</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.content.page.index')}}">پیج ساز</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد پیج</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد پیج
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
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

                        <section class="col-12">
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


                        <section class="col-12">
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

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
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

    <script>

        $(document).ready(function () {

            const tags_input = $('#tags');
            const select_tags = $('#select_tags');
            const default_tags = tags_input.val();
            let default_data = null;

            if(tags_input.val() !== null && tags_input.val().length > 0)
            {
                default_data = default_tags.split(',');
            }

            select_tags.select2({
                placeholder : 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });

            select_tags.children('option').attr('selected', true).trigger('change');


            $('#form').submit(function ( event ){

                if(select_tags.val() !== null && select_tags.val().length > 0){
                    const selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource)
                }

            })

        })

    </script>

@endsection
