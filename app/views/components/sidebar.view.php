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

                <li class="sidebar-item <?php if(request()->is('dashboard')): ?> active <?php endif; ?>">
                    <a href="<?= url('dashboard') ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub <?php if(request()->is('customers') || request()->is('drivers')): ?> active <?php endif; ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>User</span>
                    </a>
                    <ul class="submenu <?php if(request()->is('customers') || request()->is('drivers')): ?> active <?php endif; ?>">
                        <li class="submenu-item <?php if(request()->is('customers')): ?> active <?php endif; ?>">
                            <a href="<?= url('customers') ?>">Customers</a>
                        </li>
                        <li class="submenu-item <?php if(request()->is('drivers')): ?> active <?php endif; ?>">
                            <a href="<?= url('drivers') ?>">Drivers</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub <?php if(request()->is('vehicles') || request()->is('vehicle-types*')): ?> active <?php endif; ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-truck"></i>
                        <span>Vehicle</span>
                    </a>
                    <ul class="submenu <?php if(request()->is('vehicles') || request()->is('vehicle-types*')): ?> active <?php endif; ?>">
                        <li class="submenu-item <?php if(request()->is('vehicles')): ?> active <?php endif; ?>">
                            <a href="<?= url('vehicles') ?>">Vehicles</a>
                        </li>
                        <li class="submenu-item <?php if(request()->is('vehicle-types*')): ?> active <?php endif; ?>">
                            <a href="<?= url('vehicle-types') ?>">Vehicle Types</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub <?php if(request()->is('orders*')): ?> active <?php endif; ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cart-fill"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="submenu <?php if(request()->is('orders*')): ?> active <?php endif; ?>">
                        <li class="submenu-item <?php if(request()->is('orders')): ?> active <?php endif; ?>">
                            <a href="<?= url('orders') ?>">Active Orders</a>
                        </li>
                        <li class="submenu-item <?php if(request()->is('orders/completed')): ?> active <?php endif; ?>">
                            <a href="<?= url('orders/completed') ?>">Completed Orders</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?php if(request()->is('payments*')): ?> active <?php endif; ?>">
                    <a href="<?= url('payments') ?>" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span>Payments</span>
                    </a>
                </li>

                <li class="sidebar-item <?php if(request()->is('feedbacks')): ?> active <?php endif; ?>">
                    <a href="<?= url('feedbacks') ?>" class='sidebar-link'>
                        <i class="bi bi-chat-left-dots-fill"></i>
                        <span>Feedbacks</span>
                    </a>
                </li>

                <li class="sidebar-title">Settings</li>

                <li class="sidebar-item has-sub <?php if(request()->is('states*') || request()->is('cities*') || request()->is('locations*')): ?> active <?php endif; ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Location</span>
                    </a>
                    <ul class="submenu <?php if(request()->is('states*') || request()->is('cities*') || request()->is('locations*')): ?> active <?php endif; ?>">
                        <li class="submenu-item <?php if(request()->is('states*')): ?> active <?php endif; ?>">
                            <a href="<?= url('states') ?>">States</a>
                        </li>
                        <li class="submenu-item <?php if(request()->is('cities*')): ?> active <?php endif; ?>">
                            <a href="<?= url('cities') ?>">Cities</a>
                        </li>
                        <li class="submenu-item <?php if(request()->is('locations*')): ?> active <?php endif; ?>">
                            <a href="<?= url('locations') ?>">Locations</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item <?php if(request()->is('faq*')): ?> active <?php endif; ?>">
                    <a href="<?= url('faq') ?>" class='sidebar-link'>
                        <i class="bi bi-life-preserver"></i>
                        <span>FAQ</span>
                    </a>
                </li>

                <li class="sidebar-item <?php if(request()->is('settings')): ?> active <?php endif; ?>">
                    <a href="<?= url('settings') ?>" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Settings</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>