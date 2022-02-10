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
                                <h3>Create New Order</h3>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?= url('orders') ?>">Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create New Order</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="<?= url('orders') ?>" class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="vehicle_type_id" class="form-label">Customer</label>
                                                <select name="user_id" id="user_id" class="form-select <?php if(error('user_id')) echo 'is-invalid'; ?>">
                                                    <option value="">Select a Customer</option>
                                                    <?php foreach ($customers as $customer): ?>
                                                        <option value="<?= $customer['user_id'] ?>"><?= $customer['name'] ?>
                                                            | <?= $customer['phone'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="pickup_date" class="form-label">Pickup Date</label>
                                                <input type="date" name="pickup_date" value="<?= date('Y-m-d') ?>"
                                                       min="<?= date('Y-m-d') ?>" class="form-control <?php if(error('pickup_date')) echo 'is-invalid'; ?>"
                                                       placeholder="Select Date">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="vehicle_type_id" class="form-label">Vehicle Type</label>
                                                <select name="vehicle_type_id" id="vehicleType" class="form-select <?php if(error('vehicle_type_id')) echo 'is-invalid'; ?>">
                                                    <option value="">Select Vehicle Type</option>
                                                    <?php foreach ($vehicleTypes as $vehicleType): ?>
                                                        <option value="<?= $vehicleType['vt_id'] ?>"
                                                                data-rate="<?= $vehicleType['km_rate'] ?>"><?= $vehicleType['vt_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="vehicle_id" class="form-label">Vehicle</label>
                                                <select name="vehicle_id" id="vehicle" class="form-select <?php if(error('vehicle_id')) echo 'is-invalid'; ?>">
                                                    <option value="">Select a Vehicle</option>
                                                    <?php foreach ($vehicles as $vehicle): ?>
                                                        <option value="<?= $vehicle['vehicle_id'] ?>"><?= $driver['vehicle_name'] ?>
                                                            - <?= $driver['reg_number'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="amount" class="form-label">Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="text" name="amount" id="amount" class="form-control <?php if(error('amount')) echo 'is-invalid'; ?>"
                                                           aria-label="Amount (to the nearest amount)"
                                                           placeholder="Amount">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="pickup_location_id" class="form-label">Pickup
                                                    Location</label>
                                                <select name="pickup_location_id" id="pickup_location_id"
                                                        class="form-select <?php if(error('pickup_location_id')) echo 'is-invalid'; ?>">
                                                    <option value="">Select Pickup Location</option>
                                                    <?php foreach ($locations as $location): ?>
                                                        <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?>
                                                            , <?= $location['city_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="drop_location_id" class="form-label">Drop Location</label>
                                                <select name="drop_location_id" id="drop_location_id"
                                                        class="form-select <?php if(error('drop_location_id')) echo 'is-invalid'; ?>">
                                                    <option value="">Select Drop Location</option>
                                                    <?php foreach ($locations as $location): ?>
                                                        <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?>
                                                            , <?= $location['city_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" class="form-control" id="description"
                                                          rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="comments" class="form-label">Comments</label>
                                                <textarea name="comments" class="form-control" id="comments"
                                                          rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Create Order
                                            </button>
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
    <script src="<?= url('assets/js/extensions/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= url('assets/js/extensions/select2.full.min.js') ?>"></script>

    <script type="application/javascript">
        /**
         * Reference
         *
         * Event Listener: https://www.w3schools.com/jsref/met_document_addeventlistener.asp
         * Js Fetch: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
         */
        const vehicleTypeDropdown = document.querySelector('#vehicleType');
        const vehicleDropdown = document.querySelector('#vehicle');
        const amountInput = document.querySelector('#amount');

        vehicleTypeDropdown.addEventListener('change', function () {
            const vehicleTypId = this.value;
            amountInput.value = vehicleTypeDropdown.options[vehicleTypeDropdown.selectedIndex].dataset.rate;
            const formData = new FormData();
            vehicleDropdown.disabled = true;
            formData.append('vehicleTypId', vehicleTypId);
            fetch('<?= url("ajax/vehicles") ?>', {
                method: 'POST',
                body: formData,
            }).then(response => response.json())
                .then(data => {
                    const items = [];
                    items.push('<option value="">Select a Vehicle</option>');
                    data.map(vehicle => {
                        items.push('<option value="' + vehicle.vehicle_id + '">' + vehicle.vehicle_name + '(' + vehicle.reg_number + ')' + '</option>')
                    })
                    vehicleDropdown.innerHTML = items.join('');
                    vehicleDropdown.disabled = false;
                });
        });

        $('#user_id').select2({
            theme: 'bootstrap-5'
        });

        $('#pickup_location_id').select2({
            theme: 'bootstrap-5'
        });

        $('#drop_location_id').select2({
            theme: 'bootstrap-5'
        });
    </script>

    <script src="<?= url('assets/js/main.js') ?>"></script>
    </body>

<?php vinclude('layout/footer') ?>