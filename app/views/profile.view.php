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
                            <h3>Profile</h3>
                            <p class="text-subtitle text-muted">Edit Profile</p>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <?= alert() ?>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form method="post" action="<?= url('profile/update') ?>" class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Full Name</label>
                                                    <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control <?php if(error('name')) echo 'is-invalid'; ?>"
                                                           placeholder="Enter your full name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="number" name="phone" value="<?= $user['phone'] ?>" class="form-control <?php if(error('phone')) echo 'is-invalid'; ?>"
                                                           placeholder="Enter your phone number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone" class="form-label">Address</label>
                                                    <input type="text" name="address" value="<?= $user['address'] ?>" class="form-control <?php if(error('address')) echo 'is-invalid'; ?>"
                                                           placeholder="Enter your address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="state_id" class="form-label">State</label>
                                                    <select name="state_id" id="state" class="form-select <?php if(error('state_id')) echo 'is-invalid'; ?>">
                                                        <option value="">Select City</option>
                                                        <?php foreach ($states as $state): ?>
                                                            <option value="<?= $state['state_id'] ?>" <?php if($state['state_id'] === $user['state_id']) echo 'selected' ?>><?= $state['state_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="city_id" class="form-label">City</label>
                                                    <select id="city" name="city_id" class="form-select <?php if(error('city_id')) echo 'is-invalid'; ?>">
                                                        <option value="">Select City</option>
                                                        <?php foreach ($cities as $city): ?>
                                                            <option value="<?= $city['city_id'] ?>" <?php if($city['city_id'] === $user['city_id']) echo 'selected' ?>><?= $city['city_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="location_id" class="form-label">Location</label>
                                                    <select id="location" name="location_id" class="form-select <?php if(error('location_id')) echo 'is-invalid'; ?>">
                                                        <option value="">Select Location</option>
                                                        <?php foreach ($locations as $location): ?>
                                                            <option value="<?= $location['location_id'] ?>" <?php if($location['location_id'] === $user['location_id']) echo 'selected' ?>><?= $location['location_name'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

<script src="<?= url('assets/js/main.js') ?>"></script>
</body>

<?php vinclude('layout/footer') ?>