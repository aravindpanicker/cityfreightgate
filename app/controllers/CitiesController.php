<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\State;

/**
 * Class CitiesController
 * @package App\Controllers
 */
class CitiesController extends Controller
{
    /**
     * @var City
     */
    private City $city;

    /**
     * CitiesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->city = (new City());
    }

    /**
     * Show all cities.
     */
    public function index()
    {
        $this->guard(['admin']);
        $cities = $this->city->all();
        view('cities/index', compact('cities'));
    }

    /**
     * Show a form for creating new city
     */
    public function create()
    {
        $this->guard(['admin']);
        $states = (new State())->all();
        return view('cities/create', compact('states'));
    }

    /**
     * Store a new city to the database
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'state' => ['required', 'numeric'],
            'city_name' => ['required', 'string'],
        ]);

        if ($this->city->create($data)) {
            session()->flash(['success' => "City Saved!"]);
        }

        redirect('cities');
    }

    /**
     * Edit an existing city
     */
    public function edit()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $city = $this->city->getById(request()->get('id'));
            if ($city) {
                $states = (new State())->all();
                view('cities/edit', compact('city', 'states'));
            } else {
                view('404');
            }
        } else {
            view('404');
        }
    }

    /**
     * Update an existing city
     */
    public function update()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'id' => ['required', 'integer'],
            'state_id' => ['required', 'integer'],
            'city_name' => ['required', 'string'],
        ]);

        $status = $this->city->updateById($data['id'], [
            'state_id' => $data['state_id'],
            'name' => $data['city_name']
        ]);

        if ($status) {
            session()->flash(['success' => "City Updated!"]);
        }

        redirect('cities');
    }

    /**
     * Delete City from the database
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('city_id')) {
            $status = $this->city->deleteById(request()->get('city_id'));
            if ($status) {
                session()->flash(['success' => "City Removed!"]);
            }
        }
        redirect('cities');
    }

    /**
     * Get all cities by state id
     */
    public function ajax()
    {
        if (request()->has('stateId')) {
            $cities = $this->city->getCitiesByStateId(request()->get('stateId'));
            json($cities);
        }
    }
}
