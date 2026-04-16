<?php

namespace Controller;

use Src\View;

class Doctor
{
    public function index(): string
    {
        $doctors = \Model\Doctor::all();

        return (new View())->render('site.doctors.index', [
            'doctors' => $doctors
        ]);
    }
    public function create(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            \Model\Doctor::create([
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'] ?? null,
                'birth_date' => $_POST['birth_date'],
                'position' => $_POST['position'],
                'specialization' => $_POST['specialization']
            ]);

            header('Location: /pop-it-mvc/doctors');
            exit;
        }

        return (new View())->render('site.doctors.create');
    }
}