@extends('customer.layouts.master-one-col')
@section('head-tag')
    <title>{{$product->name}}</title>
@endsection

@section('content')

    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>{{$product->name}}</span>
                            </h2>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4 d-flex">
                            <section class="content-wrapper w-100 bg-white p-3 rounded-2 mb-4">
                                <section class="product-gallery text-center">
                                    <section class="product-gallery-selected-image mb-3 text-center">
                                        <img src="{{asset($product->image['indexArray']['medium'])}}"
                                             alt="{{$product->name}}" class="img-fluid">
                                    </section>
                                    <section class="product-gallery-thumbs text-center">

                                        <img class="product-gallery-thumb"
                                             src="{{asset($product->image['indexArray']['medium'])}}"
                                             alt="{{$product->name}}"
                                             data-input="{{asset($product->image['indexArray']['medium'])}}">

                                        @foreach($product->images as $gallery)

                                            <img class="product-gallery-thumb"
                                                 src="{{asset($gallery->image['indexArray']['medium'])}}"
                                                 alt="{{$product->name}}"
                                                 data-input="{{asset($gallery->image['indexArray']['medium'])}}">
                                        @endforeach

                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- end image gallery -->

                        <!-- start product info -->
                        <section class="col-md-5 d-flex">

                            <section class="content-wrapper w-100 bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{$product->name}}
                                        </h2>
                                    </section>
                                </section>
                                <section class="product-info">

                                    @php
                                        $colors = $product->colors()->get();
                                    @endphp


                                    {{--@if($colors->count()>0)
                                        <p><span>رنگ انتخاب شده : <span id="selected_color_name">{{$colors->first()->color_name}}</span></span></p>

                                        <p>
                                            @foreach($colors as $color)
                                                <span style="background-color: {{$color->color_code}};" class="product-info-colors me-1"
                                                      data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$color->color_name}}">
                                                </span>
                                            @endforeach
                                        </p>
                                    @endif--}}

                                    @if($colors->count() != 0)
                                        <p><span>رنگ انتخاب شده : <span id="selected_color_name"> {{ $colors->first()->color_name }}</span></span></p>
                                        <p>
                                            @foreach ($colors as $key => $color)

                                                <label for="{{ 'color_' . $color->id }}" style="background-color: {{ $color->color_code ?? '#ffffff' }};"
                                                       class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       title="{{ $color->color_name }}">

                                                </label>

                                                <input class="d-none" type="radio" name="color" id="{{ 'color_' . $color->id }}"
                                                       value="{{ $color->id }}" data-color-name="{{ $color->color_name }}"
                                                       data-color-price={{ $color->price_increase }}
                                                       @if($key == 0) checked @endif
                                                >
                                            @endforeach

                                        </p>
                                    @endif

                                    @php
                                        $guarantees = $product->guarantees()->get();
                                    @endphp

                                    @if($guarantees->count() != 0)

                                        <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                            گارانتی :
                                            <select name="guarantee" id="guarantee" class="p-1">
                                                @foreach ($guarantees as $key => $guarantee)
                                                    <option value="{{ $guarantee->id }}"
                                                            data-guarantee-price={{ $guarantee->price_increase }}
                                                            @if($key == 0) selected @endif>{{ $guarantee->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </p>

                                    @endif


                                    <p>
                                        @if($product->marketable_number>0)
                                            <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                            <span>کالا موجود در انبار</span>
                                        @else
                                            <i class="fa fa-info cart-product-selected-store me-1 text-danger"></i>
                                            <span class="text-danger">کالا ناموجود</span>
                                        @endif
                                    </p>

                                    <p>
                                    @guest
                                        <section class="product-add-to-favorite position-relative" style="top: 0">
                                            <button class="btn btn-light btn-sm text-decoration-none"
                                                    data-url="{{ route('customer.market.product.add-to-favorite', $product) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="left">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        </section>
                                    @endguest
                                    @auth
                                        @if ($product->user->contains(auth()->user()->id))
                                            <section class="product-add-to-favorite position-relative" style="top: 0">
                                                <button class="btn btn-light btn-sm text-decoration-none"
                                                        data-url="{{ route('customer.market.product.add-to-favorite', $product) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left">
                                                    <i class="fa fa-heart text-danger"></i>
                                                </button>
                                            </section>
                                        @else
                                            <section class="product-add-to-favorite position-relative" style="top: 0">
                                                <button class="btn btn-light btn-sm text-decoration-none"
                                                        data-url="{{ route('customer.market.product.add-to-favorite', $product) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </section>
                                            @endif
                                            @endauth
                                    </p>

                                    <section>
                                        <section class="cart-product-number d-inline-block ">
                                            <button class="cart-number cart-number-down" type="button">-</button>
                                            <input type="number" id="number" name="number" min="1" max="5" step="1" value="1" readonly="readonly">
                                            <button class="cart-number cart-number-up" type="button">+</button>
                                        </section>
                                    </section>

                                    <p class="mb-3 mt-5 justify-text">
                                        <i class="fa fa-info-circle me-1"></i>
                                        درخواست مرجوع کردن کالا با دلیل "انصراف از خرید" تنها در صورتی قابل تایید است که
                                        کالا در شرایط اولیه باشد (در صورت پلمپ بودن، کالا نباید باز شده باشد).
                                    </p>
                                </section>
                            </section>

                        </section>
                        <!-- end product info -->

                        <section class="col-md-3">

                            @if($product->marketable_number>0)
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالا</p>
                                        <p class="text-muted">
                                            <span id="product_price" data-product-original-price={{ $product->price }}>
                                                {{ priceFormat($product->price) }}
                                            </span>
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>

                                    @php
                                        $amazingSale = $product->activeAmazingSale();
                                    @endphp

                                    @if(!empty($amazingSale))
                                        <section class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted">تخفیف کالا</p>
                                            <p class="text-danger fw-bolder" id="product-discount-price"
                                               data-product-discount-price="{{ ($product->price * ($amazingSale->percentage / 100) ) }}">
                                                {{ priceFormat($product->price * ($amazingSale->percentage / 100) ) }}
                                                <span class="small">تومان</span>
                                            </p>
                                        </section>
                                    @endif

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت نهایی</p>
                                        <p class="fw-bolder">
                                            <span  id="final-price"></span>
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>

                                    <section class="cart-button">
                                        <a id="next-level" href="#" class="btn btn-danger d-block">افزودن به سبد خرید</a>
                                    </section>


                                </section>
                            @else
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">در حال حاضر این کالا در فروشگاه موجود نیست.</p>
                                    </section>
                                    <section class="border-bottom mb-3"></section>
                                    <section class="cart-button">
                                        <a id="next-level" href="#"
                                           class="btn btn-secondary disabled d-block">ناموجود</a>
                                    </section>
                                </section>
                            @endif


                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>محصولات مرتبط</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach($relatedProducts as $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">

                                                {{--<section class="product-add-to-cart">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید">
                                                        <i class="fa fa-cart-plus"></i>
                                                    </a>
                                                </section>

                                                --}}

                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button class="btn btn-light btn-sm text-decoration-none"
                                                                data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="left">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    </section>
                                                @endguest
                                                @auth
                                                    @if ($relatedProduct->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm text-decoration-none"
                                                                    data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="left">
                                                                <i class="fa fa-heart text-danger"></i>
                                                            </button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button class="btn btn-light btn-sm text-decoration-none"
                                                                    data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="left">
                                                                <i class="fa fa-heart"></i>
                                                            </button>
                                                        </section>
                                                    @endif
                                                @endauth

                                                <a class="product-link"
                                                   href="{{route('customer.market.product.index', $relatedProduct)}}">

                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{asset($relatedProduct->image['indexArray']['medium'])}}"
                                                             alt="{{$relatedProduct->name}}">
                                                    </section>

                                                    <section class="product-colors">

                                                    </section>

                                                    <section class="product-name">
                                                        <h3>{{$relatedProduct->name}}</h3>
                                                    </section>

                                                    @if($relatedProduct->marketable_number>0)
                                                        <section class="product-price-wrapper">

                                                            @if(!empty($relatedProduct->activeAmazingSale()))
                                                                <section class="d-flex product-discount">

                                                                    <span
                                                                        class="product-discount-amount">{{priceFormat($relatedProduct->activeAmazingSale()->percentage).'٪'}}</span>
                                                                    <span
                                                                        class="product-price w-100">{{priceFormat($relatedProduct->price - (($relatedProduct->price * $relatedProduct->activeAmazingSale()->percentage)/100)). ' تومان'}}</span>
                                                                </section>
                                                                <section
                                                                    class="product-old-price">{{priceFormat($relatedProduct->price)}}
                                                                </section>
                                                            @else
                                                                <span
                                                                    class="product-price w-100 d-block text-left">{{priceFormat($relatedProduct->price). ' تومان'}}</span>

                                                            @endif

                                                        </section>
                                                    @else
                                                        <section class="text-center">
                                                            <span class="text-secondary">ناموجود</span>
                                                        </section>
                                                    @endif

                                                    <section class="product-colors">
                                                        @foreach($relatedProduct->colors as $color)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{$color->color_code}};">
                                                            </section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach

                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                              href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                    </h2>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                </section>
                            </section>
                            <section class="product-introduction mb-4 justify-text">
                                {!! $product->introduction !!}
                            </section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">


                                    @foreach($product->values as $value)
                                        <tr>
                                            <td>{{$value->attribute->name}}</td>
                                            <td>{{json_decode($value->value)->value}} {{$value->attribute->unit}}</td>
                                        </tr>
                                    @endforeach

                                    @foreach($product->metas as $meta)
                                        <tr>
                                            <td>{{$meta->meta_key}}</td>
                                            <td>{{$meta->meta_value}}</td>
                                        </tr>
                                    @endforeach

                                </table>
                            </section>

                            <!-- start vontent header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه ها
                                    </h2>
                                </section>
                            </section>
                            <section class="product-comments mb-4">

                                <section class="comment-add-wrapper">
                                    <button class="comment-add-button" type="button" data-bs-toggle="modal"
                                            data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن دیدگاه
                                    </button>
                                    <!-- start add comment Modal -->
                                    <section class="modal fade" id="add-comment" tabindex="-1"
                                             aria-labelledby="add-comment-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-comment-label"><i
                                                            class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </section>
                                                @guest
                                                    <section class="modal-body">
                                                        <p>کاربر گرامی لطفا برای ثبت دیدگاه ابتدا وارد حساب کاربری خود
                                                            شوید </p>
                                                        <p>
                                                            <a class="text-decoration-none"
                                                               href="{{ route('auth.customer.login-register-form') }}">ورود
                                                                | ثبت نام</a>
                                                        </p>
                                                    </section>
                                                @endguest
                                                @auth
                                                    <section class="modal-body pb-0">
                                                        <form class="row"
                                                              action="{{route('customer.market.product.add-comment', $product)}}"
                                                              method="post">
                                                            @csrf
                                                            <section class="col-12 mb-4">
                                                                <label for="comment" class="form-label mb-1">دیدگاه
                                                                    شما</label>
                                                                <textarea required name="body"
                                                                          class="form-control form-control-sm"
                                                                          id="comment"
                                                                          placeholder="دیدگاه شما ..."
                                                                          rows="4"></textarea>
                                                            </section>
                                                            <section class="modal-footer mb-0">
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    ثبت دیدگاه
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                        data-bs-dismiss="modal">
                                                                    بستن
                                                                </button>
                                                            </section>

                                                        </form>
                                                    </section>
                                                @endauth

                                            </section>
                                        </section>
                                    </section>
                                </section>


                                @foreach($product->activeComments() as $comment)

                                    <section class="product-comment">
                                        <section class="product-comment-header d-flex justify-content-start">
                                            <section class="product-comment-title">
                                                {{$comment->user->fullName === ' ' ? 'کاربر' : $comment->user->fullName}}
                                            </section>
                                            <section class="product-comment-date">ارسال شده
                                                در {{jalaliDate($comment->created_at, 'Y/m/d')}}</section>
                                            {{--<section class="product-comment-answer-btn">
                                                <a class="text-decoration-none text-black-50">پاسخ</a>
                                            </section>--}}
                                        </section>
                                        <section class="product-comment-body justify-text">
                                            {{$comment->body}}
                                        </section>

                                        @foreach($comment->children()->get() as $answer)
                                            <section
                                                class="product-comment product-comment-answer ms-5 border-bottom-0">
                                                <section class="product-comment-header d-flex justify-content-start">
                                                    <section class="product-comment-title">ادمین</section>
                                                    <section class="product-comment-date">ارسال شده
                                                        در {{jalaliDate($comment->created_at, 'Y/m/d')}}</section>
                                                </section>
                                                <section class="product-comment-body justify-text">
                                                    {{$answer->body}}
                                                </section>
                                            </section>
                                        @endforeach

                                    </section>

                                @endforeach


                            </section>
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end description, features and comments -->

    <section class="position-fixed p-4 flex-row-reverse" style="z-index: 909999999; left: 0; top: 3rem; width: 26rem; max-width: 80%;">
        <div class="toast"  data-delay="7000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">دیجی کالا</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <strong class="ml-auto">
                    برای افزودن کالا به لیست علاقه مندی ها باید ابتدا وارد حساب کاربری خود شوید
                    <br>
                    <a href="{{ route('auth.customer.login-register-form') }}" class="text-dark">
                        ثبت نام / ورود
                    </a>
                </strong>
            </div>
        </div>
    </section>

@endsection

@section('script')

    <script>
        $(document).ready(function(){
            bill();
            //input color
            $('input[name="color"]').change(function(){
                bill();
            })
            //guarantee
            $('select[name="guarantee"]').change(function(){
                bill();
            })
            //number
            $('.cart-number').click(function(){
                bill();
            })
        })

        function bill() {

            if($('input[name="color"]:checked').length != 0){
                var selected_color = $('input[name="color"]:checked');
                $("#selected_color_name").html(selected_color.attr('data-color-name'));
            }

            //price computing
            var selected_color_price = 0;
            var selected_guarantee_price = 0;
            var number = 1;
            var product_discount_price = 0;
            var product_original_price = parseFloat($('#product_price').attr('data-product-original-price'));

            if($('input[name="color"]:checked').length != 0)
            {
                selected_color_price = parseFloat(selected_color.attr('data-color-price'));
            }

            if($('#guarantee option:selected').length != 0)
            {
                selected_guarantee_price = parseFloat($('#guarantee option:selected').attr('data-guarantee-price'));
            }

            if($('#number').val() > 0)
            {
                number = parseFloat($('#number').val());
            }

            if($('#product-discount-price').length != 0)
            {
                product_discount_price = parseFloat($('#product-discount-price').attr('data-product-discount-price'));
            }

            //final price
            var product_price = product_original_price + selected_color_price + selected_guarantee_price;
            var final_price = number * (product_price - product_discount_price);
            $('#product-price').html(toFarsiNumber(product_price));
            $('#final-price').html(toFarsiNumber(final_price));
        }

        function toFarsiNumber(number)
        {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            number = new Intl.NumberFormat().format(number);
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }

    </script>

    <script>
        $('.product-add-to-favorite button').click(function() {
            var url = $(this).attr('data-url');
            var element = $(this);
            $.ajax({
                url : url,
                success : function(result){
                    if(result.status == 1)
                    {
                        $(element).children().first().addClass('text-danger');
                    }
                    else if(result.status == 2)
                    {
                        $(element).children().first().removeClass('text-danger')
                    }
                    else if(result.status == 3)
                    {
                        $('.toast').toast('show');
                    }
                }
            })
        })
    </script>

@endsection
