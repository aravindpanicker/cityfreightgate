<?php

namespace App\Models;

/**
 * VehicleType Model
 */
class VehicleType extends Model
{
    /**
     * Get all vehicle types.
     */
    public function all()
    {
        return $this->db->query('SELECT * FROM vehicle_types')->get();
    }

    /**
     * Create a new vehicle type.
     */
    public function create($data)
    {
        return $this->db->insert('vehicle_types', [
            'vt_name' => $data['vt_name'],
            'km_rate' => number_format($data['km_rate'], 2, '.', '')
        ]);
    }

    /**
     * Get a vehicle type using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM vehicle_types WHERE vt_id = :vt_id', ['vt_id' => $id])->first();
    }

    /**
     * Update a vehicle type using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE vehicle_types SET vt_name = :vt_name, km_rate = :km_rate WHERE vt_id = :vt_id';
        return $this->db->query($query, [
            'vt_id' => $id,
            'vt_name' => $data['vt_name'],
            'km_rate' => number_format($data['km_rate'], 2, '.', '')
        ])->execute();
    }

    /**
     * Delete a vehicle type using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM vehicle_types WHERE vt_id = :vt_id', ['vt_id' => $id])->execute();
    }
}