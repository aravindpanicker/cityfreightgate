<?php require 'layout/header.view.php' ?>
    <body>
    <div id="app">
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container">
                    <a class="navbar-brand me-auto" href="<?= url('/') ?>">
                        <img src="<?= url('assets/images/logo/logo.png') ?>" alt="Logo" style="min-height: 2.5rem;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= home_page() ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-link" href="<?= url('login') ?>">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <section class="hero">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form method="get" action="<?= url('track') ?>">
                            <div class="input-group my-3">
                                <input name= "number" type="text" class="form-control form-control-lg"
                                       placeholder="Enter your tracking number" aria-label="Enter your tracking number"
                                       aria-describedby="button-addon2"
                                       value="<?php if ($order) echo $order['order_id']; ?>">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Track my Order</button>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-3">
                                    <?php if (count($events) > 0): ?>
                                        <h4 class="card-title">Tracking Details</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Order Status</th>
                                                <td><?= $order["order_status"] ?></td>
                                            </tr>
                                        </table>
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
                                    <?php else: ?>
                                        <img class="img-fluid" src="<?= url('assets/images/not-found.svg') ?>"
                                             alt="Not Found">
                                        <h2 class="card-title text-center">Tracking Information Unavailable</h2>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="<?= url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    </body>
<?php require 'layout/footer.view.php' ?>