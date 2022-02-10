<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Driver;
use App\Models\Order;
use App\Models\Payment;

class ReportsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generate Customer Report
     */
    public function customers()
    {
        $users = (new Customer())->all();
        $properties = [
            'title' => 'Customer Report',
        ];
        return view('reports/users', compact('users', 'properties'));
    }

    /**
     * Generate Customer Report
     */
    public function drivers()
    {
        $users = (new Driver())->all();
        $properties = [
            'title' => 'Driver Report',
        ];
        return view('reports/users', compact('users', 'properties'));
    }

    /**
     * Generate active orders report
     */
    public function orders()
    {
        $orders = (new Order())->all();
        $properties = [
            'title' => 'Active Orders Report',
        ];
        return view('reports/orders', compact('orders', 'properties'));
    }

    /**
     * Generate completed orders report
     */
    public function completedOrders()
    {
        $orders = (new Order())->completed();
        $properties = [
            'title' => 'Completed Orders Report',
        ];
        return view('reports/orders', compact('orders', 'properties'));
    }

    /**
     * Generate payments report
     */
    public function payments()
    {
        $payments = (new Payment())->all();
        $properties = [
            'title' => 'Payments Report',
        ];
        return view('reports/payments', compact('payments', 'properties'));
    }
}
