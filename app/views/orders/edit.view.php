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
                                <h3>Edit Order #<?= $order['order_id'] ?></h3>
                                <p class="text-subtitle text-muted">Edit order information</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?= url('orders') ?>">Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Order</li>
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
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="vehicle_type_id" class="form-label">Customer</label>
                                                    <select name="user_id" id="user_id" class="form-select" disabled>
                                                        <option value="">Select a Customer</option>
                                                        <?php foreach ($customers as $customer): ?>
                                                            <option value="<?= $customer['user_id'] ?>" <?php if ($customer['user_id'] === $order['user_id']): ?> selected <?php endif; ?>>
                                                                <?= $customer['name'] ?> | <?= $customer['phone'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="vehicle_type_id" class="form-label">Vehicle Type</label>
                                                    <select name="vehicle_type_id" id="vehicleType" class="form-select"
                                                            disabled>
                                                        <option value="">Select Vehicle Type</option>
                                                        <?php foreach ($vehicleTypes as $vehicleType): ?>
                                                            <option value="<?= $vehicleType['vt_id'] ?>"
                                                                    data-rate="<?= $vehicleType['km_rate'] ?>" <?php if ($vehicleType['vt_id'] === $order['vehicle_type_id']): ?> selected <?php endif; ?>>
                                                                <?= $vehicleType['vt_name'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">₹</span>
                                                        <input type="text" value="<?= $order['amount'] ?>" name="amount"
                                                               id="amount" class="form-control"
                                                               aria-label="Amount (to the nearest amount)"
                                                               placeholder="Amount" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pickup_location_id" class="form-label">Pickup
                                                        Location</label>
                                                    <select name="pickup_location_id" id="pickup_location_id"
                                                            class="form-select" disabled>
                                                        <option value="">Select Vehicle Status</option>
                                                        <?php foreach ($locations as $location): ?>
                                                            <option value="<?= $location['location_id'] ?>" <?php if ($location['location_id'] === $order['pickup_location_id']): ?> selected <?php endif; ?>>
                                                                <?= $location['location_name'] ?>
                                                                , <?= $location['city_name'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pickup_date" class="form-label">Pickup Date</label>
                                                    <input type="date" name="pickup_date"
                                                           value="<?= $order['pickup_date'] ?>"
                                                           min="<?= date('Y-m-d') ?>" class="form-control"
                                                           placeholder="Select Date" disabled>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="drop_location_id" class="form-label">Drop
                                                        Location</label>
                                                    <select name="drop_location_id" id="drop_location_id"
                                                            class="form-select" disabled>
                                                        <option value="">Select Drop Location</option>
                                                        <?php foreach ($locations as $location): ?>
                                                            <option value="<?= $location['location_id'] ?>" <?php if ($location['location_id'] === $order['drop_location_id']): ?> selected <?php endif; ?>>
                                                                <?= $location['location_name'] ?>, <?= $location['city_name'] ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-12">
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
                            <div class="col-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="<?= url('orders/update') ?>"
                                              class="form form-vertical">
                                            <input name="order_id" type="hidden" value="<?= $order['order_id'] ?>">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="vehicle_id" class="form-label">Vehicle</label>
                                                            <select name="vehicle_id" id="vehicle"
                                                                    class="form-select bg-light-warning <?php if (error('vehicle_id')): ?> is-invalid <?php endif; ?>">
                                                                <option value="">Select a Vehicle</option>
                                                                <?php foreach ($vehicles as $vehicle): ?>
                                                                    <option value="<?= $vehicle['vehicle_id'] ?>" <?php if ($vehicle['vehicle_id'] === $order['vehicle_id']): ?> selected <?php endif; ?>>
                                                                        <?= $vehicle['vehicle_name'] ?>
                                                                        - <?= $vehicle['reg_number'] ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="order_status_id" class="form-label">Order
                                                                Status</label>
                                                            <select name="order_status_id" id="drop_location_id"
                                                                    class="form-select bg-light-warning <?php if (error('order_status_id')): ?> is-invalid <?php endif; ?>">
                                                                <option value="">Select Order Status</option>
                                                                <?php foreach ($orderStatuses as $orderStatus): ?>
                                                                    <option value="<?= $orderStatus['os_id'] ?>" <?php if ($orderStatus['os_id'] === $order['order_status_id']): ?> selected <?php endif; ?>>
                                                                        <?= $orderStatus['os_name'] ?>
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

                        <?php if($order['vehicle_name'] && $order['reg_number']): ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Vehicle Details</h4>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Make</label>
                                                    <p><?= $order['vehicle_name'] ?></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Registration Number</label>
                                                    <p><?= $order['reg_number'] ?></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Driver's Name</label>
                                                    <p><?= $driver['name'] ?></p>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Contact Number</label>
                                                    <p><?= $driver['phone'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Tracking Details</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Order Status</th>
                                                <td><?= $order["order_status"] ?></td>
                                            </tr>
                                        </table>
                                        <?php if (count($events) > 0): ?>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Event</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($events as $event): ?>
                                                    <tr>
                                                        <td><?= date_format(date_create($event['date_time']), 'd-m-Y') ?></td>
                                                        <td><?= date_format(date_create($event['date_time']), 'h:i A') ?></td>
                                                        <td><?= $event['description'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Payment</h4>
                                        <table class="table table-striped">
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
                                            <?php if (is_array($payment)): ?>
                                                <tr>
                                                    <td><?= $payment['payment_id'] ?></td>
                                                    <td><?= $payment['order_id'] ?></td>
                                                    <td><?= $payment['payment_date'] ?></td>
                                                    <td><?= $payment['pt_name'] ?></td>
                                                    <td><?= $payment['amount'] ?></td>
                                                    <td><?= $payment['card_number'] ?></td>
                                                    <td><?= $payment['exp_date'] ?></td>
                                                    <td>
                                                        <span class="badge <?php if ($payment['payment_status_id'] === PAYMENT_STATUS_SUCCESS): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>"><?= $payment['ps_name'] ?></span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="<?= url('payments/show', ['id' => $payment['payment_id']]) ?>"
                                                               class="btn btn-success btn-sm">View</a>
                                                            <?php if ($payment['payment_status_id'] === PAYMENT_STATUS_SUCCESS): ?>
                                                                <form action="<?= url('payments/refund') ?>"
                                                                      method="post">
                                                                    <input name="payment_id" type="hidden"
                                                                           value="<?= $payment['payment_id'] ?>">
                                                                    <button class="btn btn-danger btn-sm">Refund
                                                                    </button>
                                                                </form>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <tr>
                                                    <td class="text-center" colspan="9">No records found!</td>
                                                </tr>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
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
    </script>

    <script src="<?= url('assets/js/main.js') ?>"></script>
    </body>

<?php vinclude('layout/footer') ?>