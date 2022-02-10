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
                                <h3>Order #<?= $order['order_id'] ?> Details</h3>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= url('driver/orders') ?>">Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="order_date" class="form-label">Ordered Date</label>
                                                    <p><?= $order['order_date'] ?></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <p>₹<?= $order['amount'] ?></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pickup_location_id" class="form-label">Pickup
                                                        Location</label>
                                                    <p><?= $order['pickup_location'] ?></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pickup_date" class="form-label">Pickup Date</label>
                                                    <p><?= $order['pickup_date'] ?></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="drop_location_id" class="form-label">Drop
                                                        Location</label>
                                                    <p><?= $order['delivery_location'] ?></p>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="description" class="form-label">Pickup &amp; Delivery Instructions</label>
                                                    <textarea name="description" class="form-control"
                                                              id="description" rows="2"
                                                              disabled><?= $order['description'] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="<?= url('driver/orders/update') ?>"
                                              class="form form-vertical">
                                            <input name="order_id" type="hidden" value="<?= $order['order_id'] ?>">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="order_status_id" class="form-label">Order
                                                                Status</label>
                                                            <select name="order_status_id" id="drop_location_id"
                                                                    class="form-select bg-light-warning <?php if (error('order_status_id')): ?> is-invalid <?php endif; ?>">
                                                                <option value="">Select Order Status</option>
                                                                <?php foreach ($driverStatusList as $status): ?>
                                                                    <option value="<?= $status['os_id'] ?>" <?php if ($status['os_id'] === $order['order_status_id']): ?> selected <?php endif; ?>>
                                                                        <?= $status['os_name'] ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="comments" class="form-label">Comments</label>
                                                            <textarea name="comments"
                                                                      class="form-control <?php if (error('comments')): ?> is-invalid <?php endif; ?>"
                                                                      id="comments"
                                                                      rows="3"><?= $order['comments'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary me-1">Update
                                                            Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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