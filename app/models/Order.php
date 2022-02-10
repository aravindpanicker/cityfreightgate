<?php

namespace App\Models;

/**
 * Order model.
 */
class Order extends Model
{
    /**
     * Query for fetching orders and related tables.
     * @var string
     */
    private $selectQuery = 'SELECT order_id, order_status_id, orders.vehicle_type_id, name, vt_name, driver_id, vehicle_name, reg_number, 
                    l.location_name as pickup_location_name, dl.location_name as drop_location_name, 
                    order_date, pickup_date, os_name, amount, u.phone as customer_phone 
                    FROM orders 
                    LEFT JOIN users u on orders.user_id = u.user_id 
                    LEFT JOIN vehicle_types vt on orders.vehicle_type_id = vt.vt_id 
                    LEFT JOIN vehicles v on orders.vehicle_id = v.vehicle_id 
                    LEFT JOIN locations l on orders.pickup_location_id = l.location_id 
                    LEFT JOIN locations dl on orders.drop_location_id = dl.location_id 
                    LEFT JOIN order_statuses os on orders.order_status_id = os.os_id';

    /**
     * Get all orders and related information.
     */
    public function all()
    {
        $query = $this->selectQuery . ' WHERE order_status_id NOT IN( ' . ORDER_STATUS_COMPLETED . ', ' . ORDER_STATUS_CANCELLED . ')';
        return $this->db->query($query)->get();
    }

    /**
     * Get completed orders and related information.
     */
    public function completed()
    {
        $filters = [ORDER_STATUS_COMPLETED, ORDER_STATUS_CANCELLED];
        $query = $this->selectQuery . ' WHERE order_status_id IN(' . join(',', $filters) . ')';
        return $this->db->query($query)->get();
    }

    /**
     * Get all active orders which belongs to a user using the user's unique
     * identifier.
     */
    public function getActiveOrdersByUserId($userId)
    {
        $query = $this->selectQuery . ' WHERE u.user_id = :user_id AND order_status_id NOT IN( ' . ORDER_STATUS_COMPLETED . ', ' . ORDER_STATUS_CANCELLED . ')';
        return $this->db->query($query, ['user_id' => $userId])->get();
    }

    /**
     * Get all completed orders which belongs to a user using the user's unique
     * identifier.
     */
    public function getCompletedOrdersByUserId($userId)
    {
        $query = $this->selectQuery . ' WHERE u.user_id = :user_id AND order_status_id IN( ' . ORDER_STATUS_COMPLETED . ', ' . ORDER_STATUS_CANCELLED . ')';
        return $this->db->query($query, ['user_id' => $userId])->get();
    }

    /**
     * Get all active orders for a driver using the driver's unique identifier.
     */
    public function getActiveOrdersByDriverId($driverId)
    {
        $filters = [ORDER_STATUS_OUT_FOR_PICKUP, ORDER_STATUS_PICKED_UP, ORDER_STATUS_IN_TRANSIT, ORDER_STATUS_OUT_FOR_DELIVERY];
        $query = $this->selectQuery . ' WHERE driver_id = :driver_id AND order_status_id IN(' . join(',', $filters) . ')';
        return $this->db->query($query, ['driver_id' => $driverId])->get();
    }

    /**
     * Get all completed orders for a driver using the driver's unique identifier.
     */
    public function getCompletedOrdersByDriverId($driverId)
    {
        $filters = [ORDER_STATUS_COMPLETED, ORDER_STATUS_DELIVERED];
        $query = $this->selectQuery . ' WHERE driver_id = :driver_id AND order_status_id IN(' . join(',', $filters) . ')';
        return $this->db->query($query, ['driver_id' => $driverId])->get();
    }

    /**
     * Get all orders for which the payment is pending.
     */
    public function getAllPaymentPendingOrders()
    {
        $query = 'SELECT * FROM orders LEFT JOIN users u on orders.user_id = u.user_id WHERE order_status_id = :order_status';
        return $this->db->query($query, ['order_status' => ORDER_STATUS_PENDING])->get();
    }

