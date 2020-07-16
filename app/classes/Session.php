<?php

namespace app\classes;

class Session
{
    private static function initialize()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
    }

    public static function setValue(string $key, string $value)
    {
        self::initialize();
        $_SESSION[$key] = $value;
    }

    public static function getValue(string $key)
    {
        self::initialize();
        return $_SESSION[$key] ?? null;
    }

    public static function destroy()
    {
        self::initialize();
        session_destroy();
    }
}
