<?php

namespace App\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\VehicleType;

/**
 * Class vehiclesController
 * @package App\Controllers
 */
class VehiclesController extends Controller
{
    /**
     * @var vehicle
     */
    private Vehicle $vehicle;

    /**
     * vehiclesController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->vehicle = (new vehicle());
    }

    /**
     * Show all cities
     */
    public function index()
    {
        $this->guard(['admin']);
        $vehicles = $this->vehicle->all();
        view('vehicles/index', compact('vehicles'));
    }

    /**
     * Show vehicle creation page
     */
    public function create()
    {
        $this->guard(['admin']);
        $vehicleTypes = (new VehicleType())->all();
        $vehicleStatuses = (new VehicleStatus())->all();
        $drivers = (new Driver())->getAvailableDrivers();
        view('vehicles/create', compact('vehicleTypes', 'drivers', 'vehicleStatuses'));
    }

    /**
     * Store vehicle in the database.
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'vehicle_type_id' => ['required', 'integer'],
            'driver_id' => ['required', 'integer'],
            'vehicle_status_id' => ['required', 'integer'],
            'vehicle_name' => ['required', 'string'],
            'reg_number' => ['required', 'string'],
        ]);

        if ($this->vehicle->create($data)) {
            session()->flash(['success' => "Vehicle Saved!"]);
        }

        redirect('vehicles');
    }

    /**
     * Edit an existing vehicle.
     */
    public function edit()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $vehicle = $this->vehicle->getById(request()->get('id'));
            $vehicleTypes = (new VehicleType())->all();
            $vehicleStatuses = (new VehicleStatus())->all();
            $drivers = (new Driver())->getAvailableDrivers();
            if ($vehicle) {
                view('vehicles/edit', compact('vehicle', 'vehicleTypes', 'vehicleStatuses', 'drivers'));
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
            'vehicle_id' => ['required', 'integer'],
            'vehicle_type_id' => ['required', 'integer'],
            'driver_id' => ['required', 'integer'],
            'vehicle_status_id' => ['required', 'integer'],
            'vehicle_name' => ['required', 'string'],
            'reg_number' => ['required', 'string'],
        ]);

        $status = $this->vehicle->updateById($data['vehicle_id'], [
            'vehicle_type_id' => $data['vehicle_type_id'],
            'driver_id' => $data['driver_id'],
            'vehicle_status_id' => $data['vehicle_status_id'],
            'vehicle_name' => $data['vehicle_name'],
            'reg_number' => $data['reg_number']
        ]);

        if ($status) {
            session()->flash(['success' => "Vehicle information has been updated!"]);
        }

        redirect('vehicles');
    }

    /**
     * Delete an existing vehicle.
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('vehicle_id')) {
            $status = $this->vehicle->deleteById(request()->get('vehicle_id'));
            if($status) {
                session()->flash(['success' => "Vehicle Removed!"]);
            }
        }
        redirect('vehicles');
    }

    public function ajax()
    {
        $vehicles = [];
        if (request()->has('vehicleTypId')) {
            $vehicles = $this->vehicle->getByVehicleTypeId(request()->get('vehicleTypId'));
        }
        json($vehicles);
    }
}
