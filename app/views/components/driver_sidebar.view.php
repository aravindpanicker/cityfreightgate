<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="<?= home_page() ?>"><img src="<?= url('assets/images/logo/logo.png') ?>" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item has-sub <?php if(request()->is('driver/orders*')): ?> active <?php endif; ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cart-fill"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="submenu active">
                        <li class="submenu-item <?php if(request()->is('driver/orders')): ?> active <?php endif; ?>">
                            <a href="<?= url('driver/orders') ?>">Active Orders</a>
                        </li>
                        <li class="submenu-item <?php if(request()->is('driver/orders/completed')): ?> active <?php endif; ?>">
                            <a href="<?= url('driver/orders/completed') ?>">Completed Orders</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?php if(request()->is('driver/vehicle')): ?> active <?php endif; ?>">
                    <a href="<?= url('driver/vehicle') ?>" class='sidebar-link'>
                        <i class="bi bi-truck"></i>
                        <span>Vehicle Information</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>