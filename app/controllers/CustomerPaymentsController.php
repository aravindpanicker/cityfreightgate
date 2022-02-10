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
 * Class CustomerPaymentsController
 * @package App\Controllers
 */
class CustomerPaymentsController extends Controller
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
        $this->guard(['customer']);

        if (!session()->has('order_id')) {
            view('403');
            return;
        }
        $orderId = session()->get('order_id');
        $order = (new Order())->getById($orderId);
        $amount = session()->get('amount');
        view('customers/payments/collect', compact('order', 'amount'));
    }

    /**
     * Show payment information / Invoice
     */
    public function show()
    {
        $this->guard(['customer']);
        if (request()->has('order_id')) {
            $payment = $this->payment->getByOrderId(request()->get('order_id'));
            if (!$payment) {
                view('404');
                return;
            }
            $order = (new Order())->getById(request()->get('order_id'));

            if (auth()->user_id() !== $order['user_id']) {
                view('404');
                return;
            }

            $customer = (new Customer())->getById($order['user_id']);
            $settings = (new Settings())->get();
            view('payments/show', compact('payment', 'customer', 'order', 'settings'));
        } else {
            view('404');
        }
    }

    /**
     * Save payment
     */
    public function store()
    {
        $this->guard(['customer']);

        $data = $this->request->validate([
            'card_number' => ['string'],
            'exp_date' => ['string']
        ]);

        $data['card_number'] = substr($data['card_number'], -4);

        $data['order_id'] = session()->get('order_id');
        $data['amount'] = session()->get('amount');
        $data['payment_type_id'] = PAYMENT_CREDIT_CARD;
        $data['payment_status_id'] = PAYMENT_STATUS_SUCCESS;
        $data['payment_date'] = date('Y-m-d');

        // Mark parent order as paid if payment is confirmed
        if ($this->payment->create($data)) {
            session()->flash(['success' => "Payment status has been updated!"]);
            if ((new Order())->markAsPaidById($data['order_id'])) {
                session()->forget('order_id');
                session()->forget('amount');
                session()->flash(['success' => "We have received your order. Please check the active orders to track your order status."]);
                EventLogger::log($data['order_id'], ORDER_STATUS_CONFIRMED);
            }
        }

        redirect('customer/orders');
    }

    /**
     * Refund payment
     *
     * @throws \Exception
     */
    public function refund()
    {
        $this->guard(['customer']);
        if (request()->has('payment_id')) {
            $this->payment->refund(request()->get('payment_id'));
        }
        redirect('payments');
    }
}
