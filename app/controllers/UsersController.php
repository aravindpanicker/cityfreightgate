<?php

namespace App\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->guard(['admin']);
    }

    public function activate()
    {
        $data = $this->request->validate([
            'user_id' => ['required', 'numeric']
        ]);
        if((new User())->activate($data['user_id'])) {
            session()->flash(['success' => "Account has been activated!"]);
        }
        redirect_back();
    }

    public function deactivate()
    {
        $data = $this->request->validate([
            'user_id' => ['required', 'numeric']
        ]);
        if((new User())->deactivate($data['user_id'])) {
            session()->flash(['success' => "Account has been deactivated!"]);
        }
        redirect_back();
    }

    public function delete()
    {
        $data = $this->request->validate([
            'user_id' => ['required', 'numeric']
        ]);
        if((new User())->deleteById($data['user_id'])) {
            session()->flash(['success' => "Account has been removed!"]);
        }
        redirect_back();
    }

    public function resetPassword()
    {
        $data = $this->request->validate([
            'user_id' => ['required', 'numeric']
        ]);
        $newPassword = str_shuffle('city_freight' . rand(1, 99999));
        if((new User())->resetPassword($data['user_id'], $newPassword)) {
            session()->flash(['success' => "Password has been reset to : " . $newPassword]);
        }
        redirect_back();
    }
}
