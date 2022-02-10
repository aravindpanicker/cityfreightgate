<?php

namespace App\Models;

/**
 * User Model
 */
class User extends Model
{
    /**
     * Create a new user record.
     */
    public function create($user): bool
    {
        return $this->db->insert('users', [
            'role_id' => $user['role_id'],
            'state_id' => $user['state'],
            'city_id' => $user['city'],
            'location_id' => $user['location'],
            'user_status_id' => $user['user_status'],
            'address' => trim($user['address']),
            'name' => trim($user['name']),
            'email' => trim($user['email']),
            'phone' => $user['phone'],
            'password' => md5($user['password']),
            'reg_date' => $user['reg_date']
        ]);
    }

    /**
     * Get a user record using its unique identifier.
     */
    public function getById($id)
    {
        return $this->db->query('SELECT * FROM users WHERE user_id = :user_id', ['user_id' => $id])->first();
    }

    /**
     * Update a user record using it's unique identifier.
     */
    public function updateById($id, $data): bool
    {
        $query = 'UPDATE users SET name = :name, phone = :phone, address = :address, state_id = :state_id, 
                 city_id = :city_id, location_id = :location_id WHERE user_id = :user_id';
        return $this->db->query($query, [
            'user_id' => $id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'location_id' => $data['location_id']
        ])->execute();
    }

    /**
     * Delete a user record using its unique identifier.
     */
    public function deleteById($id)
    {
        return $this->db->query('DELETE FROM users WHERE user_id = :user_id', ['user_id' => $id])->execute();
    }

    /**
     * Active a user account using its unique identifier by updating
     * the user status to USER_STATUS_ACTIVE
     */
    public function activate($id)
    {
        $query = 'UPDATE users SET user_status_id = :user_status_id WHERE user_id = :user_id';
        return $this->db->query($query, [
            'user_status_id' => USER_STATUS_ACTIVE,
            'user_id' => $id
        ])->execute();
    }

    /**
     * Deactivate a user account using its unique identifier by updating
     * the user status to USER_STATUS_INACTIVE.
     */
    public function deactivate($id)
    {
        $query = 'UPDATE users SET user_status_id = :user_status_id WHERE user_id = :user_id';
        return $this->db->query($query, [
            'user_status_id' => USER_STATUS_INACTIVE,
            'user_id' => $id
        ])->execute();
    }

    /**
     * Reset user password using its unique identifier.
     */
    public function resetPassword($id, $password)
    {
        $query = 'UPDATE users SET password = :password WHERE user_id = :user_id';
        return $this->db->query($query, [
            'password' => md5($password),
            'user_id' => $id
        ])->execute();
    }
}