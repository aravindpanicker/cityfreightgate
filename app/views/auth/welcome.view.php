<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?= app_name() ?></title>
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
                <h1 class="auth-title">Welcome to City Freight Gate!</h1>
                <p class="auth-subtitle mb-5">Your account has been successfully registered! Please Click the link below to login to
                the user portal.</p>

                <div class="mt-5 text-lg fs-4">
                    <p class='text-gray-600'>
                        <a href="<?= url('login') ?>" class="font-bold">Log in to my account</a>
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