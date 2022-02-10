<?php

use App\Core\App;

/**
 * Render a view file based on the name and data array passed into it.
 */
function view($name, $data = [])
{
    extract($data);

    return require __DIR__ . "./../app/views/{$name}.view.php";
}

/**
 * Get name of the application from the configuration file.
 */
function app_name()
{
    return App::get('config')['app_name'];
}

/**
 * Convert an array into json and return it.
 */
function json($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}

/**
 * Include a view file on another view file.
 */
function vinclude($name)
{
    require __DIR__ . "./../app/views/{$name}.view.php";
}

/**
 * Redirect to a new page.
 */
function redirect(string $path)
{
    header('Location:' . url($path));
    exit;
}

/**
 * Redirect back to the route where the request originated.
 */
function redirect_back()
{
    header('Location:' . $_SERVER['HTTP_REFERER']);
    exit;
}

/**
 * Return an instance of the session object from the application
 * container.
 */
function session()
{
    return App::get('session');
}

/**
 * Return an instance of the authentication object from the
 * application container.
 */
function auth()
{
    return App::get('auth');
}

/**
 * Return an instance of the request object from the
 * application container.
 */
function request()
{
    return App::get('request');
}

/**
 * Get the home page URL from configuration.
 */
function home_page(): string
{
    return rtrim(App::get('config')['app_url'], '/');
}

/**
 * Return URL based on the application URL with optional parameters
 * appended as get params.
 */
function url($url, array $params = []): string
{
    $queryString = sizeof($params) > 0 ? '?' . http_build_query($params) : '';
    return home_page() . '/' . ltrim($url, '/') . $queryString;
}

/**
 * Get old value of an input field. Useful to load data when validation fails.
 */
function old($field, $value = null)
{
    if ($value) {
        return $value;
    }

    if (!session()->has('_old') || sizeof(session()->get('_old')) < 1) {
        return false;
    }

    if (!array_key_exists($field, session()->get('_old'))) {
        return false;
    }

    return session()->get('_old')[$field];
}

/**
 * Return validation error message based on the name of the field given.
 */
function error($field)
{
    if (!$field) {
        return false;
    }

    if (!session()->has('_form') || sizeof(session()->get('_form')) < 1) {
        return false;
    }

    if (!array_key_exists($field, session()->get('_form'))) {
        return false;
    }

    return session()->get('_form')[$field];

}

/**
 * Display an alert message on the screen.
 */
function alert()
{
    if (!is_array(session()->get('_flash'))) return '';
    if (array_key_exists('error', session()->get('_flash'))) {
        return '<div class="alert alert-danger alert-dismissible show fade">
                    ' . session()->get('_flash')['error'] . '
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    if (array_key_exists('success', session()->get('_flash'))) {
        return '<div class="alert alert-success alert-dismissible show fade">
                    ' . session()->get('_flash')['success'] . '
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}

/**
 * Dump contents of an array or string to the screen for debugging.
 */
function dump($data)
{
    if (is_array($data)) {
        print("<pre>" . print_r($data, true) . "</pre>");
        return;
    }
    echo '<pre>' . $data . '</pre>';
}

/**
 * Render the sidebar user interface based on the user type.
 */
function render_sidebar()
{
    if (auth()->isAdmin()) {
        vinclude('components/sidebar');
    }

    if (auth()->isCustomer()) {
        vinclude('components/customer_sidebar');
    }

    if (auth()->isDriver()) {
        vinclude('components/driver_sidebar');
    }

}