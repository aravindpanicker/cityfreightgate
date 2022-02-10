<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="<?= home_page() ?>"><img src="<?= url('assets/images/logo/logo.png') ?>" alt="Logo"
                                                      srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item has-sub <?php if (request()->is('customer/orders*')): ?> active <?php endif; ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cart-fill"></i>
                        <span>My Orders</span>
                    </a>
                    <ul class="submenu active">
                        <li class="submenu-item <?php if (request()->is('customer/orders')): ?> active <?php endif; ?>">
                            <a href="<?= url('customer/orders') ?>">Active Orders</a>
                        </li>
                        <li class="submenu-item <?php if (request()->is('customer/orders/completed')): ?> active <?php endif; ?>">
                            <a href="<?= url('customer/orders/completed') ?>">Completed Orders</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?php if (request()->is('faqs')): ?> active <?php endif; ?>">
                    <a href="<?= url('faqs') ?>" class='sidebar-link'>
                        <i class="bi bi-life-preserver"></i>
                        <span>FAQ</span>
                    </a>
                </li>

                <li class="sidebar-item <?php if (request()->is('customer/feedback')): ?> active <?php endif; ?>">
                    <a href="<?= url('customer/feedback') ?>" class='sidebar-link'>
                        <i class="bi bi-chat-left-dots-fill"></i>
                        <span>Submit Feedback</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>