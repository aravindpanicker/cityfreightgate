<?php

namespace App\Models;

/**
 * OrderTracking Model.
 */
class OrderTracking extends Model
{
    /**
     * Get all order tracking records.
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM order_tracking')->get();
    }

    /**
     * Create a new order tracking record.
     */
    public function create($data)
    {
        return $this->db->insert('order_tracking', [
            'order_id' => $data['order_id'],
            'date_time' => date("Y-m-d H:i:s"),
            'description' => $data['description']
        ]);
    }

    /**
     * Get order tracking information using the order's unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM order_tracking WHERE order_id = :order_id', ['order_id' => $id])->get();
    }

    /**
     * Update an existing tracking info using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE order_tracking SET order_id = :order_id, date_time = :date_time, description = :description WHERE ot_id = :ot_id';
        return $this->db->query($query, [
            'ot_id' => $id,
            'order_id' => $data['order_id'],
            'date_time' => date("Y-m-d H:i:s"),
            'description' => $data['description'],
        ])->execute();
    }

    /**
     * Delete tracking information using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM order_statuses WHERE ot_id = :ot_id', ['ot_id' => $id])->execute();
    }
}