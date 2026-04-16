<?php

namespace Controller;

use Src\View;

class Visit
{
    public function index(): string
    {
        $visits = \Model\Visit::all();
        $patients = \Model\Patient::all();
        $doctors = \Model\Doctor::all();

        return (new View())->render('site.visits.index', [
            'visits' => $visits,
            'patients' => $patients,
            'doctors' => $doctors
        ]);
    }
    public function create()
    {
        \Model\Visit::create([
            'patient_id' => $_POST['patient_id'],
            'doctor_id' => $_POST['doctor_id'],
            'visit_date' => $_POST['visit_date']
        ]);
        header('Location: /pop-it-mvc/visits');
        exit;
    }
    public function delete()
    {
        \Model\Visit::delete($_POST['id']);
        header('Location: /pop-it-mvc/visits');
        exit;
    }
}