<?php require 'layout/header.view.php' ?>

<body>
<div id="app">

    <?php render_sidebar() ?>

    <div id="main" class='layout-navbar'>
        <?php require 'components/header_content.view.php' ?>
        <div id="main-content">

            <div class="page-heading">
                <h3>System Statistics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldBuy"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Orders</h6>
                                                <h6 class="font-extrabold mb-0"><?= $statistics['order_count'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Customers</h6>
                                                <h6 class="font-extrabold mb-0"><?= $statistics['customer_count'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldStar"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Vehicles</h6>
                                                <h6 class="font-extrabold mb-0"><?= $statistics['vehicle_count'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldUser1"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Drivers</h6>
                                                <h6 class="font-extrabold mb-0"><?= $statistics['driver_count'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Recent Orders</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped" id="table1">
                                            <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Vehicle Type</th>
                                                <th>Date of Pickup</th>
                                                <th>Pickup Location</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(sizeof($orders) < 1): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No orders found!</td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php foreach ($orders as $order): ?>
                                                <tr>
                                                    <td><?= $order['order_id'] ?></td>
                                                    <td><?= $order['vt_name'] ?></td>
                                                    <td><?= $order['pickup_date'] ?></td>
                                                    <td><?= $order['pickup_location_name'] ?></td>
                                                    <td><span class="badge <?php if(in_array($order['order_status_id'], [1, 7, 9])): ?> bg-danger <?php else: ?> bg-success <?php endif; ?>"><?= $order['os_name'] ?></span></td>
                                                    <td class="py-1">
                                                        <a href="<?= url('orders/edit', ['id' => $order['order_id']]) ?>" class="btn btn-success btn-sm">View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php require 'components/footer_content.view.php' ?>
        </div>
    </div>
</div>
<script src="<?= url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= url('assets/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?= url('assets/js/main.js') ?>"></script>
</body>

<?php require 'layout/footer.view.php' ?>
