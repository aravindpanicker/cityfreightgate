<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Location;
use App\Models\State;

class LocationsController extends Controller
{
    /**
     * @var Location
     */
    private Location $location;

    /**
     * LocationsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->location = (new Location());
    }

    /**
     * Show all locations.
     */
    public function index()
    {
        $this->guard(['admin']);
        $locations = $this->location->all();
        view('locations/index', compact('locations'));
    }

    /**
     * Show location creation form
     */
    public function create()
    {
        $this->guard(['admin']);
        $states = (new State())->all();
        return view('locations/create', compact('states'));
    }

    /**
     * Save a new location
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'city_id' => ['required', 'numeric'],
            'location_name' => ['required', 'string'],
        ]);

        if ($this->location->create($data)) {
            session()->flash(['success' => "Location Saved!"]);
        }

        redirect('locations');
    }

    /**
     * Edit location
     */
    public function edit()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $location = $this->location->getById(request()->get('id'));
            $cities = (new City())->getCitiesByStateId($location['state_id']);
            $states = (new State())->all();
            if ($location) {
                $states = (new State())->all();
                view('locations/edit', compact('location', 'states', 'cities'));
            } else {
                view('404');
            }
        } else {
            view('404');
        }
    }

    /**
     * Update location
     */
    public function update()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'location_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'location_name' => ['required', 'string'],
        ]);

        $status = $this->location->updateById($data['location_id'], [
            'city_id' => $data['city_id'],
            'location_name' => $data['location_name']
        ]);

        if ($status) {
            session()->flash(['success' => "Location Updated!"]);
        }

        redirect('locations');
    }

    /**
     * Delete location from the database
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('location_id')) {
            $status = $this->location->deleteById(request()->get('location_id'));
            if ($status) {
                session()->flash(['success' => "Location Removed!"]);
            }
        }
        redirect('locations');
    }

    /**
     * Show all users.
     */
    public function ajax()
    {
        if (request()->has('cityId')) {
            $locations = $this->location->getLocationsByCityId(request()->get('cityId'));
            json($locations);
        }
    }
}
