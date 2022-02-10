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
                                <h3>Feedbacks</h3>
                                <p class="text-subtitle text-muted">Read feedback from customers.</p>
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
                                    <table class="table table-bordered" id="table1">
                                        <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th class="w-75">Feedback</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($feedbacks as $feedback): ?>
                                            <tr>
                                                <td><?= $feedback['name'] ?></td>
                                                <td><?= $feedback['content'] ?></td>
                                                <td>
                                                    <form action="<?= url('feedbacks/delete') ?>" method="post">
                                                        <input name="id" type="hidden" value="<?= $feedback['id'] ?>">
                                                        <button class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
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

    <script src="<?= url('assets/vendors/simple-datatables/simple-datatables.js') ?>"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="<?= url('assets/js/main.js') ?>"></script>
    </body>

<?php vinclude('layout/footer') ?>