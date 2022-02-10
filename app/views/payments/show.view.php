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
                                <h3>Receipt | Payment #<?= $payment['payment_id'] ?></h3>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <div class="float-start float-lg-end">
                                    <button id="printInvoice" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                        </svg>
                                        Print
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section id="invoice" class="section">
                        <div class="card mt-4">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td class="border-0">
                                            <div class="row">
                                                <div class="col text-md-left mb-3 mb-md-0">
                                                    <img class="logo img-fluid mb-3"
                                                         src="<?= url('assets/images/logo/logo.png') ?>"
                                                         alt="Company Logo"/>

                                                    <h2><?= $settings['company_name'] ?></h2>
                                                    <p><?= $settings['address'] ?></p>
                                                    <p>Phone: <?= $settings['primary_phone'] ?>
                                                        | <?= $settings['mobile'] ?></p>
                                                    <p><strong>freightgate.com</strong></p>
                                                </div>

                                                <div class="col text-end">

                                                    <!-- Dont' display Bill To on mobile -->
                                                    <span class="d-none d-md-block">
                                                    <h1>Billed To</h1>
                                                </span>

                                                    <h4 class="mb-0"><?= $customer['name'] ?></h4>

                                                    <?= $customer['address'] ?><br/>
                                                    <?= $customer['city_name'] ?>, <?= $customer['state_name'] ?><br/>
                                                    <?= $customer['email'] ?><br/>

                                                    <h5 class="mb-0 mt-3"><?= date_format(date_create($payment['payment_date']), 'm/d/Y') ?></h5>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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
                                            Movement of goods from <?= $order['pickup_location'] ?>
                                            to <?= $order['delivery_location'] ?> on <?= $order['pickup_date'] ?>
                                        </td>
                                        <td class="font-weight-bold align-middle text-end text-nowrap">
                                            ₹<?= $payment['amount'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end border-0 pt-4"><h5>Total:
                                                ₹<?= $payment['amount'] ?></h5></td>
                                    </tr>
                                </table>
                                <h5 class="text-center pt-2">Thank you for choosing city freight service.</h5>
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

    <script>
        const printButton = document.querySelector('#printInvoice');
        printButton.addEventListener("click", function() {
            const invoiceContent = document.querySelector('#invoice').innerHTML;
            const tempWindow = window.open();
            tempWindow.document.write(invoiceContent);
            tempWindow.print();
            tempWindow.close();
        })
    </script>
    </body>

<?php vinclude('layout/footer') ?>