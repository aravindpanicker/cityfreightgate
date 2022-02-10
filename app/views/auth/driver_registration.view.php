<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Registration - <?= app_name() ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/css/pages/auth.css') ?>">
</head>

<body>
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-6 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="<?= home_page() ?>"><img src="<?= url('assets/images/logo/logo.png') ?>" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Driver Registration</h1>
                <p class="auth-subtitle mb-5">Input your data to register your account.</p>

                <form action="<?= url('register') ?>" method="post">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" name="name" value="<?= old('name') ?>" class="form-control form-control-xl <?php if(error('name')) echo 'is-invalid'; ?>" placeholder="Full Name" required>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" name="email" value="<?= old('email') ?>" class="form-control form-control-xl <?php if(error('email')) echo 'is-invalid'; ?>" placeholder="Username (Email)" required>
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password" class="form-control form-control-xl <?php if(error('password')) echo 'is-invalid'; ?>" placeholder="Password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password_confirm" class="form-control form-control-xl <?php if(error('password')) echo 'is-invalid'; ?>" placeholder="Confirm Password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" name="phone" value="<?= old('phone') ?>" class="form-control form-control-xl <?php if(error('phone')) echo 'is-invalid'; ?>" placeholder="Phone" required>
                        <div class="form-control-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" name="address" value="<?= old('address') ?>" class="form-control form-control-xl <?php if(error('address')) echo 'is-invalid'; ?>" placeholder="Address" required>
                        <div class="form-control-icon">
                            <i class="bi bi-house"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <fieldset class="form-group">
                            <select name="state" class="form-select form-control form-control-xl <?php if(error('state')) echo 'is-invalid'; ?>" id="state" required>
                                <option>State</option>
                                <?php foreach ($states as $state): ?>
                                <option value="<?= $state['state_id'] ?>" <?php if($state['state_id'] == old('state')): echo 'selected'; endif; ?>><?= $state['state_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                        <div class="form-control-icon">
                            <i class="bi bi-map"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <fieldset class="form-group">
                            <select name="city" class="form-select form-control form-control-xl <?php if(error('city')) echo 'is-invalid'; ?>" id="city" required>
                                <option>City</option>
                                <?php foreach ($cities as $city): ?>
                                <option value="<?= $city['city_id'] ?>" <?php if($city['city_id'] == old('city')): echo 'selected'; endif; ?>><?= $city['city_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                        <div class="form-control-icon">
                            <i class="bi bi-pin-angle"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <fieldset class="form-group">
                            <select name="location" class="form-select form-control form-control-xl <?php if(error('location')) echo 'is-invalid'; ?>" id="location" required>
                                <option>Location</option>
                                <?php foreach ($locations as $location): ?>
                                <option value="<?= $location['location_id'] ?>" <?php if($location['location_id'] == old('location')): echo 'selected'; endif; ?>><?= $location['location_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                        <div class="form-control-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Already have an account?
                        <a href="<?php echo url('login') ?>" class="font-bold">Log in</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

    <script type="application/javascript">
        /**
         * Reference
         *
         * Event Listener: https://www.w3schools.com/jsref/met_document_addeventlistener.asp
         * Js Fetch: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
         */
        const stateDropdown = document.querySelector('#state');
        const cityDropdown = document.querySelector('#city');
        const locationDropdown = document.querySelector('#location');

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
                items.push('<option value="">City</option>');
                data.map(city => {
                    items.push('<option value="' + city.city_id + '">' + city.city_name + '</option>')
                })
                cityDropdown.innerHTML = items.join('');
                cityDropdown.disabled = false;
            });
        });

        cityDropdown.addEventListener('change', function() {
            if(this.value === '') return false;
            const cityId = this.value;
            const formData = new FormData();
            locationDropdown.disabled = true;
            formData.append('cityId', cityId);
            fetch('<?= url("ajax/locations") ?>', {
                method: 'POST',
                body: formData,
            }).then(response => response.json())
                .then(data => {
                    const items = [];
                    items.push('<option value="">Location</option>');
                    data.map(location => {
                        items.push('<option value="' + location.location_id + '">' + location.location_name + '</option>')
                    })
                    locationDropdown.innerHTML = items.join('');
                    locationDropdown.disabled = false;
                });
        });
    </script>

</div>
</body>

</html>