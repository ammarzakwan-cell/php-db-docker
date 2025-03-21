<?php

if (!function_exists('session')) {
    /**
     * Read the value of a session key.
     *
     * Read a session: session('name').
     *
     * @param string $key Session Key
     * @param mixed|null $default Default value if the session is not exit.
     */
    function session(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }
}

if (!function_exists('sessions')) {
    /**
     * Get all values from current session.
     *
     * @param array $keys Session keys' values to be returned.
     */
    function sessions(array $keys = []): array
    {
        if ($keys) {
            return array_intersect_key($_SESSION, array_flip($keys));
        }

        return $_SESSION;
    }
}

if (!function_exists('session_exist')) {
    /**
     * Check session key is exist.
     *
     * @param string $key Session key to be checked.
     * @return bool
     */
    function session_exist(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }
}

if (!function_exists('session_set')) {
    /**
     * Set a session key with value.
     *
     * @param string|array $key Session Key
     * @param mixed  $value The value for the session key.
     */
    function session_set(string|array $key, mixed $value = null): mixed
    {
        if (is_array($key)) {
            foreach ($key as $keyName => $value) {
                $_SESSION[$keyName] = $value;
            }
            return $key;
        }

        return $_SESSION[$key] = $value;
    }
}

if (!function_exists('session_del')) {
    /**
     * Delete sessions.
     *
     * @param string[] $keys The session keys to be deleted
     */
    function session_del(...$keys): void
    {
        foreach ($keys as $key) {
            unset($_SESSION[$key]);
        }
    }
}

if (!function_exists('server')) {
    /**
     * Get server information
     *
     * @param string $key The server information key.
     */
    function server(string $key): mixed
    {
        return $_SERVER[$key] ?? null;
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param string|int|float|bool|null $default
     * @return mixed
     */
    function env(string $key, mixed $default = null): mixed
    {
        $temp = $_ENV[$key] ?? $default;

        return match($temp) {
            'true', '(true)' => true,
            'false', '(false)' => false,
            'null', '(null)' => '',
            default => $temp,
        };
    }
}

if (!function_exists('dd')) {
    /**
     * @param ...$vars
     * @return void
     */
    function dd(...$vars): void
    {
        echo "<pre>";
        call_user_func_array('var_dump', $vars);
        echo "</pre>";
        exit;
    }
}

if (! function_exists('redirect')) {
    /**
     * Perform redirect to target URL.
     *
     * @param string $url Target redirect URL.
     * @param int $code Redirect code. Default: 301
     * @param DateTime|null $cache Enable cache.
     * @return void
     */
    function redirect(string $url, int $code = 301, ?DateTime $cache = null): void
    {
        if ($cache) {
            $cache->setTimeZone(new DateTimeZone('GMT'));
            header('Expires: ' . date_format($cache, DateTimeInterface::RFC7231));
            header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        }
        header("Location: $url", true, $code);
        exit();
    }
}