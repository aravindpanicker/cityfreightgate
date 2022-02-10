<?php

namespace App\Controllers;

use App\Models\Driver;

class DriversController extends Controller
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
        $customers = (new Driver())->all();
        $header = [
            'title' => 'Drivers',
            'description' => 'View all registered drivers.',
            'report_url' => url('reports/drivers'),
        ];
        return view('customers', compact('customers', 'header'));
    }
}
