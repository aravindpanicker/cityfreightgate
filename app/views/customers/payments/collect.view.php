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
                            <h3>Complete Payment</h3>
                            <p class="text-subtitle text-muted">Please enter your credit card information below to complete the payment</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= url('customer/orders') ?>">Orders</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Complete Payment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Summary</th>
                                        <th class="text-end">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="mb-1"><?= $order['vt_name'] . ' - ' . $order['vehicle_name'] ?></h5>
                                            Movement of goods from <?= $order['pickup_location'] ?> to <?= $order['delivery_location'] ?> on <?= $order['pickup_date'] ?>
                                        </td>
                                        <td class="font-weight-bold align-middle text-end text-nowrap">₹<?= $amount ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end border-0 pt-4"><h5>Total: ₹<?= $amount ?></h5></td>
                                    </tr>
                                </table>
                            </div>
                            <form method="post" action="<?= url('customer/payments') ?>" class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img class="image w-75 d-none d-md-block" src="<?= url('assets/images/credit-card.svg') ?>" alt="Credit Card">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="cardNumber" class="form-label text-uppercase">Card Number</label>
                                                    <input type="text" id="cardNumber" name="card_number" class="form-control <?php if(error('card_number')): ?> is-invalid <?php endif; ?>" required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="expDate" class="form-label text-uppercase">Card Expiry (MM/YY)</label>
                                                    <input type="text" id="expDate" name="exp_date" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/yy" data-mask="" class="form-control <?php if(error('exp_date')): ?> is-invalid <?php endif; ?>" required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="cvv" class="form-label text-uppercase">Card CVV</label>
                                                    <input type="text" id="cvv" name="cvv" class="form-control <?php if(error('exp_date')): ?> is-invalid <?php endif; ?>" required>
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="cardholder_name" class="form-label text-uppercase">Cardholder Name</label>
                                                    <input type="text" id="cardholder_name" class="form-control <?php if(error('cardholder_name')): ?> is-invalid <?php endif; ?>" name="cardholder_name" required>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                            class="btn btn-success me-1 mb-1">Make Payment</button>
                                                </div>
                                            </div>
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
<script src="<?= url('assets/js/extensions/inputmask.min.js') ?>"></script>
<script type="application/javascript">

    Inputmask().mask(document.querySelectorAll("input"));

    // Credit Card Field Mask
    let creditCardFieldSelector = document.getElementById('cardNumber');
    let cc = new Inputmask("9999 9999 9999 9999");
    cc.mask(creditCardFieldSelector);

    // Expiry Date Field Mask
    let expDateFieldSelector = document.getElementById('expDate');
    let expiryDate = new Inputmask();
    expiryDate.mask(expDateFieldSelector);

    // CVV Mask
    let cvvFieldSelector = document.getElementById('cvv');
    let cvv = new Inputmask("999");
    cvv.mask(cvvFieldSelector);
</script>
</body>

<?php vinclude('layout/footer') ?>