    /**
     * Mark an order as paid using its unique identifier.
     */
    public function markAsPaidById($id)
    {
        return $this->db->query('UPDATE orders SET order_status_id = :order_status_id WHERE order_id = :order_id', [
            'order_id' => $id,
            'order_status_id' => ORDER_STATUS_CONFIRMED
        ])->execute();
    }

    /**
     * Create a new order.
     */
    public function create($data)
    {
        return $this->db->insert('orders', [
            'user_id' => $data['user_id'],
            'vehicle_type_id' => $data['vehicle_type_id'],
            'pickup_location_id' => $data['pickup_location_id'],
            'drop_location_id' => $data['drop_location_id'],
            'order_status_id' => $data['order_status_id'],
            'order_date' => $data['order_date'],
            'pickup_date' => $data['pickup_date'],
            'amount' => $data['amount'],
            'comments' => $data['comments'],
            'description' => $data['description'],
        ]);
    }

    /**
     * Get an order using its unique identifier.
     */
    public function getById($id)
    {
        $query = 'SELECT order_id, user_id, orders.vehicle_type_id, v.vehicle_id, description, pickup_location_id, 
                drop_location_id, order_status_id, os.os_name as order_status, order_date, pickup_date, amount, comments,
                dl.location_name as delivery_location, l.location_name as pickup_location, vt_name, vehicle_name, reg_number, driver_id 
                FROM orders 
                LEFT JOIN vehicle_types vt on orders.vehicle_type_id = vt.vt_id 
                LEFT JOIN vehicles v on orders.vehicle_id = v.vehicle_id 
                LEFT JOIN locations l on orders.pickup_location_id = l.location_id 
                LEFT JOIN locations dl on orders.drop_location_id = dl.location_id 
                LEFT JOIN order_statuses os on orders.order_status_id = os.os_id
                WHERE order_id = :order_id';
        return $this->db->query($query, ['order_id' => $id])->first();
    }

    /**
     * Update an existing order using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE orders SET vehicle_id = :vehicle_id, order_status_id = :order_status_id, comments = :comments WHERE order_id = :order_id';
        return $this->db->query($query, [
            'order_id' => $id,
            'vehicle_id' => $data['vehicle_id'],
            'order_status_id' => $data['order_status_id'],
            'comments' => $data['comments']
        ])->execute();
    }

    /**
     * Update the status of an order using its unique identifier.
     * Updating is limited to the status of the order and the comments.
     */
    public function updateStatusById($id, $data): bool
    {
        $query = 'UPDATE orders SET order_status_id = :order_status_id, comments = :comments WHERE order_id = :order_id';
        return $this->db->query($query, [
            'order_id' => $id,
            'order_status_id' => $data['order_status_id'],
            'comments' => $data['comments']
        ])->execute();
    }

    /**
     * Delete an order using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM orders WHERE order_id = :order_id', ['order_id' => $id])->execute();
    }

    /**
     * Check if an order has been picked up using its unique identifier.
     */
    public function isOrderPickedUp($id): bool
    {
        $order = $this->getById($id);
        return $order['order_status_id'] === ORDER_STATUS_PICKED_UP;
    }

    /**
     * Cancel an order using its unique identifier.
     */
    public function cancelOrderById($id): bool
    {
        return $this->db->query('UPDATE orders SET order_status_id = :order_status_id WHERE order_id = :order_id', [
            'order_id' => $id,
            'order_status_id' => ORDER_STATUS_CANCELLED
        ])->execute();
    }

    /**
     * Get total number of orders.
     */
    public function getCount()
    {
        return $this->db->query('SELECT order_id FROM orders')->count();
    }

    /**
     * Get unique identifier of the last inserted order.
     */
    public function getLastInsertId()
    {
        return $this->db->getLastInsertId();
    }
}