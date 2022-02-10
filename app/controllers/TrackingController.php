<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderTracking;

class TrackingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show all customers.
     */
    public function index()
    {
        $data = $this->request->validate([
            'number' => ['required', 'numeric']
        ]);

        if($data) {
            $order = (new Order())->getById($data['number']);
            $events = (new OrderTracking())->getById($data['number']);
            return view('tracking', compact('order', 'events'));
        }

        redirect_back();
    }
}
