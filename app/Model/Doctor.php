<?php

namespace Model;

use PDO;

class Doctor
{
    private static function db()
    {
        return new PDO('mysql:host=127.0.0.1;dbname=clinic;charset=utf8', 'root', '');
    }
    public static function all(): array
    {
        return self::db()
            ->query("SELECT * FROM doctors ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function create($data)
    {
        $stmt = self::db()->prepare("
            INSERT INTO doctors (last_name, first_name, middle_name, birth_date, position, specialization)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['last_name'],
            $data['first_name'],
            $data['middle_name'],
            $data['birth_date'],
            $data['position'],
            $data['specialization']
        ]);
    }
}