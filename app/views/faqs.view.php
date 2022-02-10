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
                                <h3>FAQ</h3>
                                <p class="text-subtitle text-muted">Manage Frequently Asked Questions & Answers.</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                            </div>
                        </div>
                    </div>
                    <section class="section">
                        <?= alert() ?>
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <?php foreach ($faqs as $faq): ?>
                                        <h3><?= $faq['question'] ?></h3>
                                        <p><?= $faq['answer'] ?></p>
                                    <?php endforeach; ?>
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