<?php vinclude('layout/header') ?>

    <body>
    <div id="app">

        <?php vinclude('components/customer_sidebar') ?>

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
                                        <li class="breadcrumb-item"><a href="<?= url('customer/orders') ?>">My
                                                Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create New Order</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="<?= url('customer/orders') ?>" class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
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
                                            <div class="form-group col-md-6">
                                                <label for="rate" class="form-label">Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="text" name="amount" id="amount" class="form-control <?php if(error('amount')) echo 'is-invalid'; ?>"
                                                           aria-label="Amount (to the nearest amount)"
                                                           placeholder="Amount"
                                                           readonly="readonly"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" class="form-control  <?php if(error('description')) echo 'is-invalid'; ?>" id="description"
                                                          rows="2"></textarea>
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
    <script src="<?= url('assets/js/main.js') ?>"></script>
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
            amountInput.value = vehicleTypeDropdown.options[vehicleTypeDropdown.selectedIndex].dataset.rate;
        });

        $('#pickup_location_id').select2({
            theme: 'bootstrap-5'
        })

        $('#drop_location_id').select2({
            theme: 'bootstrap-5'
        })

    </script>
    </body>

<?php vinclude('layout/footer') ?>