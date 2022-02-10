<?php

namespace App\Core\Session;

class SessionManager implements SessionInterface
{
    public function __construct(?string $cacheExpire = null, ?string $cacheLimiter = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            if ($cacheLimiter !== null) {
                session_cache_limiter($cacheLimiter);
            }
            if ($cacheExpire !== null) {
                session_cache_expire($cacheExpire);
            }
            session_start();
        }
    }

    public function get(string $key)
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }

        return null;
    }

    public function set(string $key, $value): SessionInterface
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function forget(string $key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function flush(): void
    {
        session_unset();
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    public function clean(): void
    {
        $this->forget('_form');
        $this->forget('_old');
        $this->forget('_flash');
    }

    public function flash(array $items)
    {
        $this->set('_flash', $items);
    }
}