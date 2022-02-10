<?php

namespace App\Models;

/**
 * Refund Model
 */
class Refund extends Model
{
    /**
     * Get all refund records.
     */
    public function all()
    {
        $query = 'SELECT * FROM refunds LEFT JOIN payments p on p.payment_id = refunds.payment_id';
        return $this->db->query($query)->get();
    }

    /**
     * Create a new refund record
     */
    public function create($data)
    {
        return $this->db->insert('refunds', [
            'payment_id' => $data['payment_id'],
            'refund_date' => $data['refund_date'],
            'refund_amount' => $data['refund_amount']
        ]);
    }

    /**
     * Get a refund record by its unique identifier.
     */
    public function getById($id)
    {
        $query = 'SELECT * FROM refunds LEFT JOIN payments p on p.payment_id = refunds.payment_id
                    WHERE refund_id = :refund_id';
        return $this->db->query($query, ['refund_id' => $id])->first();
    }

    /**
     * Update a refund record using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE refunds SET payment_id = :payment_id, refund_date = :refund_date, refund_amount = :refund_amount 
                    WHERE refund_id = :refund_id';
        return $this->db->query($query, [
            'refund_id' => $id,
            'payment_id' => $data['payment_id'],
            'refund_date' => $data['refund_date'],
            'refund_amount' => $data['refund_amount']
        ])->execute();
    }

    /**
     * Delete a refund record using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM refunds WHERE refund_id = :refund_id', ['refund_id' => $id])->execute();
    }
}