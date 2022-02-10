<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\EventLogger;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use App\Models\Settings;

/**
 * Class PaymentsController
 * @package App\Controllers
 */
class PaymentsController extends Controller
{
    /**
     * @var payment
     */
    private Payment $payment;

    /**
     * PaymentsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->payment = (new Payment());
    }

    /**
     * Show all cities
     */
    public function index()
    {
        $this->guard(['admin']);
        $payments = $this->payment->all();
        view('payments/index', compact('payments'));
    }

    /**
     * Show payment creation page
     */
    public function create()
    {
        $this->guard(['admin']);
        $orders = (new Order())->getAllPaymentPendingOrders();
        $paymentStatuses = (new PaymentStatus())->all();
        $paymentTypes = (new PaymentType())->all();
        view('payments/create', compact('orders', 'paymentStatuses', 'paymentTypes'));
    }

    /**
     * Save payment
     */
    public function store()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'order_id' => ['required', 'integer'],
            'payment_type_id' => ['required', 'integer'],
            'payment_status_id' => ['required', 'integer'],
            'payment_date' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'card_number' => ['string'],
            'exp_date' => ['string']
        ]);

        // Mark parent order as paid if payment is confirmed
        if ($this->payment->create($data) && $data['payment_status_id'] == PAYMENT_STATUS_SUCCESS) {
            session()->flash(['success' => "Payment status has been updated!"]);
            if ((new Order())->markAsPaidById($data['order_id'])) {
                session()->flash(['success' => "Payment status was updated and order has been marked as paid!"]);
                EventLogger::log($data['order_id'], ORDER_STATUS_CONFIRMED);
            }
        }

        redirect('payments');
    }

    /**
     * Show payment information / Invoice
     */
    public function show()
    {
        $this->guard(['admin']);
        if (request()->has('id')) {
            $payment = $this->payment->getById(request()->get('id'));
            if ($payment) {
                $order = (new Order())->getById($payment['order_id']);
                $customer = (new Customer())->getById($order['user_id']);
                $settings = (new Settings())->get();
                view('payments/show', compact('payment', 'customer', 'order', 'settings'));
            } else {
                view('404');
            }
        } else {
            view('404');
        }
    }

    /**
     * Delete payment
     */
    public function delete()
    {
        $this->guard(['admin']);
        if (request()->has('payment_id')) {
            $status = $this->payment->deleteById(request()->get('payment_id'));
            if ($status) {
                session()->flash(['success' => "Payment removed!"]);
            }
        }
        redirect('payments');
    }


    /**
     * Refund payment
     *
     * @throws \Exception
     */
    public function refund()
    {
        $this->guard(['admin']);
        if (request()->has('payment_id')) {
            $this->payment->refund(request()->get('payment_id'));
        }
        redirect('payments');
    }
}
