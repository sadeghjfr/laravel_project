<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

            <!-- لینک خانه -->
            <a href="{{ route('admin.home') }}" class="sidebar-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <!-- بخش فروشگاه -->
            <section class="sidebar-group-link {{ request()->routeIs('admin.market.*') ? 'active' : '' }}">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-store-alt icon"></i>
                    <span>فروشگاه</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.category.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.category.*') ? 'active' : '' }}"><span>دسته بندی</span></a>
                    <a href="{{ route('admin.market.attribute.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.attribute.*') || request()->routeIs('admin.market.value.*') ? 'active' : '' }}"><span>ویژگی‌های دسته‌بندی‌ها</span></a>
                    <a href="{{ route('admin.market.product.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.product.*') || request()->routeIs('admin.market.color.*') || request()->routeIs('admin.market.gallery.*') ? 'active' : '' }}"><span>محصولات</span></a>
                    <a href="{{ route('admin.market.brand.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.brand.*') ? 'active' : '' }}"><span>برندها</span></a>
                    <a href="{{ route('admin.market.store.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.store.*') ? 'active' : '' }}"><span>انبار</span></a>
                    <a href="{{ route('admin.market.payment.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.payment.*') ? 'active' : '' }}"><span>پرداخت ها</span></a>
                    <a href="{{ route('admin.market.order.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.order.*') ? 'active' : '' }}"><span>سفارشات</span></a>
                    <a href="{{ route('admin.market.delivery.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.delivery.*') ? 'active' : '' }}"><span>روش های ارسال</span></a>
                    <a href="{{ route('admin.market.comment.index') }}" class="sidebar-link {{ request()->routeIs('admin.market.comment.*') ? 'active' : '' }}"><span>نظرات</span></a>
                    <a href="{{ route('admin.market.discount.coupon') }}" class="sidebar-link {{ request()->routeIs('admin.market.discount.coupon') || request()->routeIs('admin.market.discount.coupon.*') ? 'active' : '' }}"><span>کد تخفیف</span></a>
                    <a href="{{ route('admin.market.discount.commonDiscount') }}" class="sidebar-link {{ request()->routeIs('admin.market.discount.commonDiscount') || request()->routeIs('admin.market.discount.commonDiscount.*') ? 'active' : '' }}"><span>تخفیف عمومی</span></a>
                    <a href="{{ route('admin.market.discount.amazingSale') }}" class="sidebar-link {{ request()->routeIs('admin.market.discount.amazingSale') || request()->routeIs('admin.market.discount.amazingSale.*') ? 'active' : '' }}"><span>فروش شگفت انگیز</span></a>
                </section>
            </section>

            <!-- بخش بلاگ -->
            <section class="sidebar-group-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-pencil-alt icon"></i>
                    <span>بلاگ</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.content.category.index') }}" class="sidebar-link {{ request()->routeIs('admin.content.category.*') ? 'active' : '' }}"><span>دسته بندی</span></a>
                    <a href="{{ route('admin.content.post.index') }}" class="sidebar-link {{ request()->routeIs('admin.content.post.*') ? 'active' : '' }}"><span>پست ها</span></a>
                    <a href="{{ route('admin.content.comment.index') }}" class="sidebar-link {{ request()->routeIs('admin.content.comment.*') ? 'active' : '' }}"><span>نظرات</span></a>
                    <a href="{{ route('admin.content.menu.index') }}" class="sidebar-link {{ request()->routeIs('admin.content.menu.*') ? 'active' : '' }}"><span>منو ها</span></a>
                    <a href="{{ route('admin.content.faq.index') }}" class="sidebar-link {{ request()->routeIs('admin.content.faq.*') ? 'active' : '' }}"><span>سوالات متداول</span></a>
                    <a href="{{ route('admin.content.page.index') }}" class="sidebar-link {{ request()->routeIs('admin.content.page.*') ? 'active' : '' }}"><span>پیج ساز</span></a>
                </section>
            </section>

            <!-- بخش کاربران -->
            <section class="sidebar-group-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-users icon"></i>
                    <span>کاربران</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.user.index') }}" class="sidebar-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}"><span>کاربران</span></a>
                    <a href="{{ route('admin.user.role.index') }}" class="sidebar-link {{ request()->routeIs('admin.user.role.*') ? 'active' : '' }}"><span>سطوح دسترسی</span></a>
                </section>
            </section>

            <!-- بخش تیکت‌ها -->
            <section class="sidebar-group-link {{ request()->routeIs('admin.ticket.*') ? 'active' : '' }}">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-headset icon"></i>
                    <span>تیکت ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.ticket.category.index') }}" class="sidebar-link {{ request()->routeIs('admin.ticket.category.*') ? 'active' : '' }}"><span>دسته بندی تیکت ها</span></a>
                    <a href="{{ route('admin.ticket.priority.index') }}" class="sidebar-link {{ request()->routeIs('admin.ticket.priority.*') ? 'active' : '' }}"><span>اولویت تیکت ها</span></a>
                    <a href="{{ route('admin.ticket.admin.index') }}" class="sidebar-link {{ request()->routeIs('admin.ticket.admin.*') ? 'active' : '' }}"><span>ادمین تیکت ها</span></a>
                    <a href="{{ route('admin.ticket.index') }}" class="sidebar-link {{ request()->routeIs('admin.ticket.*') ? 'active' : '' }}"><span>تیکت ها</span></a>
                </section>
            </section>

            <!-- بخش اطلاع‌رسانی -->
            <section class="sidebar-group-link {{ request()->routeIs('admin.notify.*') ? 'active' : '' }}">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-envelope icon"></i>
                    <span>اطلاع رسانی</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.notify.email.index') }}" class="sidebar-link {{ request()->routeIs('admin.notify.email.*') || request()->routeIs('admin.notify.email-file.*') ? 'active' : '' }}"><span>اطلاعیه ایمیلی</span></a>
                    <a href="{{ route('admin.notify.sms.index') }}" class="sidebar-link {{ request()->routeIs('admin.notify.sms.*') ? 'active' : '' }}"><span>اطلاعیه پیامکی</span></a>
                </section>
            </section>

            <!-- بخش تنظیمات -->
            <section class="sidebar-group-link {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-cogs icon"></i>
                    <span>تنظیمات</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.setting.index') }}" class="sidebar-link {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}"><span>تنظیمات سایت</span></a>
                </section>
            </section>

        </section>
    </section>
