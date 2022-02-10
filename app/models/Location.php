<?php

namespace App\Models;

/**
 * Location model.
 */
class Location extends Model
{

    /**
     * Get all locations
     */
    public function all()
    {
        $query = 'SELECT location_id, location_name, city_name, state_name FROM locations LEFT JOIN cities c on locations.city_id = c.city_id LEFT JOIN states s on c.state_id = s.state_id';
        return $this->db->query($query)->get();
    }


    /**
     * Create a new location
     */
    public function create($data)
    {
        return $this->db->insert('locations', [
            'city_id' => $data['city_id'],
            'location_name' => $data['location_name']
        ]);
    }


    /**
     * Get location details using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT location_id, c.city_id, location_name, city_name, state_id FROM locations LEFT JOIN cities c on locations.city_id = c.city_id WHERE location_id = :id', ['id' => $id])->first();
    }


    /**
     * Update an existing location detail using it's unique identifier.
     */
    public function updateById($id, $data): bool
    {
        return $this->db->query('UPDATE locations SET city_id = :city_id, location_name = :location_name WHERE location_id = :location_id', [
            'location_id' => $id,
            'city_id' => $data['city_id'],
            'location_name' => $data['location_name']
        ])->execute();
    }

    /**
     * Delete an existing location using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM locations WHERE location_id = :location_id', ['location_id' => $id])->execute();
    }

    /**
     * Get all locations in a city using the cities unique identifier.
     */
    public function getLocationsByCityId($cityId = null): array
    {
        $filter = [];
        if ($cityId) {
            $filter = ['city' => $cityId];
        }
        return $this->db->query('SELECT * FROM locations WHERE city_id = :city', $filter)->get();
    }
}