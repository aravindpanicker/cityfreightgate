<?php

namespace App\Models;

/**
 * Vehicle Model
 */
class Vehicle extends Model
{
    /**
     * Get all vehicle records.
     */
    public function all()
    {
        $query = 'SELECT vehicle_id, driver_id, vt_id, vs_id, vehicle_name, reg_number, vt_name, vs_name, name as driver_name FROM vehicles ';
        $query .= 'LEFT JOIN vehicle_types vt on vt.vt_id = vehicles.vehicle_type_id ';
        $query .= 'LEFT JOIN vehicle_statuses vs on vehicles.vehicle_status_id = vs.vs_id ';
        $query .= 'LEFT JOIN users u on vehicles.driver_id = u.user_id';
        return $this->db->query($query)->get();
    }

    /**
     * Create a new vehicle record.
     */
    public function create($data)
    {
        return $this->db->insert('vehicles', [
            'vehicle_type_id' => $data['vehicle_type_id'],
            'driver_id' => $data['driver_id'],
            'vehicle_status_id' => $data['vehicle_status_id'],
            'vehicle_name' => $data['vehicle_name'],
            'reg_number' => $data['reg_number'],
        ]);
    }

    /**
     * Get a vehicle record using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM vehicles WHERE vehicle_id = :vehicle_id', ['vehicle_id' => $id])->first();
    }

    /**
     * Get the vehicle record using the driver's unique identifier.
     */
    public function getByDriverId($driverId)
    {
        $query = 'SELECT vehicle_id, vehicle_type_id, vehicle_status_id, vehicle_name, reg_number, vs_name, vt_name 
                    FROM vehicles 
                    LEFT JOIN vehicle_types vt on vehicles.vehicle_type_id = vt.vt_id 
                    LEFT OUTER JOIN vehicle_statuses vs on vs.vs_id = vehicles.vehicle_status_id 
                    WHERE driver_id = :driver_id';
        return $this->db->query($query, ['driver_id' => $driverId])->first();
    }

    /**
     * Update the vehicle record using its unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE vehicles ';
        $query .= 'SET vehicle_type_id = :vehicle_type_id, driver_id = :driver_id, vehicle_status_id = :vehicle_status_id, ';
        $query .= 'vehicle_name = :vehicle_name, reg_number = :reg_number ';
        $query .= 'WHERE vehicle_id = :vehicle_id';
        return $this->db->query($query, [
            'vehicle_id' => $id,
            'vehicle_type_id' => $data['vehicle_type_id'],
            'driver_id' => $data['driver_id'],
            'vehicle_status_id' => $data['vehicle_status_id'],
            'vehicle_name' => $data['vehicle_name'],
            'reg_number' => $data['reg_number']
        ])->execute();
    }

    /**
     * Delete a vehicle record using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM vehicles WHERE vehicle_id = :vehicle_id', ['vehicle_id' => $id])->execute();
    }

    /**
     * Get vehicle records of a vehicle type using the unique identifier of the
     * vehicle type.
     */
    public function getByVehicleTypeId($id)
    {
        $query = 'SELECT * FROM vehicles WHERE vehicle_status_id = :vehicle_status_id AND vehicle_type_id = :vehicle_type_id';
        return $this->db->query($query, ['vehicle_type_id' => $id, 'vehicle_status_id' => VEHICLE_STATUS_IN_SERVICE])->get();
    }

    /**
     * Get number of vehicle records.
     */
    public function getCount()
    {
        return $this->db->query('SELECT vehicle_id FROM vehicles')->count();
    }
}