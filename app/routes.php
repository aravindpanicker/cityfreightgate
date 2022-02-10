<?php

/**
 * Read about HTTP Methods here: https://www.w3schools.com/tags/ref_httpmethods.asp
 * We are using get & post in this project.
 *
 * Refer core/Router.php to see how the router works!
 */

/**
 * Home Page
 */
$router->get('', 'PagesController@home');

/**
 * Authentication Routes.
 */
$router->get('login', 'LoginController@index');
$router->post('login', 'LoginController@login');
$router->post('logout', 'LoginController@logout');

/**
 * Registration Routes.
 */
$router->get('register', 'RegistrationController@customer');
$router->get('driver/register', 'RegistrationController@driver');
$router->post('register', 'RegistrationController@register');

/**
 * Tracking Route
 */
$router->get('track', 'TrackingController@index');

/**
 * Welcome Page for registered users.
 */
$router->get('welcome', 'PagesController@welcome');

/**
 * Dashboard Route
 */
$router->get('dashboard', 'DashboardController@index');

/**
 * User Management Routes
 */
$router->post('users/activate', 'UsersController@activate');
$router->post('users/deactivate', 'UsersController@deactivate');
$router->post('users/delete', 'UsersController@delete');
$router->post('users/reset-password', 'UsersController@resetPassword');

/**
 * Profile Routes
 */
$router->get('profile', 'ProfilesController@index');
$router->post('profile/update', 'ProfilesController@update');

/**
 * Customer Routes
 */
$router->get('customers', 'CustomersController@index');
$router->get('drivers', 'DriversController@index');

/**
 * State Routes
 */
$router->get('states', 'StatesController@index');
$router->get('states/create', 'StatesController@create');
$router->post('states', 'StatesController@store');
$router->get('states/edit', 'StatesController@edit');
$router->post('states/update', 'StatesController@update');
$router->post('states/delete', 'StatesController@delete');

/**
 * City Routes
 */
$router->get('cities', 'CitiesController@index');
$router->get('cities/create', 'CitiesController@create');
$router->post('cities', 'CitiesController@store');
$router->get('cities/edit', 'CitiesController@edit');
$router->post('cities/update', 'CitiesController@update');
$router->post('cities/delete', 'CitiesController@delete');

/**
 * Location Related Routes
 */
$router->get('locations', 'LocationsController@index');
$router->get('locations/create', 'LocationsController@create');
$router->post('locations', 'LocationsController@store');
$router->get('locations/edit', 'LocationsController@edit');
$router->post('locations/update', 'LocationsController@update');
$router->post('locations/delete', 'LocationsController@delete');

/**
 * State Routes
 */
$router->get('faq', 'FaqController@index');
$router->get('faq/create', 'FaqController@create');
$router->post('faq', 'FaqController@store');
$router->get('faq/edit', 'FaqController@edit');
$router->post('faq/update', 'FaqController@update');
$router->post('faq/delete', 'FaqController@delete');

$router->get('faqs', 'FaqController@show');

/**
 * Vehicle Related Routes
 */
$router->get('vehicles', 'VehiclesController@index');
$router->get('vehicles/create', 'VehiclesController@create');
$router->post('vehicles', 'VehiclesController@store');
$router->get('vehicles/edit', 'VehiclesController@edit');
$router->post('vehicles/update', 'VehiclesController@update');
$router->post('vehicles/delete', 'VehiclesController@delete');

/**
 * Vehicle Type Related Routes
 */
$router->get('vehicle-types', 'VehicleTypesController@index');
$router->get('vehicle-types/create', 'VehicleTypesController@create');
$router->post('vehicle-types', 'VehicleTypesController@store');
$router->get('vehicle-types/edit', 'VehicleTypesController@edit');
$router->post('vehicle-types/update', 'VehicleTypesController@update');
$router->post('vehicle-types/delete', 'VehicleTypesController@delete');

/**
 * Order Related Routes
 */
$router->get('orders', 'OrdersController@index');
$router->get('orders/completed', 'OrdersController@completed');
$router->get('orders/create', 'OrdersController@create');
$router->post('orders', 'OrdersController@store');
$router->get('orders/edit', 'OrdersController@edit');
$router->post('orders/update', 'OrdersController@update');
$router->post('orders/delete', 'OrdersController@delete');

/**
 * Payment Related Routes
 */
$router->get('payments', 'PaymentsController@index');
$router->get('payments/create', 'PaymentsController@create');
$router->post('payments', 'PaymentsController@store');
$router->get('payments/show', 'PaymentsController@show');
$router->post('payments/update', 'PaymentsController@update');
$router->post('payments/delete', 'PaymentsController@delete');
$router->post('payments/refund', 'PaymentsController@refund');

/**
 * Feedback Related Routes
 */
$router->get('feedbacks', 'FeedbackController@index');
$router->post('feedbacks/delete', 'FeedbackController@delete');

/**
 * Reports
 */
$router->get('reports/customers', 'ReportsController@customers');
$router->get('reports/drivers', 'ReportsController@drivers');
$router->get('reports/orders', 'ReportsController@orders');
$router->get('reports/orders/completed', 'ReportsController@completedOrders');
$router->get('reports/payments', 'ReportsController@payments');

/**
 * Customer Routes
 */
$router->get('customer/orders', 'CustomerOrdersController@index');
$router->get('customer/orders/completed', 'CustomerOrdersController@completed');
$router->get('customer/orders/show', 'CustomerOrdersController@show');
$router->get('customer/orders/create', 'CustomerOrdersController@create');
$router->post('customer/orders', 'CustomerOrdersController@store');
$router->post('customer/orders/payment', 'CustomerOrdersController@payment');
$router->post('customer/orders/cancel', 'CustomerOrdersController@cancel');
$router->get('customer/payments/collect', 'CustomerPaymentsController@index');
$router->get('customer/invoice', 'CustomerPaymentsController@show');
$router->post('customer/payments', 'CustomerPaymentsController@store');
$router->get('customer/feedback', 'FeedbackController@create');
$router->post('customer/feedback', 'FeedbackController@store');

/**
 * Driver Routes
 */
$router->get('driver/orders', 'DriverOrdersController@index');
$router->get('driver/orders/completed', 'DriverOrdersController@completed');
$router->get('driver/orders/show', 'DriverOrdersController@show');
$router->post('driver/orders/update', 'DriverOrdersController@update');
$router->get('driver/vehicle', 'DriverVehicleController@show');

/**
 * Settings Routes
 */
$router->get('settings', 'SettingsController@index');
$router->post('settings', 'SettingsController@update');

/**
 * Ajax Routes
 *
 * These routes are used for fetching ajax data
 */
$router->post('ajax/cities', 'CitiesController@ajax');
$router->post('ajax/locations', 'LocationsController@ajax');
$router->post('ajax/vehicles', 'VehiclesController@ajax');