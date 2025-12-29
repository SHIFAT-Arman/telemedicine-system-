<?php

class Signup
{
    use Controller;

    public function index()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            if ($user->validate($_POST)) {
                redirect('login');
            }
            $errors = $user->errors;
        }
        $this->view('signup', ['errors' => $errors]);

    }
}