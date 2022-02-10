<?php

namespace App\Controllers;

use App\Models\Customer;

class CustomersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->guard(['admin']);
    }

    /**
     * Show all customers.
     */
    public function index()
    {
        $customers = (new Customer())->all();
        $header = [
            'title' => 'Customers',
            'description' => 'View all registered customers.',
            'report_url' => url('reports/customers'),
        ];
        return view('customers', compact('customers', 'header'));
    }
}
