<?php

namespace App\Shared\Utils\Constants;

class GlobalConstants
{
    private static string $EMAIL_KEY_REQUEST = 'email';
    private static string $PASSWORD_KEY_REQUEST = 'password';
    private static string $ROLE_KEY_REQUEST = 'role';
    private static string $EMAIL_PLAIN = 'email';
    private static string $PASSWORD_PLAIN = 'password';
    private static string $ROLE_PLAIN = 'role';

    public static function emailKeyRequest(): string
    {
        return self::$EMAIL_KEY_REQUEST;
    }
    public static function emailPlain(): string
    {
        return self::$EMAIL_PLAIN;
    }
    public static function passwordKeyRequest(): string
    {
        return self::$PASSWORD_KEY_REQUEST;
    }
    public static function passwordPlain(): string
    {
        return self::$PASSWORD_PLAIN;
    }
    public static function roleKeyRequest(): string
    {
        return self::$ROLE_KEY_REQUEST;
    }
    public static function rolePlain(): string
    {
        return self::$ROLE_PLAIN;
    }
}