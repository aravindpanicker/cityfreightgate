<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Location;
use App\Models\State;
use App\Models\User;

/**
 * Class RegistrationController
 * @package App\Controllers
 */
class RegistrationController extends Controller
{
    /**
     * Show Customer Registration Form
     *
     * @return mixed
     * @throws \Exception
     */
    public function customer()
    {
        $this->guard(['guest']);

        $states = (new State)->all();
        $cities = [];
        $locations = [];

        if(old('state')) {
            $cities = (new City)->getCitiesByStateId(old('state'));
        }
        
        if(old('city')) {
            $locations = (new Location)->getLocationsByCityId(old('city'));
        }

        session()->set('role_id', ROLE_CUSTOMER);
        return view('auth/registration', compact('states', 'cities', 'locations'));
    }

    /**
     * Show Driver Registration Form
     *
     * @return mixed
     * @throws \Exception
     */
    public function driver()
    {
        $this->guard(['guest']);

        $states = (new State)->all();
        $cities = [];
        $locations = [];

        if(old('state')) {
            $cities = (new City)->getCitiesByStateId(old('state'));
        }

        if(old('city')) {
            $locations = (new Location)->getLocationsByCityId(old('city'));
        }
        
        session()->set('role_id', ROLE_DRIVER);
        return view('auth/driver_registration', compact('states', 'cities', 'locations'));
    }

    /**
     * Register a new customer or driver
     *
     * @throws \Exception
     */
    public function register()
    {
        $this->guard(['guest']);
        $data = $this->request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirm'],
            'phone' => ['required', 'phone'],
            'address' => ['required', 'string'],
            'state' => ['required', 'integer'],
            'city' => ['required', 'integer'],
            'location' => ['required', 'integer'],
        ]);

        if ($data) {
            $data['role_id'] = session()->get('role_id');
            $data['user_status'] = USER_STATUS_INACTIVE;
            $data['reg_date'] = date('Y-m-d');

            unset($data['password_confirm']);
            session()->forget('role_id');

            $user = (new User)->create($data);

            if ($user) {
                redirect('welcome');
            }

        } else {
            redirect('register');
        }
    }
}