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
class DriverOrdersController extends Controller
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
        $this->guard(['driver']);
        $orders = $this->order->getActiveOrdersByDriverId(auth()->user_id());
        view('driver/orders/index', compact('orders'));
    }

    public function completed()
    {
        $this->guard(['driver']);
        $orders = $this->order->getCompletedOrdersByDriverId(auth()->user_id());
        view('driver/orders/index', compact('orders'));
    }

    /**
     * Edit an existing order.
     */
    public function show()
    {
        $this->guard(['driver']);
        if (request()->has('id')) {
            $order = $this->order->getById(request()->get('id'));
            if (empty($order)) {
                view('404');
                return;
            }
            if ($order['driver_id'] !== auth()->user_id()) {
                view('403');
                return;
            }
            $statusList = (new OrderStatus())->all();
            $driverStatusList = array_filter($statusList, function ($status) {
                return (!in_array($status['os_id'], [ORDER_STATUS_PENDING, ORDER_STATUS_OUT_FOR_PICKUP, ORDER_STATUS_CONFIRMED, ORDER_STATUS_COMPLETED, ORDER_STATUS_CANCELLED]));
            });
            view('driver/orders/show', compact('order', 'driverStatusList'));
        } else {
            redirect('driver/orders');
        }
    }

    /**
     * Update the status of the order in database.
     */
    public function update()
    {
        $this->guard(['driver']);

        $data = $this->request->validate([
            'order_id' => ['required', 'integer'],
            'order_status_id' => ['required', 'integer'],
            'comments' => ['string']
        ]);

        $status = $this->order->updateStatusById($data['order_id'], [
            'order_status_id' => $data['order_status_id'],
            'comments' => $data['comments']
        ]);

        if ($status) {
            EventLogger::log($data['order_id'], $data['order_status_id']);
            session()->flash(['success' => 'Order Status Updated!']);
        }

        redirect('driver/orders');
    }
}
