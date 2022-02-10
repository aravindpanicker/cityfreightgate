<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->guard(['admin']);
    }

    /**
     * Show all users.
     */
    public function index()
    {
        $order = new Order();
        $orders = $order->all();
        $statistics = [
            'order_count' => $order->getCount(),
            'customer_count' => (new Customer())->getCount(),
            'vehicle_count' => (new Vehicle())->getCount(),
            'driver_count' => (new Driver())->getCount()
        ];
        return view('dashboard', compact('orders', 'statistics'));
    }
}
