<?php

namespace Controller;

use Src\View;

class Visit
{
    public function index(): string
    {
        $filter = $_GET['filter'] ?? null;
        $patientId = $_GET['patient_id'] ?? null;
        $doctorId = $_GET['doctor_id'] ?? null;
        $date = $_GET['date'] ?? null;

        if ($filter === 'patient') {
            if (!empty($patientId)) {
                $visits = \Model\Visit::byPatient($patientId);
            } else {
                $visits = \Model\Visit::all();
            }
        } elseif ($filter === 'doctor') {
            if (!empty($doctorId) && !empty($date)) {
                $visits = \Model\Visit::byDoctorAndDate($doctorId, $date);
            } else {
                $visits = \Model\Visit::all();
            }
        } else {
            $visits = \Model\Visit::all();
        }
        $patients = \Model\Patient::all();
        $doctors = \Model\Doctor::all();
        return (new View())->render('site.visits.index', [
            'visits' => $visits,
            'patients' => $patients,
            'doctors' => $doctors,
            'selectedPatient' => $patientId,
            'selectedDoctor' => $doctorId,
            'selectedDate' => $date,
            'filter' => $filter
        ]);
    }
    public function create(): void
    {
        \Model\Visit::create($_POST);
        header('Location: /pop-it-mvc/visits');
        exit;
    }
    public function delete(): void
    {
        \Model\Visit::delete($_POST['id']);
        header('Location: /pop-it-mvc/visits');
        exit;
    }
}