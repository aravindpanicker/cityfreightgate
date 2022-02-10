<?php vinclude('layout/header') ?>

    <body>
    <div id="app">

        <?php render_sidebar(); ?>

        <div id="main" class='layout-navbar'>
            <?php vinclude('components/header_content') ?>
            <div id="main-content" class="pt-0">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>My Orders</h3>
                                <p class="text-subtitle text-muted">All orders which aren't completed or canceled.</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <div class="float-start float-end">
                                    <a class="btn btn-primary" href="<?= url('customer/orders/create') ?>">Place New Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <?= alert() ?>
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Ordered Date</th>
                                            <th>Vehicle Type</th>
                                            <th>Date of Pickup</th>
                                            <th>Pickup Location</th>
                                            <th>Drop Location</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($orders as $order): ?>
                                            <tr>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= date_format(date_create($order['order_date']), 'd-m-Y') ?></td>
                                                <td><?= $order['vt_name'] ?></td>
                                                <td><?= date_format(date_create($order['pickup_date']), 'd-m-Y') ?></td>
                                                <td><?= $order['pickup_location_name'] ?></td>
                                                <td><?= $order['drop_location_name'] ?></td>
                                                <td><span class="badge <?php if(in_array($order['order_status_id'], [ORDER_STATUS_PENDING, ORDER_STATUS_RETURNED, ORDER_STATUS_CANCELLED])): ?> bg-danger <?php else: ?> bg-success <?php endif; ?>"><?= $order['os_name'] ?></span></td>
                                                <td class="py-1">
                                                    <div class="d-flex gap-1">
                                                        <a href="<?= url('customer/orders/show', ['id' => $order['order_id']]) ?>" class="btn btn-primary btn-block btn-sm">View</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <?php vinclude('components/footer_content') ?>
            </div>
        </div>
    </div>
    <script src="<?= url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <script src="<?= url('assets/vendors/simple-datatables/simple-datatables.js') ?>"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="<?= url('assets/js/main.js') ?>"></script>
    </body>

<?php vinclude('layout/footer') ?>