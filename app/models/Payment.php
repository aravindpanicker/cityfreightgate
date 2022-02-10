<?php

namespace App\Models;

/**
 * Payment Model
 */
class Payment extends Model
{
    /**
     * Get all payment records.
     */
    public function all()
    {
        $query = 'SELECT payment_id, o.order_id, payment_status_id, payment_type_id, payment_date, pt_name, payments.amount, card_number, exp_date, ps_name 
                FROM payments 
                LEFT JOIN orders o on payments.order_id = o.order_id 
                LEFT JOIN payment_statuses ps on payments.payment_status_id = ps.ps_id 
                LEFT JOIN payment_types pt on payments.payment_type_id = pt.pt_id';
        return $this->db->query($query)->get();
    }

    /**
     * Create a new payment record.
     */
    public function create($data)
    {
        return $this->db->insert('payments', [
            'order_id' => $data['order_id'],
            'payment_status_id' => $data['payment_status_id'],
            'payment_type_id' => $data['payment_type_id'],
            'payment_date' => $data['payment_date'],
            'amount' => $data['amount'],
            'card_number' => $data['card_number'],
            'exp_date' => $data['exp_date'],
        ]);
    }

    /**
     * Get a payment record using its unique id.
     */
    public function getById($id)
    {
        $query = 'SELECT payment_id, o.order_id, payment_status_id, payment_type_id, payment_date, pt_name, payments.amount, card_number, exp_date, ps_name 
                FROM payments 
                LEFT JOIN orders o on payments.order_id = o.order_id 
                LEFT JOIN payment_statuses ps on payments.payment_status_id = ps.ps_id 
                LEFT JOIN payment_types pt on payments.payment_type_id = pt.pt_id
                WHERE payment_id = :payment_id';
        return $this->db->query($query, ['payment_id' => $id])->first();
    }

    /**
     * Get payment information using the unique identifier of the order.
     */
    public function getByOrderId($id)
    {
        $query = 'SELECT payment_id, o.order_id, payment_status_id, payment_type_id, payment_date, pt_name, payments.amount, card_number, exp_date, ps_name 
                FROM payments 
                LEFT JOIN orders o on payments.order_id = o.order_id 
                LEFT JOIN payment_statuses ps on payments.payment_status_id = ps.ps_id 
                LEFT JOIN payment_types pt on payments.payment_type_id = pt.pt_id
                WHERE payments.order_id = :order_id';
        return $this->db->query($query, ['order_id' => $id])->first();
    }

    /**
     * Update a payment record using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE payments WHERE payment_id = :payment_id';
        return $this->db->query($query, [
            'payment_id' => $id,
            'order_id' => $data['order_id'],
            'payment_status_id' => $data['payment_status_id'],
            'payment_type_id' => $data['payment_type_id'],
            'payment_date' => $data['payment_date'],
            'amount' => $data['amount'],
            'card_number' => $data['card_number'],
            'exp_date' => $data['exp_date']
        ])->execute();
    }

    /**
     * Delete a payment record using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM payments WHERE payment_id = :payment_id', ['payment_id' => $id])->execute();
    }

    /**
     * Get the payment amount collected using the unique identifier
     * of the payment.
     */
    public function getPaymentCollectedById($id)
    {
        $payment = $this->getById($id);
        return $payment['amount'];
    }

    /**
     * Update the status of a payment to PAYMENT_STATUS_CANCELLED
     * using the unique identifier of the payment.
     */
    public function cancelPaymentById($id)
    {
        $query = 'UPDATE payments SET payment_status_id = :payment_status_id WHERE payment_id = :payment_id';
        return $this->db->query($query, [
            'payment_id' => $id,
            'payment_status_id' => PAYMENT_STATUS_CANCELLED
        ])->execute();
    }

    /**
     * Refunds a completed payment.
     *
     * This method accepts the unique identifier of the payment. It then checks if the order
     * has been picked up. If that's the case, return an error message because a picked up
     * order can't be canceled based on the company policy.
     *
     * If the order was not picked up, the order is canceled and a refund is issued by
     * updating the status of the payment.
     */
    public function refund($id)
    {
        $payment = $this->getById($id);
        $order = new Order();
        $orderPickerUp = $order->isOrderPickedUp($payment['order_id']);

        if ($orderPickerUp) {
            session()->flash(['error' => "Refund can't be issued after the order was picked up!"]);
            return false;
        }

        $order->cancelOrderById($payment['order_id']);

        $status = (new Refund())->create([
            'payment_id' => $payment['payment_id'],
            'refund_date' => date('Y-m-d'),
            'refund_amount' => round(($payment['amount'] / 100) * 90, 2)
        ]);

        if ($status) {
            $this->cancelPaymentById($payment['payment_id']);
            session()->flash(['success' => "Parent order has been canceled and a refund has been issued!"]);
        }
    }
}