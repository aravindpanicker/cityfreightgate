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
 * Class OrdersController
 * @package App\Controllers
 */
class OrdersController extends Controller
{
    /**
     * @var order
     */
    private Order $order;

    /**
     * OrdersController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->order = (new Order());
    }

    /**
     * Show all orders
     */
    public function index()
    {
        $this->guard(['admin']);
        $orders = $this->order->all();
        $properties = [
            'report_url' => url('/reports/orders')
        ];
        view('orders/index', compact('orders', 'properties'));
    }

    /**
     * Show all completed orders
     */
    public function completed()
    {
        $this->guard(['admin']);
        $orders = $this->order->completed();
        $properties = [
            'report_url' => url('/reports/orders/completed')
        ];
        view('orders/index', compact('orders', 'properties'));
    }

    /**
     * Show order creation form
     */
    public function create()
    {
        $this->guard(['admin']);
        $vehicleTypes = (new VehicleType())->all();
        $locations = (new Location())->all();
        $customers = (new Customer())->all();
        view('orders/create', compact('vehicleTypes', 'locations', 'customers'));
    }

    /**
     * Store new order in the database.
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'user_id' => ['required', 'integer'],
            'vehicle_type_id' => ['required', 'integer'],
            'vehicle_id' => ['required', 'integer'],
            'pickup_location_id' => ['required', 'integer'],
            'drop_location_id' => ['required', 'integer'],
            'pickup_date' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'comments' => ['string'],
            'description' => ['string'],
        ]);

        $data['order_status_id'] = ORDER_STATUS_PENDING;
        $data['order_date'] = date('Y-m-d');

        if ($this->order->create($data)) {
            session()->flash(['success' => 'Order Created!']);
        }

        redirect('orders');
    }

    /**
     * Edit an existing order.
     */
    public function edit()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $order = $this->order->getById(request()->get('id'));
            if ($order) {
                $orderStatuses = (new OrderStatus())->all();
                $vehicleTypes = (new VehicleType())->all();
                $vehicles = (new Vehicle())->getByVehicleTypeId($order['vehicle_type_id']);
                $locations = (new Location())->all();
                $customers = (new Customer())->all();
                $payment = (new Payment())->getByOrderId($order['order_id']);
                $events = (new OrderTracking())->getById($order['order_id']);
                $driver = ($order['driver_id']) ? (new User())->getById($order['driver_id']) : ['name' => 'Not Assigned', 'phone' => 'Not Available'];
                view('orders/edit', compact('order', 'vehicleTypes', 'locations', 'customers', 'vehicles', 'orderStatuses', 'payment', 'events', 'driver'));
            } else {
                view('404');
            }
        } else {
            redirect('orders');
        }
    }

    /**
     * Update an existing order.
     */
    public function update()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'order_id' => ['required', 'integer'],
            'vehicle_id' => ['required', 'integer'],
            'order_status_id' => ['required', 'integer'],
            'comments' => ['string'],
        ]);

        $status = $this->order->updateById($data['order_id'], [
            'vehicle_id' => $data['vehicle_id'],
            'order_status_id' => $data['order_status_id'],
            'comments' => $data['comments']
        ]);

        if ($status) {
            EventLogger::log($data['order_id'], $data['order_status_id']);
            session()->flash(['success' => 'Order Updated!']);
        }

        redirect('orders');
    }

    /**
     * Delete an existing order.
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('order_id')) {
            $status = $this->order->deleteById(request()->get('order_id'));
            if ($status) {
                session()->flash(['success' => 'Order Deleted!']);
            }
        }
        redirect_back();
    }
}
