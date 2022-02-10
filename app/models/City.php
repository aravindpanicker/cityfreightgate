<?php

namespace App\Models;

/**
 * City Model
 */
class City extends Model
{

    /**
     * Get all cities from the database.
     */
    public function all()
    {
        return $this->db->query('SELECT city_id, city_name, state_name FROM cities LEFT JOIN states s on s.state_id = cities.state_id')->get();
    }

    /**
     * Save a new city to the database.
     */
    public function create($data)
    {
        return $this->db->insert('cities', [
            'state_id' => $data['state'],
            'city_name' => $data['city_name']
        ]);
    }

    /**
     * Get details of the city by city id.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM cities WHERE city_id = :city_id', ['city_id' => $id])->first();
    }

    /**
     * Update details of an existing city.
     */
    public function updateById($id, $data): bool
    {
        return $this->db->query('UPDATE cities SET state_id = :state_id, city_name = :city_name WHERE city_id = :id', [
            'id' => $id,
            'state_id' => $data['state_id'],
            'city_name' => $data['name']
        ])->execute();
    }

    /**
     * Delete an existing city record from the database.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM cities WHERE city_id = :id', ['id' => $id])->execute();
    }

    /**
     * Get list of cities in a state using the state identifier.
     */
    public function getCitiesByStateId($stateId = null)
    {
        $filter = [];
        if ($stateId) {
            $filter = ['state' => $stateId];
        }
        return $this->db->query('SELECT * FROM cities WHERE state_id = :state', $filter)->get();
    }
}

