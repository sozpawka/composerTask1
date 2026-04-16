<?php

namespace Controller;

use Src\View;

class Visit
{
    public function index(): string
    {
        $patientId = $_GET['patient_id'] ?? null;
        $visits = $patientId
            ? \Model\Visit::byPatient($patientId)
            : \Model\Visit::all();
        $patients = \Model\Patient::all();
        $doctors = \Model\Doctor::all();
        return (new View())->render('site.visits.index', [
            'visits' => $visits,
            'patients' => $patients,
            'doctors' => $doctors
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