<?php

namespace Controller;

use Src\View;

class Visit
{
    public function index(): string
    {
        $filter = $_GET['filter'] ?? '';
        $patientId = $_GET['patient_id'] ?? null;
        $doctorId = $_GET['doctor_id'] ?? null;
        $date = $_GET['date'] ?? null;
        $mode = 'visits';
        $visits = [];
        $doctorsByPatient = [];

        if ($filter === 'patient') {
            $visits = \Model\Visit::all([
                'patient_id' => $patientId
            ]);
        }

        elseif ($filter === 'doctor') {
            $visits = \Model\Visit::all([
                'doctor_id' => $doctorId,
                'date' => $date
            ]);
        }

        elseif ($filter === 'patient_doctors') {
            $mode = 'doctors';
            $doctorsByPatient = \Model\Visit::doctorsByPatient($patientId);
        }

        else {
            $visits = \Model\Visit::all();
        }
        $patients = \Model\Patient::all();
        $doctors = \Model\Doctor::all();
        return (new View())->render('site.visits.index', [
            'visits' => $visits,
            'doctorsByPatient' => $doctorsByPatient,
            'patients' => $patients,
            'doctors' => $doctors,
            'filter' => $filter,
            'mode' => $mode,
            'selectedPatient' => $patientId,
            'selectedDoctor' => $doctorId,
            'selectedDate' => $date
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