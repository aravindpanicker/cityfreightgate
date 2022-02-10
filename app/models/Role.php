<?php

namespace App\Models;

/**
 * Role Model
 */
class Role extends Model
{
    /**
     * Get a role by its unique role id.
     */
    public function getRoleByRoleId($roleId)
    {
        if(empty($roleId)) return null;
        return $this->db->query('SELECT * FROM roles WHERE role_id = :id', ['id' => $roleId])->first();
    }
}