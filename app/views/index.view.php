<?php require 'layout/header.view.php' ?>
<body>
<div id="app">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container">
                <a class="navbar-brand me-auto" href="<?= url('/') ?>">
                    <img src="<?= url('assets/images/logo/logo.png') ?>" alt="Logo" class="d-md-none">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= home_page() ?>">Home</a>
                        </li>
                        <?php if(auth()->check()): ?>
                        <li class="nav-item">
                            <a class="btn btn-link" href="<?= url('login') ?>">My Account</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-link" href="<?= url('login') ?>">Login</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <section class="hero">
            <div class="row">
                <div class="col-lg-6 col-12 order-2 order-md-1 mt-3 mt-md-0">
                    <img src="<?= url('assets/images/logo/logo.png') ?>" alt="Logo" style="width: 300px;">
                    <form method="get" action="<?= url('track') ?>">
                        <div class="input-group mt-3">
                                <input type="text" name="number" class="form-control form-control-lg" placeholder="Enter your tracking number" aria-label="Enter your tracking number" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" id="button-addon2">Track my Order</button>
                        </div>
                    </form>
                    <h1 class='pt-3'>Welcome to the City Freight Gate smart freight management system!</h1>
                    <p class='fs-5 mt-3'>Transport your goods with peace of mind. Register your account to get started!</p>
                    <a href="<?= url('register') ?>" class="btn btn-outline-primary">Customer Registration</a>
                    <a href="<?= url('driver/register') ?>" class="btn btn-outline-primary">Driver Registration</a>
                </div>
                <div class="col-lg-6 col-12 order-1 order-md-2">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?= url('assets/images/samples/truck_1.jpg') ?>" class="d-block w-100"
                                     alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="<?= url('assets/images/samples/truck_2.jpg') ?>" class="d-block w-100"
                                     alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="<?= url('assets/images/samples/truck_3.jpg') ?>" class="d-block w-100"
                                     alt="...">
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