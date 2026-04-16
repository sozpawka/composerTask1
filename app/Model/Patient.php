<?php

namespace Model;

use PDO;

class Patient
{
    private static function db()
    {
        return new PDO('mysql:host=127.0.0.1;dbname=clinic;charset=utf8', 'root', '');
    }
    public static function all(): array
    {
        return self::db()
            ->query("SELECT * FROM patients ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $stmt = self::db()->prepare("
            INSERT INTO patients (last_name, first_name, middle_name, birth_date)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['last_name'],
            $data['first_name'],
            $data['middle_name'] ?? null,
            $data['birth_date']
        ]);
    }
}