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
                                <h3>FAQ</h3>
                                <p class="text-subtitle text-muted">Create a new Frequency Asked Question & Answer.</p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?= url('faq') ?>">FAQ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create FAQ</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="<?= url('faq') ?>" class="form form-vertical">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="question" class="form-label">Question</label>
                                                    <textarea name="question"
                                                              id="question"
                                                              class="form-control <?php if(error('question')) echo 'is-invalid'; ?>"
                                                              cols="30" rows="2" placeholder="Enter the question here."></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="answer" class="form-label">Answer</label>
                                                    <textarea name="answer"
                                                              id="answer"
                                                              class="form-control <?php if(error('answer')) echo 'is-invalid'; ?>"
                                                              cols="30" rows="5" placeholder="Enter the answer here."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit
                                                </button>
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

    <script src="<?= url('assets/vendors/simple-datatables/simple-datatables.js') ?>"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="<?= url('assets/js/main.js') ?>"></script>
    </body>

<?php vinclude('layout/footer') ?>