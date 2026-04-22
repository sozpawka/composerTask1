<?php

namespace Controller;

use Src\Auth\Auth;
use Src\View;
use Src\Validator\Validator;

class Patient
{
    private function auth()
    {
        return Auth::user();
    }

    public function index(): string
    {
        if (!$this->auth()) {
            header('Location: /pop-it-mvc/login');
            exit;
        }
        $patients = \Model\Patient::all();
        return (new View())->render('site.patients.index', ['patients' => $patients]);
    }

    public function create(): string
    {
        if (!$this->auth()) {
            header('Location: /pop-it-mvc/login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator($_POST, [
                'last_name' => ['required'],
                'first_name' => ['required'],
                'birth_date' => ['required']
            ], [
                'required' => 'Поле :field должно быть заполнено'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.patients.create', [
                    'message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)
                ]);
            }

            \Model\Patient::create($_POST);
            header('Location: /pop-it-mvc/patients');
            exit;
        }
        return (new View())->render('site.patients.create');
    }
}