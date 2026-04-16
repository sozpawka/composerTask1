<?php

namespace Model;

use PDO;

class User
{
    private static function db()
    {
        return new PDO('mysql:host=localhost;dbname=clinic;charset=utf8', 'root', '');
    }

    public static function findByLogin($login)
    {
        $stmt = self::db()->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$login]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $stmt = self::db()->prepare("
            INSERT INTO users (login, password, role)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([
            $data['login'],
            md5($data['password']),
            $data['role']
        ]);
    }
}