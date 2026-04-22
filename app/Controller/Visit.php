<?php

namespace Controller;

use Src\View;
use Src\Request;

class Visit
{
    public function index(Request $request): string
    {
        $filter = $request->get('filter') ?? '';
        $search = $request->get('search') ?? '';
        $patientId = $request->get('patient_id') ? (int)$request->get('patient_id') : null;
        $doctorId = $request->get('doctor_id') ? (int)$request->get('doctor_id') : null;
        $date = $request->get('date') ?? null;
        $mode = 'visits';
        $visits = [];
        $doctorsByPatient = [];

       if (!empty($search)) {
            $allVisits = \Model\Visit::all();
            $visits = [];
            $search = mb_strtolower($search);
            foreach ($allVisits as $v) {
                $pName = mb_strtolower(($v['patient_last'] ?? '') . ' ' . ($v['patient_first'] ?? ''));
                $dName = mb_strtolower(($v['doctor_last'] ?? '') . ' ' . ($v['doctor_first'] ?? ''));
                $pos = mb_strtolower($v['doctor_position'] ?? '');
                if (str_contains($pName, $search) || str_contains($dName, $search) || str_contains($pos, $search)) {
                    $visits[] = $v;
                }
            }
        }
        elseif ($filter === 'patient') {
            $visits = \Model\Visit::all(['patient_id' => $patientId]);
        } 
        elseif ($filter === 'doctor') {
            $visits = \Model\Visit::all(['doctor_id' => $doctorId, 'date' => $date]);
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
            'search' => $search,
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