<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\EventLogger;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderTracking;
use App\Models\Payment;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;

/**
 * Class DriverVehicleController
 * @package App\Controllers
 */
class DriverVehicleController extends Controller
{
    public function show()
    {
        $driverId = auth()->user_id();
        $vehicle = (new Vehicle())->getByDriverId($driverId);
        view('driver/vehicle/info', compact('vehicle'));
    }
}
