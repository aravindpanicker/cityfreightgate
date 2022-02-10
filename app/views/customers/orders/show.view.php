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
                                        <li class="breadcrumb-item"><a href="<?= url('customer/orders') ?>">My
                                                Orders</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
                                                        <label for="order_date" class="form-label">Ordered Date</label>
                                                        <input type="date" name="order_date"
                                                               value="<?= $order['order_date'] ?>" class="form-control"
                                                               disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vehicle_type_id" class="form-label">Vehicle
                                                            Type</label>
                                                        <select name="vehicle_type_id" id="vehicleType"
                                                                class="form-select" disabled>
                                                            <option value="">Select Vehicle Type</option>
                                                            <?php foreach ($vehicleTypes as $vehicleType): ?>
                                                                <option value="<?= $vehicleType['vt_id'] ?>"
                                                                        data-rate="<?= $vehicleType['km_rate'] ?>" <?php if ($vehicleType['vt_id'] === $order['vehicle_type_id']): ?> selected <?php endif; ?>>
                                                                    <?= $vehicleType['vt_name'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount" class="form-label">Amount</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">₹</span>
                                                            <input type="text" value="<?= $order['amount'] ?>"
                                                                   name="amount" id="amount" class="form-control"
                                                                   aria-label="Amount (to the nearest amount)"
                                                                   placeholder="Amount" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="form-group">
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
                                                    <div class="form-group">
                                                        <label for="pickup_date" class="form-label">Pickup Date</label>
                                                        <input type="date" name="pickup_date"
                                                               value="<?= $order['pickup_date'] ?>"
                                                               min="<?= date('Y-m-d') ?>" class="form-control"
                                                               placeholder="Select Date" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="drop_location_id" class="form-label">Drop
                                                            Location</label>
                                                        <select name="drop_location_id" id="drop_location_id"
                                                                class="form-select" disabled>
                                                            <option value="">Select Drop Location</option>
                                                            <?php foreach ($locations as $location): ?>
                                                                <option value="<?= $location['location_id'] ?>" <?php if ($location['location_id'] === $order['drop_location_id']): ?> selected <?php endif; ?>>
                                                                    <?= $location['location_name'] ?>
                                                                    , <?= $location['city_name'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
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
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-grid gap-2">
                                            <?php if (!in_array($order['order_status_id'], [ORDER_STATUS_PENDING, ORDER_STATUS_CANCELLED])): ?>
                                                <a class="btn btn-primary btn-block"
                                                   href="<?= url('customer/invoice', ['order_id' => $order['order_id']]) ?>">View
                                                    Invoice</a>
                                            <?php endif; ?>
                                            <?php if ($order['order_status_id'] === ORDER_STATUS_PENDING): ?>
                                                <form method="post" action="<?= url('customer/orders/payment') ?>"
                                                      class="form form-vertical">
                                                    <input name="order_id" type="hidden"
                                                           value="<?= $order['order_id'] ?>">
                                                    <input name="amount" type="hidden" value="<?= $order['amount'] ?>">
                                                    <button type="submit" class="btn btn-block btn-primary">Complete
                                                        Payment
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <?php if (in_array($order['order_status_id'], [ORDER_STATUS_PENDING, ORDER_STATUS_CONFIRMED])): ?>
                                                <form id="orderCancelForm" method="post" action="<?= url('customer/orders/cancel') ?>"
                                                      class="form form-vertical">
                                                    <input name="order_id" type="hidden"
                                                           value="<?= $order['order_id'] ?>">
                                                    <button type="submit"
                                                            class="btn btn-block btn-danger">Cancel Order
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($order['vehicle_name'] && $order['reg_number']): ?>
                        <div class="row">
                            <div class="col-12 col-md-9">
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
                            <div class="col-12 col-md-9">
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
                            <div class="col-12 col-md-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Payment Details</h4>
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