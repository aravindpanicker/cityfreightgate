<?php

namespace App\Models;

/**
 * PaymentType Model
 */
class PaymentType extends Model
{
    /**
     * Get all payment types.
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM payment_types')->get();
    }

    /**
     * Create a new payment type.
     */
    public function create($data)
    {
        return $this->db->insert('payment_types', ['pt_name' => $data['pt_name']]);
    }

    /**
     * Get a payment type by its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM payment_types WHERE pt_id = :pt_id', ['pt_id' => $id])->first();
    }

    /**
     * Update the payment type using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE payment_types SET pt_name = :pt_name WHERE pt_id = :pt_id';
        return $this->db->query($query, [
            'ps_id' => $id,
            'ps_name' => $data['ps_name']
        ])->execute();
    }

    /**
     * Delete a payment type using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM payment_types WHERE pt_id = :pt_id', ['pt_id' => $id])->execute();
    }
}