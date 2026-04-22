<?php

namespace Controller;

use Src\View;
use Src\Validator\Validator;

class Doctor
{
    public function index(): string
    {
        $doctors = \Model\Doctor::all();
        return (new View())->render('site.doctors.index', ['doctors' => $doctors]);
    }
    public function create(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator($_POST, [
                'last_name' => ['required'],
                'first_name' => ['required'],
                'specialization' => ['required']
            ], [
                'required' => 'Укажите :field врача'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.doctors.create', [
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]);
            }

            \Model\Doctor::create($_POST);
            header('Location: /pop-it-mvc/doctors');
            exit;
        }

        return (new View())->render('site.doctors.create');
    }
}