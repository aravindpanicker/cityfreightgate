<?php

namespace App\Models;

/**
 * PaymentStatus Model
 */
class PaymentStatus extends Model
{
    /**
     * Get all payment statuses.
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM payment_statuses')->get();
    }

    /**
     * Create a new payment status.
     */
    public function create($data)
    {
        return $this->db->insert('payment_statuses', ['ps_name' => $data['ps_name']]);
    }

    /**
     * Get a payment status using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM payment_statuses WHERE ps_id = :ps_id', ['ps_id' => $id])->first();
    }

    /**
     * Update a payment status record using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE payment_statuses SET ps_name = :ps_name WHERE ps_id = :ps_id';
        return $this->db->query($query, [
            'ps_id' => $id,
            'ps_name' => $data['ps_name']
        ])->execute();
    }

    /**
     * Delete a payment status using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM payment_statuses WHERE ps_id = :ps_id', ['ps_id' => $id])->execute();
    }
}