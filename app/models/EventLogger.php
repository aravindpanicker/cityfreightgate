<?php

namespace App\Models;

/**
 * Class responsible for logging order related events which is
 * later used for order tracking.
 */
class EventLogger
{
    /**
     * Log an order event using the order id and order status id.
     */
    public static function log($orderId, $orderStatusId)
    {
        $order = (new Order())->getById($orderId);
        if(!$order) return;

        $orderStatus = (new OrderStatus())->getById($orderStatusId);
        if(!$orderStatus) return;

        (new OrderTracking())->create([
            'order_id' => $order['order_id'],
            'description' => $orderStatus['os_name']
        ]);
    }
}