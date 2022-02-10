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
                            <h3>Vehicles</h3>
                            <p class="text-subtitle text-muted">Manage vehicles</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <div class="float-start float-end">
                                <a class="btn btn-primary" href="<?= url('vehicles/create') ?>">Add Vehicle</a>
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
                                        <th>Vehicle Name</th>
                                        <th>Type</th>
                                        <th>Reg Number</th>
                                        <th>Driver</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($vehicles as $vehicle): ?>
                                        <tr>
                                            <td><?= $vehicle['vehicle_name'] ?></td>
                                            <td><?= $vehicle['vt_name'] ?></td>
                                            <td><?= $vehicle['reg_number'] ?></td>
                                            <td><?= $vehicle['driver_name'] ?></td>
                                            <td><?= $vehicle['vs_name'] ?></td>
                                            <td class="py-1">
                                                <div class="d-flex gap-1">
                                                    <a href="<?= url('vehicles/edit', ['id' => $vehicle['vehicle_id']]) ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="<?= url('vehicles/delete') ?>" method="post">
                                                        <input name="vehicle_id" type="hidden" value="<?= $vehicle['vehicle_id'] ?>">
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
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