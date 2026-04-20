<?php

namespace Controller;

use Src\Auth\Auth;
class Patient
{
    private function auth()
    {
        return Auth::user();
    }
    public function index(): string
    {
        $user = $this->auth();
        if (!$user) {
            header('Location: /pop-it-mvc/login');
            exit;
        }
        $patients = \Model\Patient::all();
        return (new \Src\View())->render('site.patients.index', [
            'patients' => $patients
        ]);
    }
    public function create(): string
    {
        $user = $this->auth();
        if (!$user) {
            header('Location: /pop-it-mvc/login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            \Model\Patient::create([
                'last_name' => $_POST['last_name'] ?? '',
                'first_name' => $_POST['first_name'] ?? '',
                'middle_name' => $_POST['middle_name'] ?? '',
                'birth_date' => $_POST['birth_date'] ?? ''
            ]);

            header('Location: /pop-it-mvc/patients');
            exit;
        }
        return (new \Src\View())->render('site.patients.create');
    }
}