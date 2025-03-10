@extends('customer.layouts.master-simple')

@section('content')
    <section class="vh-100 d-flex justify-content-center align-items-center pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <form action="{{ route('auth.customer.login-confirm', $token) }}" method="post" class="card shadow">
                        @csrf
                        <div class="card-body p-4">

                            <div class="text-end mb-3">
                                <a href="{{ route('auth.customer.login-register-form') }}" class="btn btn-link text-decoration-none p-0">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            </div>

                            <div class="text-center mb-4">
                                <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="Logo" class="img-fluid" style="max-width: 150px;">
                            </div>

                            <p class="text-muted text-center mb-4">کد تایید برای شما ارسال گردید</p>
                            <h5 class="card-title text-center mb-3">کد تایید را وارد نمایید</h5>

                            <div class="mb-3">
                                <input type="text" name="otp" value="{{ old('otp') }}" class="form-control text-center mb-1">
                                @error('otp')
                                <span class="text-danger small" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger">ورود به آمازون</button>
                            </div>

                            <div class="text-center mt-3">
                                <section id="resend-otp" class="d-none text-center font-size-10">
                                    <a href="{{route('auth.customer.login-resend-otp', $token)}}" class="text-decoration-none text-primary text-center">دریافت مجدد کد تایید</a>
                                </section>
                                <section id="timer" class="text-muted small text-center"></section>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @php
        $timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(5)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;
    @endphp

    <script>
        const countDownDate = new Date().getTime() + {{ $timer }};
        const timer = $('#timer');
        const resendOtp = $('#resend-otp');

        const interval = setInterval(() => {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (distance < 0) {
                clearInterval(interval);
                timer.addClass('d-none');
                resendOtp.removeClass('d-none');
            } else {
                if (minutes === 0) {
                    timer.text(`ارسال مجدد کد تایید تا ${seconds} ثانیه دیگر`);
                } else {
                    timer.text(`ارسال مجدد کد تایید تا ${minutes} دقیقه و ${seconds} ثانیه دیگر`);
                }
            }
        }, 1000);
    </script>
@endsection
