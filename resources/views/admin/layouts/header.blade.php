<header class="header-main">

    <section class="sidebar-header bg-gray">

        <section class="d-flex justify-content-between flex-md-row-reverse px-2">
            <span id="sidebar-toggle-show" class="d-inline d-md-none pointer"><i class="fas fa-toggle-off"></i></span>
            <span id="sidebar-toggle-hide" class="d-none d-md-inline pointer"><i class="fas fa-toggle-on"></i></span>
            <span><img class="logo" src="{{asset('admin-assets/images/logo.png')}}" alt="logo"></span>
            <span id="menu-toggle" class="d-md-none"><i class="fas fa-ellipsis-h"></i></span>
        </section>

    </section>

    <section id="body-header" class="body-header">

        <section class="d-flex justify-content-between">

            <section>

                <span class="mr-5">

                    <span id="search-area" class="search-area d-none">

                        <i id="search-area-hide" class="fas fa-times pointer"></i>
                        <input id="search-input" type="text" class="search-input">
                        <i class="fas fa-search pointer"></i>

                    </span>

                    <i id="search-toggle" class="fas fa-search p-1 d-none d-md-inline pointer"></i>

                </span>

                <span id="full-screen" class="pointer p-1 d-none d-md-inline mr-5">

                    <i id="screen-compress" class="fas fa-compress d-none"></i>
                    <i id="screen-expand" class="fas fa-expand"></i>

                </span>

            </section>


            <section>

                <span class="ml-2 ml-md-4 position-relative">

                    <span id="header-notification-toggle" class="pointer">
                        @if($notifications->count() !== 0)
                            <i class="fa fa-bell"></i><sup class="badge badge-danger">{{$notifications->count()}}</sup>
                        @else
                            <i class="fa fa-bell"></i>
                        @endif
                    </span>

                    <section id="header-notification" class="header-notification rounded">

                        <ul class="list-group rounded px-0">

                            @if($notifications->count() !== 0)
                                <section class="d-flex justify-content-between mx-2 my-2">
                                    <span class="px-2 comment-user-header">نوتیفیکیشن ها</span>
                                    <span class="px-2 comment-user-header"><span class="badge badge-danger">جدید</span></span>
                                </section>
                            @else
                                <li class="list-group-item list-group-item-action">
                                        <h5 class="comment-user">نوتیفیکیشن جدیدی یافت نشد</h5>
                                </li>
                            @endif

                            @foreach($notifications as $notification)

                                    <a id="{{$notification->id}}"
                                       onclick="notificationSeen('{{$notification->id}}', '{{route($notification->data['url'])}}')"
                                       href="{{route($notification->data['url'])}}" class="text-decoration-none">
                                    <li class="list-group-item list-group-item-action header-comment-item pointer">
                                        <section class="media">
                                            <section class="media-body pr-2">
                                                <span class="row comment-body">
                                                    <i class="fas fa-circle text-success comment-user-status ml-2 mt-1"></i>
                                                    <p class="notification-text mb-1">{{$notification->data['message']}}</p>
                                                </span>
                                            </section>
                                        </section>
                                </li>
                                </a>
                            @endforeach

                        </ul>

                    </section>

                </span>

                <span class="ml-2 ml-md-4 position-relative">

                    <span id="header-comment-toggle" class="pointer">

                        @if($unseenComments->count() !== 0)
                            <i class="fa fa-comment-alt"></i><sup
                                class="badge badge-danger">{{$unseenComments->count()}}</sup>
                        @else
                            <i class="fa fa-comment-alt"></i>
                        @endif
                    </span>

                    <section id="header-comment" class="header-comment">

                        <section class="header-comment-wrapper">
                            <ul class="list-group rounded px-0">

                                @if($unseenComments->count() !== 0)

                                    <section class="d-flex justify-content-between my-2 mx-2">
                                        <span class="px-2 comment-user-header">نظرات</span>
                                        <span class="px-2 comment-user-header"><span
                                                class="badge badge-danger">جدید</span></span>
                                    </section>

                                @else
                                    <li class="list-group-item list-group-item-action">
                                        <h5 class="comment-user">نظر جدیدی درج نشده است</h5>
                                    </li>
                                @endif

                                @foreach($unseenComments as $comment)
                                    <a href="@if($comment->commentable_type === 'App\Models\Admin\Market\Product') {{route('admin.market.comment.index')}} @else {{route('admin.content.comment.index')}}  @endif"
                                       class="text-decoration-none">
                                        <li class="list-group-item list-group-item-action header-comment-item pointer">
                                        <h5 class="comment-user">{{$comment->user->fullName ?? 'کاربر'}}</h5>
                                        <span class="comment-body">
                                            <i class="fas fa-circle text-success comment-user-status ml-2"></i>
                                            {{\Illuminate\Support\Str::limit($comment->body, 30)}}
                                        </span>
                                    </li>
                                    </a>
                                @endforeach

                            </ul>
                        </section>

                    </section>

                </span>

                <span class="ml-3 ml-md-5 position-relative">

                    <span id="header-profile-toggle" class="pointer">
                        <img class="header-avatar" src="{{asset('admin-assets/images/avatar-2.jpg')}}" alt="avatar">
                        <span class="header-username">محمد صادق جعفری</span>
                        <i class="fas fa-angle-down"></i>
                    </span>

                    <section id="header-profile" class="header-profile rounded">

                        <section class="list-group rounded">

                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-cog"></i>تنظیمات
                            </a>

                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-user"></i>کاربر
                            </a>

                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-envelope"></i>پیام ها
                            </a>

                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-lock"></i>قفل صفحه
                            </a>

                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-sign-out-alt"></i>خروج
                            </a>

                        </section>

                    </section>

                </span>

            </section>

        </section>

    </section>

</header>

<script>

    function notificationSeen(id) {

        $.ajax({
            type: "POST",
            url: '/admin/notification/read/' + id,
            data: {
                _token: "{{ csrf_token() }}",
                notification_id: id
            },
            success: function(response) {
                window.location.href = url;
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                window.location.href = url;
            }
        });
    }


</script>
