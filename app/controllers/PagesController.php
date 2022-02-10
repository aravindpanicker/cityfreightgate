<?php

namespace App\Controllers;

/**
 * Class PagesController
 * @package App\Controllers
 */
class PagesController
{
    /**
     * Show the home page.
     */
    public function home()
    {
        return view('index');
    }

    public function welcome()
    {
        return view('auth/welcome');
    }
}
