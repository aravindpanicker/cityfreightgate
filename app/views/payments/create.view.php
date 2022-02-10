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
                            <h3>Add Payment</h3>
                            <p class="text-subtitle text-muted">Manually Add a Payment</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= url('payments') ?>">Payment</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Payment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?= url('payments') ?>" class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="order_id" class="form-label">Order #</label>
                                                <select name="order_id" id="order" class="form-select <?php if(error('order_id')): ?> is-invalid <?php endif; ?>">
                                                    <option value="">Select Order Number</option>
                                                    <?php foreach ($orders as $order): ?>
                                                        <option value="<?= $order['order_id'] ?>" data-rate="<?= $order['amount'] ?>"><?= $order['name'] . ' / ' . $order['order_id'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_type_id" class="form-label">Payment Type</label>
                                                <select name="payment_type_id" id="paymentType" class="form-select <?php if(error('payment_type_id')): ?> is-invalid <?php endif; ?>">
                                                    <option value="">Select Payment Type</option>
                                                    <?php foreach ($paymentTypes as $paymentType): ?>
                                                        <option value="<?= $paymentType['pt_id'] ?>"><?= $paymentType['pt_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_status_id" class="form-label">Payment Status</label>
                                                <select name="payment_status_id" id="payment_status_id" class="form-select <?php if(error('payment_status_id')): ?> is-invalid <?php endif; ?>">
                                                    <option value="">Select Payment Status</option>
                                                    <?php foreach ($paymentStatuses as $status): ?>
                                                        <option value="<?= $status['ps_id'] ?>"><?= $status['ps_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_date" class="form-label">Payment Date</label>
                                                <input type="date" name="payment_date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>" class="form-control <?php if(error('payment_date')): ?> is-invalid <?php endif; ?>" placeholder="Select Date">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="amount" class="form-label">Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="text" name="amount" id="amount" class="form-control <?php if(error('amount')): ?> is-invalid <?php endif; ?>" aria-label="Amount (to the nearest amount)" placeholder="Amount">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card_number" class="form-label">Credit Card Number (Last 4 digits)</label>
                                                <input type="text" id="cardNumber" class="form-control <?php if(error('card_number')): ?> is-invalid <?php endif; ?>" name="card_number" max="9999" placeholder="Credit Card Number" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exp_date" class="form-label">Card Expiry Date</label>
                                                <input type="text" id="expDate" name="exp_date" class="form-control <?php if(error('exp_date')): ?> is-invalid <?php endif; ?>" placeholder="MM/YYY" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="comments" class="form-label">Remarks</label>
                                                <textarea name="comments" class="form-control <?php if(error('comments')): ?> is-invalid <?php endif; ?>" id="comments" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Add Payment</button>
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
<script src="<?= url('assets/js/extensions/inputmask.min.js') ?>"></script>

<script type="application/javascript">
    /**
     * Reference
     *
     * Event Listener: https://www.w3schools.com/jsref/met_document_addeventlistener.asp
     * Js Fetch: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
     */
    const orderDropdown = document.querySelector('#order');
    const paymentTypeDropdown = document.querySelector('#paymentType');
    const amountInput = document.querySelector('#amount');
    const cardNumber = document.querySelector('#cardNumber');
    const expDate = document.querySelector('#expDate');

    orderDropdown.addEventListener('change', function() {
        amountInput.value = orderDropdown.options[orderDropdown.selectedIndex].dataset.rate;
    });

    paymentTypeDropdown.addEventListener('change', function() {
        if(parseInt(this.value) === 2) {
            cardNumber.disabled = false;
            expDate.disabled = false;
        } else {
            cardNumber.disabled = true;
            expDate.disabled = true;
        }
    });

    // Credit Card Field Mask
    let creditCardFieldSelector = document.getElementById('cardNumber');
    let cc = new Inputmask("9999");
    cc.mask(creditCardFieldSelector);

    // Expiry Date Field Mask
    let expDateFieldSelector = document.getElementById('expDate');
    let expiryDate = new Inputmask("99/99");
    expiryDate.mask(expDateFieldSelector);
</script>

<script src="<?= url('assets/js/main.js') ?>"></script>
</body>

<?php vinclude('layout/footer') ?>