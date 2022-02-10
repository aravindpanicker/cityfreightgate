<?php

namespace App\Models;

/**
 * Feedback model.
 */
class Feedback extends Model
{
    /**
     * Get all feedbacks from the customer.
     */
    public function all()
    {
        $query = 'SELECT id, u.user_id, u.name, submitted_date, content FROM feedbacks LEFT OUTER JOIN users u on u.user_id = feedbacks.user_id';
        return $this->db->query($query)->get();
    }

    /**
     * Create a new feedback
     */
    public function create($data)
    {
        return $this->db->insert('feedbacks', [
            'user_id' => $data['user_id'],
            'submitted_date' => date('Y-m-d'),
            'content' => $data['content']
        ]);
    }

    /**
     * Get a feedback using it's unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM feedbacks WHERE id = :fb_id', ['fb_id' => $id])->first();
    }

    /**
     * Delete a feedback record using it's unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM feedbacks WHERE id = :fb_id', ['fb_id' => $id])->execute();
    }
}