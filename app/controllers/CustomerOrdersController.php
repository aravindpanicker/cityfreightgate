<?php

namespace App\Controllers;

use App\Models\Customer;
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
class CustomerOrdersController extends Controller
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
        $this->guard(['customer']);
        $orders = $this->order->getActiveOrdersByUserId(auth()->user_id());
        view('customers/orders/index', compact('orders'));
    }

    public function completed()
    {
        $this->guard(['customer']);
        $orders = $this->order->getCompletedOrdersByUserId(auth()->user_id());
        view('customers/orders/index', compact('orders'));
    }

    /**
     * Edit an existing order.
     */
    public function show()
    {
        $this->guard(['customer']);
        if (request()->has('id')) {
            $order = $this->order->getById(request()->get('id'));
            if (empty($order)) {
                view('404');
                return;
            }
            if ($order['user_id'] !== auth()->user_id()) {
                view('403');
                return;
            }
            $orderStatuses = (new OrderStatus())->all();
            $vehicleTypes = (new VehicleType())->all();
            $vehicles = (new Vehicle())->getByVehicleTypeId($order['vehicle_type_id']);
            $locations = (new Location())->all();
            $customers = (new Customer())->all();
            $payment = (new Payment())->getByOrderId($order['order_id']);
            $events = (new OrderTracking())->getById($order['order_id']);
            $driver = ($order['driver_id']) ? (new User())->getById($order['driver_id']) : ['name' => 'Not Assigned', 'phone' => 'Not Available'];
            view('customers/orders/show', compact('order', 'vehicleTypes', 'locations', 'customers', 'vehicles', 'orderStatuses', 'payment', 'events', 'driver'));
        } else {
            redirect('orders');
        }
    }

    /**
     * Show order creation form
     */
    public function create()
    {
        $this->guard(['customer']);
        $vehicleTypes = (new VehicleType())->all();
        $locations = (new Location())->all();
        view('customers/orders/create', compact('vehicleTypes', 'locations'));
    }

    /**
     * Store new order in the database.
     */
    public function store()
    {
        $this->guard(['customer']);

        $data = $this->request->validate([
            'vehicle_type_id' => ['required', 'integer'],
            'pickup_location_id' => ['required', 'integer'],
            'drop_location_id' => ['required', 'integer'],
            'pickup_date' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'description' => ['string'],
        ]);

        $data['user_id'] = auth()->user_id();
        $data['order_status_id'] = ORDER_STATUS_PENDING;
        $data['order_date'] = date('Y-m-d');
        $data['comments'] = '';

        if ($this->order->create($data)) {
            session()->set('order_id', $this->order->getLastInsertId());
            session()->set('amount', $data['amount']);
            session()->flash(['success' => 'Order Created!']);
        }

        redirect('customer/payments/collect');
    }

    /**
     * Delete an existing order.
     */
    public function delete()
    {
        $this->guard(['customer']);
        if (request()->has('order_id')) {
            $status = $this->order->deleteById(request()->get('order_id'));
            if ($status) {
                session()->flash(['success' => 'Order Deleted!']);
            }
        }
        redirect_back();
    }

    public function cancel()
    {
        $this->guard(['customer']);
        if (request()->has('order_id')) {
            $payment = (new Payment())->getByOrderId(request()->has('order_id'));
            if (!$payment) {
                if ($this->order->cancelOrderById(request()->get('order_id'))) {
                    session()->flash(['success' => 'Order Canceled!']);
                }
            }
            if ($payment['payment_status_id'] === PAYMENT_STATUS_SUCCESS) {
                (new Payment())->refund(request()->get('payment_id'));
                session()->flash(['success' => 'Order Canceled!']);
            }
            redirect('customer/orders');
        }
    }

    public function payment()
    {
        $this->guard(['customer']);

        $data = $this->request->validate([
            'order_id' => ['required', 'integer'],
            'amount' => ['required', 'numeric']
        ]);

        if (!$data) {
            redirect_back();
        }

        session()->set('order_id', $data['order_id']);
        session()->set('amount', $data['amount']);

        redirect('customer/payments/collect');
    }
}
