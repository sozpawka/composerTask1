<?php

namespace Model;

use PDO;

class Visit
{
    private static function db()
    {
        return new PDO('mysql:host=127.0.0.1;dbname=clinic;charset=utf8', 'root', '');
    }
    public static function create($data)
    {
        $stmt = self::db()->prepare("
            INSERT INTO visits (patient_id, doctor_id, visit_date)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([
            $data['patient_id'],
            $data['doctor_id'],
            $data['visit_date']
        ]);
    }
    public static function all()
    {
        $stmt = self::db()->query("
            SELECT v.*, 
                   p.last_name AS patient_last,
                   d.last_name AS doctor_last
            FROM visits v
            JOIN patients p ON p.id = v.patient_id
            JOIN doctors d ON d.id = v.doctor_id
            ORDER BY v.visit_date DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function delete($id)
    {
        $stmt = self::db()->prepare("DELETE FROM visits WHERE id = ?");
        return $stmt->execute([$id]);
    }
}