</aside>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggles = document.querySelectorAll('.sidebar-dropdown-toggle');
        const sidebarLinks = document.querySelectorAll('.sidebar-dropdown a');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function (event) {
                event.preventDefault();
                const parent = this.closest('.sidebar-group-link');
                const angleIcon = this.querySelector('.angle');

                if (parent.classList.contains('active')) {
                    parent.classList.remove('active');
                    angleIcon.style.transform = 'rotate(90deg)';
                } else {

                    dropdownToggles.forEach(otherToggle => {
                        const otherParent = otherToggle.closest('.sidebar-group-link');
                        const otherAngleIcon = otherToggle.querySelector('.angle');
                        if (otherParent !== parent) {
                            otherParent.classList.remove('active');
                            otherAngleIcon.style.transform = 'rotate(0deg)';
                        }
                    });

                    parent.classList.add('active');
                    angleIcon.style.transform = 'rotate(0deg)';
                }
            });
        });

        sidebarLinks.forEach(link => {
            link.addEventListener('click', function (event) {

                event.stopPropagation();
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        const currentPage = window.location.origin + window.location.pathname;
        const sidebarLinks = document.querySelectorAll('.sidebar-dropdown a');

        sidebarLinks.forEach(link => {
            const linkHref = link.getAttribute('href');

            if (linkHref && currentPage.includes(linkHref)) {
                const parentGroup = link.closest('.sidebar-group-link');
                if (parentGroup) {

                    const dropdownToggle = parentGroup.querySelector('.sidebar-dropdown-toggle');
                    const angleIcon = dropdownToggle.querySelector('.angle');
                    const dropdown = parentGroup.querySelector('.sidebar-dropdown');

                    parentGroup.classList.add('active');
                    angleIcon.style.transform = 'rotate(-90deg)';
                    dropdown.style.height = 'auto';
                    dropdown.style.display = 'block';
                }
            }
        });
    });

</script>


