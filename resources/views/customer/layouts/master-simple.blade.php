<!DOCTYPE html>
<html lang="en">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>
<body>


<main id="main-body-one-col" class="main-body">

    @yield('content')

</main>


    @include('customer.layouts.script')
    @yield('script')

<section class="toast-wrapper flex-row-reverse">

    @include('admin.alerts.toast.success')
    @include('admin.alerts.toast.error')

</section>

</body>
</html>
