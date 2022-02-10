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
                            <h3>Add New Vehicle</h3>
                            <p class="text-subtitle text-muted">You can add, update and remove vehicles from this module.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= url('vehicles') ?>">Vehicles</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Vehicle</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?= url('vehicles') ?>" class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="vehicle_type_id" class="form-label">Vehicle Type</label>
                                                <select name="vehicle_type_id" id="vehicle_type_id" class="form-select <?php if(error('vehicle_type_id')): ?> is-invalid <?php endif; ?>">
                                                    <option value="">Select Vehicle Type</option>
                                                    <?php foreach ($vehicleTypes as $vehicleType): ?>
                                                        <option value="<?= $vehicleType['vt_id'] ?>" <?php if($vehicleType['vt_id'] == old('vehicle_type_id')) echo 'selected' ?>><?= $vehicleType['vt_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= error('vehicle_type_id') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="driver_id" class="form-label">Driver</label>
                                                <select name="driver_id" id="driver_id" class="form-select <?php if(error('driver_id')): ?> is-invalid <?php endif; ?>">
                                                    <option value="">Select a Driver</option>
                                                    <?php foreach ($drivers as $driver): ?>
                                                        <option value="<?= $driver['user_id'] ?>" <?php if($driver['user_id'] == old('driver_id')) echo 'selected' ?>><?= $driver['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= error('driver_id') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="vehicle_status_id" class="form-label">Status</label>
                                                <select name="vehicle_status_id" id="vehicle_status_id" class="form-select <?php if(error('vehicle_status_id')): ?> is-invalid <?php endif; ?>">
                                                    <option value="">Select Vehicle Status</option>
                                                    <?php foreach ($vehicleStatuses as $status): ?>
                                                        <option value="<?= $status['vs_id'] ?>" <?php if($status['vs_id'] == old('vehicle_status_id')) echo 'selected' ?>><?= $status['vs_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= error('vehicle_status_id') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="vehicle_name" class="form-label">Vehicle Name / Model</label>
                                                <input type="text" value="<?= old('vehicle_name') ?>" name="vehicle_name" class="form-control <?php if(error('vehicle_name')): ?> is-invalid <?php endif; ?>" placeholder="Enter vehicle name or model">
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= error('vehicle_name') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="reg_number" class="form-label">Registration Number</label>
                                                <input type="text" value="<?= old('reg_number') ?>" name="reg_number" class="form-control <?php if(error('reg_number')): ?> is-invalid <?php endif; ?>" placeholder="Enter Registration Number">
                                                <div class="invalid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    <?= error('reg_number') ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Save</button>
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
<script src="<?= url('assets/js/main.js') ?>"></script>
</body>

<?php vinclude('layout/footer') ?>