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
                                <h3>Settings</h3>
                                <p class="text-subtitle text-muted">General Settings</p>
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <?= alert() ?>
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form method="post" action="<?= url('settings') ?>" class="form form-vertical">
                                        <div class="form-body">
                                            <input type="hidden" name="settings_id"
                                                   value="<?= $settings['settings_id'] ?>">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="company_name" class="form-label">Company Name</label>
                                                    <input type="text" id="company_name" name="company_name"
                                                           value="<?= $settings['company_name'] ?>"
                                                           class="form-control <?php if (error('company_name')) echo 'is-invalid'; ?>"
                                                           placeholder="Enter your company name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email"
                                                           value="<?= $settings['email'] ?>"
                                                           class="form-control <?php if (error('email')) echo 'is-invalid'; ?>"
                                                           placeholder="Email">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" id="address" name="address"
                                                           value="<?= $settings['address'] ?>"
                                                           class="form-control <?php if (error('address')) echo 'is-invalid'; ?>"
                                                           placeholder="Enter company address">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="primary_phone" class="form-label">Primary Phone</label>
                                                    <input type="text" id="primary_phone" name="primary_phone"
                                                           value="<?= $settings['primary_phone'] ?>"
                                                           class="form-control <?php if (error('primary_phone')) echo 'is-invalid'; ?>"
                                                           placeholder="Primary Phone">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input type="text" id="mobile" name="mobile"
                                                           value="<?= $settings['mobile'] ?>"
                                                           class="form-control <?php if (error('mobile')) echo 'is-invalid'; ?>"
                                                           placeholder="Mobile Number">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="terms" class="form-label">Terms & Conditions</label>
                                                    <textarea name="terms" id="terms" cols="30" rows="5"
                                                              class="form-control <?php if (error('terms')) echo 'is-invalid'; ?>"
                                                    ><?= $settings['terms'] ?></textarea>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update
                                                        Profile
                                                    </button>
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