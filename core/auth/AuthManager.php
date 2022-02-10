<?php

namespace App\Core\Auth;

use App\Core\App;
use App\Models\Role;

/**
 * Class AuthManager
 * @package App\Core\Auth
 */
class AuthManager
{
    /**
     * Attempt to authenticate a user using the provided credentials. If provider credentials are
     * valid, add the user to session.
     *
     * @param $username
     * @param $password
     * @return false
     */
    public static function attempt($username, $password)
    {
        $user = App::get('database')->query('SELECT * from users where email = :email and password = :password AND user_status_id = :user_status_id', [
            'email' => $username,
            'password' => md5($password),
            'user_status_id' => USER_STATUS_ACTIVE,
        ])->first();
        if ($user) {
            unset($user['password']);
            $user['role'] = (new Role)->getRoleByRoleId($user['role_id']);
            self::login($user);
            return $user;
        }
        return false;
    }

    /**
     * Authenticate a user using his user id
     *
     * @param $userId
     * @return mixed
     */
    public static function loginUsingId($userId)
    {
        $user = App::get('database')->query('SELECT * from users where user_id = :id', ['id' => $userId])->first();
        if ($user) {
            unset($user['password']);
            self::login($user);
            return $user;
        }
    }

    /**
     * Add logged in user to session.
     *
     * @param $user
     */
    private static function login($user)
    {
        session()->set('user', $user);
    }

    /**
     * Get user information from session.
     *
     * @return mixed|null
     */
    public static function user()
    {
        if (session()->has('user')) {
            return session()->get('user');
        }
        return null;
    }

    /**
     * Get id of the logged in user.
     *
     * @return integer|null
     */
    public static function user_id()
    {
        if (session()->has('user')) {
            return session()->get('user')['user_id'];
        }
        return null;
    }

    /**
     * Check if the user is authenticated
     *
     * @return mixed
     */
    public static function check()
    {
        return session()->has('user');
    }

    /**
     * Check if the visitor is a guest
     *
     * @return bool
     */
    public static function isGuest(): bool
    {
        return !self::check();
    }

    /**
     * Check if authenticated user is an admin.
     *
     * @return bool
     */
    public static function isAdmin(): bool
    {
        if (!self::check()) return false;
        return (self::user()['role_id'] === ROLE_ADMIN);
    }

    /**
     * Check if authenticated user is a driver
     *
     * @return bool
     */
    public function isDriver(): bool
    {
        if (!self::check()) return false;
        return (self::user()['role_id'] === ROLE_DRIVER);
    }

    /**
     * Check if authenticated user is a customer
     *
     * @return bool
     */
    public function isCustomer(): bool
    {
        if (!self::check()) return false;
        return (self::user()['role_id'] === ROLE_CUSTOMER);
    }

    /**
     * Flush everything from session.
     */
    public static function logout()
    {
        session()->flush();
    }
}