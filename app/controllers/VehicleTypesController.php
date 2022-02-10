<?php

namespace App\Controllers;

use App\Models\VehicleType;

/**
 * Class vehiclesController
 * @package App\Controllers
 */
class VehicleTypesController extends Controller
{
    /**
     * @var VehicleType
     */
    private VehicleType $vehicleType;

    /**
     * vehiclesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->vehicleType = (new VehicleType());
    }

    /**
     * Show all cities
     */
    public function index()
    {
        $this->guard(['admin']);
        $vehicleTypes = $this->vehicleType->all();
        view('vehicle_types/index', compact('vehicleTypes'));
    }

    /**
     * Show vehicle creation page
     */
    public function create()
    {
        $this->guard(['admin']);
        $vehicleTypes = (new VehicleType())->all();
        view('vehicle_types/create', compact('vehicleTypes'));
    }

    /**
     * Store vehicle in the database.
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'vt_name' => ['required', 'string'],
            'km_rate' => ['required', 'integer']
        ]);

        if ($this->vehicleType->create($data)) {
            session()->flash(['success' => 'Vehicle Type Saved!']);
        }

        redirect('vehicle-types');
    }

    /**
     * Edit an existing vehicle.
     */
    public function edit()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $vehicleType = $this->vehicleType->getById(request()->get('id'));
            if ($vehicleType) {
                view('vehicle_types/edit', compact('vehicleType'));
            } else {
                view('404');
            }
        } else {
            view('404');
        }
    }

    /**
     * Update an existing vehicle.
     */
    public function update()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'vt_id' => ['required', 'integer'],
            'vt_name' => ['required', 'string'],
            'km_rate' => ['required', 'numeric']
        ]);

        $status = $this->vehicleType->updateById($data['vt_id'], [
            'vt_name' => $data['vt_name'],
            'km_rate' => $data['km_rate']
        ]);

        if ($status) {
            session()->flash(['success' => 'Vehicle Type Updated!']);
        }

        redirect('vehicle-types');
    }

    /**
     * Delete an existing vehicle.
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('vt_id')) {
            $status = $this->vehicleType->deleteById(request()->get('vt_id'));
            if($status) {
                session()->flash(['success' => 'Vehicle Type Removed!']);
            }
        }
        redirect('vehicle-types');
    }
}
