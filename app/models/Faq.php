<?php

namespace App\Models;

/**
 * Faq Model
 */
class Faq extends Model
{

    /**
     * Get all faqs from the database.
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM faqs')->get();
    }

    /**
     * Create a new faq record.
     */
    public function create($data)
    {
        return $this->db->insert('faqs', [
            'question' => $data['question'],
            'answer' => $data['answer']
        ]);
    }

    /**
     * Get faq record by the unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM faqs WHERE faq_id = :faq_id', ['faq_id' => $id])->first();
    }

    /**
     * Update an existing faq record by faq identifier.
     */
    public function updateById($id, $data): bool
    {
        return $this->db->query('UPDATE faqs SET question = :question,  answer = :answer WHERE faq_id = :faq_id', [
            'faq_id' => $id,
            'question' => $data['question'],
            'answer' => $data['answer']
        ])->execute();
    }

    /**
     * Delete an existing faq using the unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM faqs WHERE faq_id = :faq_id', ['faq_id' => $id])->execute();
    }
}