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
                                <h3>Vehicle Information</h3>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Vehicle Information</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <?php if($vehicle): ?>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="model" class="form-label">Vehicle Type</label>
                                                <p><?= $vehicle['vt_name'] ?></p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="model" class="form-label">Vehicle Status</label>
                                                <p><?= $vehicle['vs_name'] ?></p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="model" class="form-label">Model</label>
                                                <p><?= $vehicle['vehicle_name'] ?></p>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="model" class="form-label">Registration Number</label>
                                                <p><?= $vehicle['reg_number'] ?></p>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= url('assets/images/truck.svg') ?>" class="img-fluid w-50" alt="Truck" />
                                            <h5>You don't have a truck assigned to you. Please check back later.</h5>
                                        </div>
                                        <?php endif; ?>
                                    </div>
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
        const orderCancelForm = document.querySelector('#orderCancelForm');

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

        orderCancelForm.addEventListener('submit', function (e) {
            if (!confirm('Do you really want to cancel the order?')) {
                e.preventDefault();
            }
        })
    </script>

    <script src="<?= url('assets/js/main.js') ?>"></script>
    </body>

<?php vinclude('layout/footer') ?>