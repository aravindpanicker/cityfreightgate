<?php

namespace App\Models;

/**
 * Settings Model
 */
class Settings extends Model
{
    /**
     * Get settings.
     */
    public function get()
    {
        return $this->db->query('select * from settings')->first();
    }

    /**
     * Update settings.
     */
    public function update($data)
    {
        return $this->db->query('UPDATE settings SET company_name = :company_name, address = :address, primary_phone = :primary_phone, mobile = :mobile, email = :email, terms = :terms', [
            'company_name' => $data['company_name'],
            'address' => $data['address'],
            'primary_phone' => $data['primary_phone'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'terms' => $data['terms']
        ])->execute();
    }
}