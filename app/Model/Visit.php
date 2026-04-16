<?php

namespace Model;

use PDO;

class Visit
{
    private static function db()
    {
        return new PDO('mysql:host=127.0.0.1;dbname=clinic;charset=utf8', 'root', '');
    }
    public static function all($filter = []): array
    {
        $sql = "
            SELECT v.*,
                   p.last_name AS patient_last,
                   p.first_name AS patient_first,
                   d.last_name AS doctor_last,
                   d.first_name AS doctor_first,
                   d.position AS doctor_position
            FROM visits v
            JOIN patients p ON p.id = v.patient_id
            JOIN doctors d ON d.id = v.doctor_id
            WHERE 1=1
        ";
        $params = [];
        if (!empty($filter['patient_id'])) {
            $sql .= " AND v.patient_id = ?";
            $params[] = $filter['patient_id'];
        }
        if (!empty($filter['doctor_id'])) {
            $sql .= " AND v.doctor_id = ?";
            $params[] = $filter['doctor_id'];
        }
        if (!empty($filter['date'])) {
            $sql .= " AND DATE(v.visit_date) = ?";
            $params[] = $filter['date'];
        }
        $sql .= " ORDER BY v.visit_date DESC";
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public static function delete($id)
    {
        $stmt = self::db()->prepare("DELETE FROM visits WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public static function doctorsByPatient($patientId): array
    {
        $stmt = self::db()->prepare("
            SELECT DISTINCT d.*
            FROM visits v
            JOIN doctors d ON d.id = v.doctor_id
            WHERE v.patient_id = ?
        ");

        $stmt->execute([$patientId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}