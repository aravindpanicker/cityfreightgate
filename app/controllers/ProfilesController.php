<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Location;
use App\Models\State;
use App\Models\User;

/**
 * Class ProfilesController
 * @package App\Controllers
 */
class ProfilesController extends Controller
{
    /**
     * @var user
     */
    private User $user;

    /**
     * ProfilesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = (new User());
    }

    /**
     * Show profile information
     */
    public function index()
    {
        $this->guard(['auth']);
        $user = $this->user->getById(auth()->user_id());
        $states = (new State())->all();
        $cities = (new City())->getCitiesByStateId($user['state_id']);
        $locations = (new Location())->getLocationsByCityId($user['city_id']);

        view('profile', compact('user', 'states', 'cities', 'locations'));
    }

    /**
     * Update profile information
     */
    public function update()
    {
        $this->guard(['auth']);

        $data = $this->request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'state_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'location_id' => ['required', 'integer'],
        ]);

        $status = $this->user->updateById(auth()->user_id(), [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'location_id' => $data['location_id']
        ]);

        if ($status) {
            session()->flash(['success' => "Your profile has been updated!"]);
        }

        redirect_back();
    }
}
