<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - <?= $properties['title'] ?></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/css/app.css') ?>">
</head>

<body>

<div id="report" class="container-fluid">
    <div class="row my-5 text-center">
        <h3 class="card-title"><?= $properties['title'] ?></h3>
        <h6>Generated on: <?= date('d-m-Y h:i A') ?></h6>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 text-sm">
                    <thead>
                    <tr>
                        <th>Id #</th>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Type</th>
                        <th>Card Number</th>
                        <th>Exp Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($payments as $payment): ?>
                    <tr>
                        <td class="text-bold-500"><?= $payment['payment_id'] ?></td>
                        <td><?= $payment['order_id'] ?></td>
                        <td><?= $payment['payment_date'] ?></td>
                        <td><?= $payment['amount'] ?></td>
                        <td><?= $payment['ps_name'] ?></td>
                        <td><?= $payment['pt_name'] ?></td>
                        <td><?= $payment['card_number'] ?></td>
                        <td><?= $payment['exp_date'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="col text-center">
        <button id="printButton" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            </svg>
            Print
        </button>
    </div>
</div>

<script>
    const printButton = document.querySelector('#printButton');
    printButton.addEventListener('click', function() {
        document.querySelector('button').hidden = true;
        print(document);
        document.querySelector('button').hidden = false;
    });
</script>

</body>

</html>