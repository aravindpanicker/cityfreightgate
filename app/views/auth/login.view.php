<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?= app_name() ?></title>
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
                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                <form action="<?= url('login') ?>" method="post">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input name="email" type="text" value="<?= old('email') ?>" class="form-control form-control-xl <?php if(error('email')): ?> is-invalid <?php endif; ?>" placeholder="Username" required>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input name="password" type="password" class="form-control form-control-xl" placeholder="Password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
                <div class="text-center mt-5 text-lg fs-5">
                    <p class="text-gray-600">Don't have an account?
                        <a href="<?= url('register') ?>" class="font-bold">Register</a>.
                    </p>
                </div>
                <div class="text-center mt-5 text-lg fs-5c">
                    <p class="text-gray-600">Are you a driver?
                        <a href="<?= url('driver/register') ?>" class="font-bold">Register as a Driver</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>
</body>

</html>