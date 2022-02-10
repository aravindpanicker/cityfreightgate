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
                            <h3>Vehicle Types</h3>
                            <p class="text-subtitle text-muted">Manage Types of Vehicles</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <div class="float-start float-end">
                                <a class="btn btn-primary" href="<?= url('vehicle-types/create') ?>">Add Vehicle Type</a>
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
                                        <th class="w-75">Name</th>
                                        <th>Rate / Km</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($vehicleTypes as $vehicleType): ?>
                                        <tr>
                                            <td><?= $vehicleType['vt_name'] ?></td>
                                            <td><?= $vehicleType['km_rate'] ?></td>
                                            <td class="d-flex gap-1 py-1">
                                                <a href="<?= url('vehicle-types/edit', ['id' => $vehicleType['vt_id']]) ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="<?= url('vehicle-types/delete') ?>" method="post">
                                                    <input name="vt_id" type="hidden" value="<?= $vehicleType['vt_id'] ?>">
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