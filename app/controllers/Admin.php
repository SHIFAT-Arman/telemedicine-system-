<?php
class Admin
{
    use Controller;

    function index()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        require_login();

        $user = get_user();

        if ($user->role != 'admin') {
            redirect('login');
        }
        $this->view('admin/dashboard');
    }
}