<?php

namespace App\Models;

/**
 * State Model
 */
class State extends Model
{
    /**
     * Get all states
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM states')->get();
    }

    /**
     * Create a new state.
     */
    public function create($data)
    {
        return $this->db->insert('states', [
            'state_name' => $data['name']
        ]);
    }

    /**
     * Get state using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM states WHERE state_id = :state_id', ['state_id' => $id])->first();
    }

    /**
     * Update a state using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        return $this->db->query('UPDATE states SET state_name = :state_name WHERE state_id = :state_id', [
            'state_id' => $id,
            'state_name' => $data['name']
        ])->execute();
    }

    /**
     * Delete a state using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM states WHERE state_id = :state_id', ['state_id' => $id])->execute();
    }
}