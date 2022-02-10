<?php

namespace App\Controllers;

use Exception;

class LoginController extends Controller
{
    /**
     * Show Login form
     *
     * @return mixed
     */
    public function index()
    {
        $this->guard(['guest']);
        return view('auth/login');
    }


    /**
     * Attempt login
     *
     * @throws Exception
     */
    public function login()
    {
        $data = $this->request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($data['email'], $data['password'])) {
            session()->clean();

            if(auth()->isDriver()) {
                $this->homeUrl = 'driver/orders';
            }

            if(auth()->isCustomer()) {
                $this->homeUrl = 'customer/orders';
            }

            redirect($this->homeUrl);
        } else {
            session()->set('_form', [
                'email' => 'Invalid Username / Password'
            ]);
            session()->set('_old', [
                'email' => $data['email']
            ]);
            redirect($this->loginUrl);
        }
    }

    /**
     * Logout authenticated user
     *
     * @throws Exception
     */
    public function logout()
    {
        auth()->logout();
        redirect($this->loginUrl);
    }
}