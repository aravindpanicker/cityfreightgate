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
                            <h3>Edit City</h3>
                            <p class="text-subtitle text-muted">Edit City</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= url('cities') ?>">Cities</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit City</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?= url('cities/update') ?>" class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <input name="id" type="hidden" value="<?= $city['city_id'] ?>">
                                            <div class="form-group">
                                                <label for="state_id" class="form-label">State</label>
                                                <select name="state_id" class="form-select <?php if(error('state_id')) echo 'is-invalid'; ?>">
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?= $state['state_id'] ?>" <?php if($state['state_id'] === $city['state_id']) echo 'selected="selected"' ?>><?= $state['state_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="city_name" class="form-label">Name</label>
                                                <input type="text" name="city_name" value="<?= $city['city_name'] ?>" class="form-control <?php if(error('city_name')) echo 'is-invalid'; ?>"
                                                       placeholder="Enter name of the State">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
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