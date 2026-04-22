<?php

namespace Controller;

use Src\View;
use Src\Request;

class Visit
{
    public function index(Request $request): string
    {
        $filter = $request->get('filter') ?? '';
        $patientId = $request->get('patient_id') ? (int)$request->get('patient_id') : null;
        $doctorId = $request->get('doctor_id') ? (int)$request->get('doctor_id') : null;
        $date = $request->get('date') ?? null;
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
    public function create(Request $request): void
    {
        \Model\Visit::create($request->all());
        header('Location: /pop-it-mvc/visits');
        exit;
    }
    public function delete(Request $request): void
    {
        $id = (int) $request->get('id');
        \Model\Visit::delete($id);
        header('Location: /pop-it-mvc/visits');
        exit;
    }
}