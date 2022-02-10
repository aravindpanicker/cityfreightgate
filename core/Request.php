<?php

namespace App\Core;

use App\Core\Utility\FormValidator;

class Request
{
    /**
     * Fetch the request URI.
     */
    public static function uri()
    {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'
        );
    }

    /**
     * Check if the given URI is the active uri. This method is useful
     * when you have to highlight the active route.
     */
    public function is($uri): bool
    {
        if(strpos($uri, '*') !== false) {
            return (strpos(self::uri(), str_replace('*','', $uri)) !== false);
        }
        return $uri === self::uri();
    }

    /**
     * Fetch the request method. It could be GET or POST
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Extract a value from the $_REQUEST super global the key.
     */
    public function get($key)
    {
        return $this->has($key) ? $_REQUEST[$key] : null;
    }

    /**
     * Manually set a value on the $_REQUEST super global.
     */
    public function set($key, $value)
    {
        $_REQUEST[$key] = $value;
    }

    /**
     * Remove a key and value from the $_REQUEST super global.
     */
    public function unset($key)
    {
        unset($_REQUEST[$key]);
    }

    /**
     * Check if the given key exists in the $_REQUEST super global.
     */
    public function has($key)
    {
        return isset($_REQUEST[$key]);
    }

    /**
     * Get all items from the $_REQUEST & $_FILES super globals.
     */
    public function all()
    {
        return array_merge($_REQUEST, $_FILES);
    }

    /**
     * Validate the request based on the validation rules
     * passed into the method.
     */
    public function validate($rules)
    {
        session()->clean();
        $validator = new FormValidator($rules);
        if ($validator->validate($this)) {
            return $validator->getValues();
        } else {
            session()->set('_form', $validator->getErrors());
            session()->set('_old', $validator->getValues());
            redirect_back();
        }
    }
}
