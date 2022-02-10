<?php

namespace App\Models;

/**
 * VehicleStatus Model
 */
class VehicleStatus extends Model
{
    /**
     * Get all vehicle statuses.
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM vehicle_statuses')->get();
    }

    /**
     * Create a new vehicle status.
     */
    public function create($data)
    {
        return $this->db->insert('vehicle_statuses', ['vs_name' => $data['vs_name']]);
    }

    /**
     * Get vehicle type using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM vehicle_statuses WHERE vs_id = :vs_id', ['vs_id' => $id])->first();
    }

    /**
     * Update a vehicle status using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE vehicle_statuses SET vs_name = :vs_name WHERE vs_id = :vs_id';
        return $this->db->query($query, [
            'vs_id' => $id,
            'vs_name' => $data['vs_name']
        ])->execute();
    }

    /**
     * Delete a vehicle record using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM vehicle_statuses WHERE vs_id = :vs_id', ['vs_id' => $id])->execute();
    }
}