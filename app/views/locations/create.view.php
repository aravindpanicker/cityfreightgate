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
                            <h3>Add Location</h3>
                            <p class="text-subtitle text-muted">Add a new service location</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= url('dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="<?= url('locations') ?>">Locations</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Location</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="<?= url('locations') ?>" class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="state_id" class="form-label">State</label>
                                                <select id="state" class="form-select <?php if(error('state')) echo 'is-invalid'; ?>">
                                                    <option value="">Select State</option>
                                                    <?php foreach ($states as $state): ?>
                                                        <option value="<?= $state['state_id'] ?>"><?= $state['state_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="city_id" class="form-label">City</label>
                                                <select id="city" name="city_id" class="form-select <?php if(error('city_id')) echo 'is-invalid'; ?>">
                                                    <option value="">Select City</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="location_name" class="form-label">Location</label>
                                                <input type="text" name="location_name" class="form-control <?php if(error('location_name')) echo 'is-invalid'; ?>"
                                                       placeholder="Enter name of the location">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Save</button>
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

<script type="application/javascript">
    /**
     * Reference
     *
     * Event Listener: https://www.w3schools.com/jsref/met_document_addeventlistener.asp
     * Js Fetch: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
     */
    const stateDropdown = document.querySelector('#state');
    const cityDropdown = document.querySelector('#city');

    stateDropdown.addEventListener('change', function() {
        const stateId = this.value;
        const formData = new FormData();
        cityDropdown.disabled = true;
        formData.append('stateId', stateId);
        fetch('<?= url("ajax/cities") ?>', {
            method: 'POST',
            body: formData,
        }).then(response => response.json())
            .then(data => {
                const items = [];
                items.push('<option value="">Select City</option>');
                data.map(city => {
                    items.push('<option value="' + city.city_id + '">' + city.city_name + '</option>')
                })
                cityDropdown.innerHTML = items.join('');
                cityDropdown.disabled = false;
            });
    });
</script>

<script src="<?= url('assets/js/main.js') ?>"></script>
</body>

<?php vinclude('layout/footer') ?>