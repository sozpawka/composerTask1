<?php

namespace Src\Auth;

use Src\Session;

class Auth
{
    private static IdentityInterface $identity;

    public static function init(IdentityInterface $identity): void
    {
        self::$identity = $identity;
    }

    public static function login(IdentityInterface $user): void
    {
        Session::set('id', $user->getId());
    }

    public static function attempt(array $credentials): bool
    {
        $user = self::$identity->attemptIdentity($credentials);

        if (!$user) {
            return false;
        }
        self::login($user);
        return true;
    }

    public static function user()
    {
        $id = Session::get('id');

        if (!$id) {
            return null;
        }

        return self::$identity->findIdentity($id);
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function logout(): bool
    {
        Session::clear('id');
        return true;
    }
    public static function generateCSRF(): string
    {
        $token = md5(time());
        \Src\Session::set('csrf_token', $token);
        return $token;
    }
}