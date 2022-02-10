<?php

namespace App\Controllers;

use Exception;

abstract class Controller
{
    protected $request;
    protected string $loginUrl = 'login';
    protected string $homeUrl = 'dashboard';
    protected string $customerHomeUrl = 'customer/orders';
    protected string $driverHomeUrl = 'driver/orders';

    public function __construct()
    {
        $this->request = request();
    }

    public function guard($list = [])
    {
        if (sizeof($list) === 0) {
            return true;
        }

        foreach ($list as $guard) {
            if ($guard === 'auth') {
                if (!auth()->check()) {
                    redirect($this->loginUrl);
                }
            }
            if ($guard === 'admin') {
                if (!auth()->isAdmin()) {
                    return view('403');
                }
            }
            if ($guard === 'customer') {
                if (!auth()->isCustomer()) {
                    return view('403');
                }
            }
            if ($guard === 'driver') {
                if (!auth()->isDriver()) {
                    return view('403');
                }
            }
            if ($guard === 'guest') {
                if (auth()->check()) {
                    if(auth()->isAdmin()) redirect($this->homeUrl);
                    if(auth()->isCustomer()) redirect($this->customerHomeUrl);
                    if(auth()->isDriver()) redirect($this->driverHomeUrl);
                }
            }
        }
    }
}