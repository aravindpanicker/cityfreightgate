<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - <?= app_name() ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= url('assets/css/pages/error.css') ?>">
</head>

<body>
<div id="error">
    <div class="error-page container">
        <div class="col-md-6 col-12 offset-md-3">
            <img class="img-error" src="<?= url('assets/images/error-403.svg') ?>" alt="Not Found">
            <div class="text-center">
                <p class='fs-5 text-gray-600'>403 Forbidden. You don't have the permission to access this resource.</p>
                <a href="<?= home_page() ?>" class="btn btn-lg btn-link mt-3">Go back to the home page</a>
            </div>
        </div>
    </div>
</div>
</body>

</html>