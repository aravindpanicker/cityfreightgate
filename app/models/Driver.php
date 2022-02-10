<?php

namespace App\Models;

/**
 * Driver Model
 */
class Driver extends Model
{
    /**
     * Get all driver records.
     */
    public function all()
    {
        $query = 'SELECT user_id, user_status_id, address, name, email, phone, password, reg_date, status_name, location_name, city_name, state_name FROM users 
                    LEFT JOIN user_statuses us on users.user_status_id = us.us_id 
                    LEFT JOIN locations l on users.location_id = l.location_id
                    LEFT JOIN cities c on l.city_id = c.city_id
                    LEFT JOIN states s on c.state_id = s.state_id
                    WHERE role_id = :role_id';
        return $this->db->query($query, ['role_id' => ROLE_DRIVER])->get();
    }

    /**
     * Get number of driver records.
     */
    public function getCount()
    {
        return $this->db->query('SELECT user_id FROM users WHERE role_id = :role_id', ['role_id' => ROLE_DRIVER])->count();
    }

    public function getAvailableDrivers()
    {
        $query = 'SELECT * FROM `users` WHERE role_id = 2 AND user_status_id = 2 AND user_id NOT IN (SELECT DISTINCT driver_id FROM vehicles)';
        return $this->db->query($query)->get();
    }
}