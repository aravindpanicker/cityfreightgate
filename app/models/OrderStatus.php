<?php

namespace App\Models;

/**
 * OrderStatus model
 */
class OrderStatus extends Model
{

    /**
     * Get all order statuses.
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM order_statuses')->get();
    }

    /**
     * Create a new order status.
     */
    public function create($data)
    {
        return $this->db->insert('order_statuses', ['vs_name' => $data['vs_name']]);
    }

    /**
     * Get an order status using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM order_statuses WHERE os_id = :os_id', ['os_id' => $id])->first();
    }

    /**
     * Update an order status using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE order_statuses SET os_name = :os_name WHERE os_id = :os_id';
        return $this->db->query($query, [
            'os_id' => $id,
            'os_name' => $data['os_name']
        ])->execute();
    }

    /**
     * Delete the order status using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM order_statuses WHERE os_id = :os_id', ['os_id' => $id])->execute();
    }
}