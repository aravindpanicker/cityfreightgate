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
                            <h3>Edit Vehicle</h3>
                            <p class="text-subtitle text-muted">Edit vehicle related information</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= url('vehicles') ?>">Vehicles</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Vehicle</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?= url('vehicles/update') ?>" class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <input name="vehicle_id" type="hidden" value="<?= $vehicle['vehicle_id'] ?>">
                                            <div class="form-group">
                                                <label for="vehicle_type_id" class="form-label">Vehicle Type</label>
                                                <select name="vehicle_type_id" id="vehicle_type_id" class="form-select">
                                                    <option value="">Select Vehicle Type</option>
                                                    <?php foreach ($vehicleTypes as $vehicleType): ?>
                                                        <option value="<?= $vehicleType['vt_id'] ?>" <?php if($vehicleType['vt_id'] === $vehicle['vehicle_type_id']) echo 'selected' ?>><?= $vehicleType['vt_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="driver_id" class="form-label">Driver</label>
                                                <select name="driver_id" id="driver_id" class="form-select">
                                                    <option value="">Select a Driver</option>
                                                    <?php foreach ($drivers as $driver): ?>
                                                        <option value="<?= $driver['user_id'] ?>" <?php if($driver['user_id'] === $vehicle['driver_id']) echo 'selected' ?>><?= $driver['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="vehicle_status_id" class="form-label">Status</label>
                                                <select name="vehicle_status_id" id="vehicle_status_id" class="form-select">
                                                    <option value="">Select Vehicle Status</option>
                                                    <?php foreach ($vehicleStatuses as $status): ?>
                                                        <option value="<?= $status['vs_id'] ?>" <?php if($status['vs_id'] === $vehicle['vehicle_status_id']) echo 'selected' ?>><?= $status['vs_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="location_name" class="form-label">Vehicle Name / Model</label>
                                                <input type="text" name="vehicle_name" value="<?= $vehicle['vehicle_name'] ?>" class="form-control" placeholder="Enter vehicle name or model">
                                            </div>
                                            <div class="form-group">
                                                <label for="reg_number" class="form-label">Registration Number</label>
                                                <input type="text" name="reg_number" value="<?= $vehicle['reg_number'] ?>" class="form-control" placeholder="Enter Registration Number">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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