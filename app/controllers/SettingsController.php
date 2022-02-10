<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Location;
use App\Models\Settings;
use App\Models\State;
use App\Models\User;

/**
 * Class SettingsController
 * @package App\Controllers
 */
class SettingsController extends Controller
{

    private Settings $settings;

    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->settings = new Settings();
    }

    /**
     * Show settings
     */
    public function index()
    {
        $this->guard(['admin']);
        $settings = $this->settings->get();

        view('settings', compact('settings'));
    }

    /**
     * Update profile information
     */
    public function update()
    {
        $this->guard(['admin']);

        $data = $this->request->validate([
            'company_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'primary_phone' => ['required', 'string'],
            'mobile' => ['required', 'string'],
            'email' => ['required', 'string'],
            'terms' => ['string'],
        ]);

        $status = $this->settings->update([
            'company_name' => $data['company_name'],
            'address' => $data['address'],
            'primary_phone' => $data['primary_phone'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'terms' => $data['terms']
        ]);

        if ($status) {
            session()->flash(['success' => "Your settings has been updated!"]);
        }

        redirect_back();
    }
}
