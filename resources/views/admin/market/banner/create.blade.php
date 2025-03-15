@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد بنر</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="#"> فروشگاه</a></li>
        <li class="breadcrumb-item font-size-12"> <a href="{{route('admin.market.banner.index')}}"> بنر ها</a></li>
        <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد بنر</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <section class="main-body-container-header">
                    <h5>
                        ایجاد بنر
                    </h5>
                </section>
                <a href="{{ route('admin.market.banner.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.market.banner.store') }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="">عنوان بنر</label>
                                <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title') }}">
                            </div>
                            @error('title')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
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
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>



                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                <label for="">آدرس URL</label>
                                <input type="text" name="url" value="{{ old('url') }}" class="form-control form-control-sm">
                            </div>
                            @error('url')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>



                        <section class="col-12 col-md-6 mb-2">
                            <div class="form-group mb-1">
                                @php
                                    $positions = [
                                        '1' => 'اسلایدشو (صفحه اصلی)',
                                        '2' => 'کنار اسلایدشو (صفحه اصلی)',
                                        '3' => 'دو بنر تبلیغی بین دو اسلایدر (صفحه اصلی)',
                                        '4' => 'بنر تبلیغی بزرگ پایین دو اسلایدر (صفحه اصلی)',
                                    ];
                                @endphp
                                <label for="position">جایگاه</label>
                                <select name="position" id="position" class="form-control form-control-sm">
                                    <option value="">جایگاه بنر را انتخاب کنید</option>
                                    @foreach ($positions as $key => $value)
                                        <option value="{{ $key }}" @if(old('position') == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span id="positionText" class="d-block my-1" role="alert">
                                <strong></strong>
                            </span>
                            @error('position')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                        </section>

                        <section class="col-12 mb-2">
                            <div class="form-group mb-1">
                                <label for="">تصویر </label>
                                <input type="file" name="image" class="form-control form-control-sm">
                            </div>
                            @error('image')
                            <span class="text-danger" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary w-100 mt-3">ثبت نهایی</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const positionSelect = document.getElementById('position');
            const imageSizeText = document.getElementById('positionText');

            const positionTexts = {
                '1': 'اندازه تصویر : عرض ۱۷۸۰ و ارتفاع ۸۹۰ پیکسل باشد.',
                '2': 'اندازه تصویر : عرض ۸۵۶ و ارتفاع ۴۲۸ پیکسل باشد.',
                '3': 'اندازه تصویر : عرض ۸۲۰ و ارتفاع ۳۰۰ پیکسل باشد.',
                '4': 'اندازه تصویر : عرض ۱۶۵۶ و ارتفاع ۲۱۰ پیکسل باشد.',
            };

            positionSelect.addEventListener('change', function() {
                const selectedPosition = this.value;
                if (positionTexts[selectedPosition]) {
                    imageSizeText.querySelector('strong').textContent = positionTexts[selectedPosition];
                } else {
                    imageSizeText.querySelector('strong').textContent = '';
                }
            });
        });
    </script>

@endsection
