<?php vinclude('layout/header') ?>

<body>
<div id="app">

    <?php vinclude('components/sidebar') ?>

    <div id="main" class='layout-navbar'>
        <?php vinclude('components/header_content') ?>
        <div id="main-content" class="pt-0">
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Payments</h3>
                            <p class="text-subtitle text-muted">Manage payments</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <div class="float-start float-end">
                                <a class="btn btn-secondary" href="<?= url('reports/payments') ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                    </svg>
                                    Print Report</a>
                                <a class="btn btn-primary" href="<?= url('payments/create') ?>">Add Payment</a>
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
                                        <th>Payment #</th>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Card Number</th>
                                        <th>Exp Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($payments as $payment): ?>
                                        <tr>
                                            <td><?= $payment['payment_id'] ?></td>
                                            <td><?= $payment['order_id'] ?></td>
                                            <td><?= $payment['payment_date'] ?></td>
                                            <td><?= $payment['pt_name'] ?></td>
                                            <td><?= $payment['amount'] ?></td>
                                            <td><?= $payment['card_number'] ?></td>
                                            <td><?= $payment['exp_date'] ?></td>
                                            <td><span class="badge <?php if($payment['payment_status_id'] === PAYMENT_STATUS_SUCCESS): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>"><?= $payment['ps_name'] ?></span></td>
                                            <td class="py-1">
                                                <div class="d-flex gap-1">
                                                    <?php if($payment['payment_status_id'] !== PAYMENT_STATUS_CANCELLED): ?>
                                                    <a href="<?= url('payments/show', ['id' => $payment['payment_id']]) ?>" class="btn btn-success btn-sm">View</a>
                                                    <?php endif; ?>
                                                    <?php if($payment['payment_status_id'] === PAYMENT_STATUS_SUCCESS): ?>
                                                        <form action="<?= url('payments/refund') ?>" method="post">
                                                            <input name="payment_id" type="hidden" value="<?= $payment['payment_id'] ?>">
                                                            <button class="btn btn-danger btn-sm">Refund</button>
                                                        </form>
                                                    <?php endif; ?>
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