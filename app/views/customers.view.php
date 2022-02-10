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
                            <h3><?= $header['title'] ?></h3>
                            <p class="text-subtitle text-muted"><?= $header['description'] ?></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <div class="float-start float-end">
                                <a href="<?= $header['report_url'] ?>" target="_blank" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                    </svg> Print Report
                                </a>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>City</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($customers as $customer): ?>
                                        <tr>
                                            <td><?= $customer['name'] ?></td>
                                            <td><?= $customer['email'] ?></td>
                                            <td><?= $customer['phone'] ?></td>
                                            <td><?= $customer['location_name'] ?></td>
                                            <td><?= $customer['city_name'] .', ' . $customer['state_name'] ?></td>
                                            <td>
                                                <span class="badge <?php if($customer['user_status_id'] === USER_STATUS_ACTIVE) echo 'bg-success'; else echo 'bg-danger' ?>"><?= $customer['status_name'] ?></span>
                                            </td>
                                            <td class="">
                                                <form action="<?= url('users/reset-password') ?>" method="post">
                                                    <input name="user_id" type="hidden" value="<?= $customer['user_id'] ?>">
                                                    <button class="btn btn-warning btn-sm">Reset Password</button>
                                                </form>
                                                <?php if($customer['user_status_id'] === USER_STATUS_ACTIVE): ?>
                                                    <form action="<?= url('users/deactivate') ?>" method="post">
                                                        <input name="user_id" type="hidden" value="<?= $customer['user_id'] ?>">
                                                        <button class="btn btn-danger btn-sm">Deactivate</button>
                                                    </form>
                                                <?php endif ?>
                                                <?php if($customer['user_status_id'] === USER_STATUS_INACTIVE): ?>
                                                    <form action="<?= url('users/activate') ?>" method="post">
                                                        <input name="user_id" type="hidden" value="<?= $customer['user_id'] ?>">
                                                        <button class="btn btn-success btn-sm">Activate</button>
                                                    </form>
                                                <?php endif ?>
                                                <form action="<?= url('users/delete') ?>" method="post">
                                                    <input name="user_id" type="hidden" value="<?= $customer['user_id'] ?>">
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
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