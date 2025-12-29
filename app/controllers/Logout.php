<?php

class Logout
{
    use Controller;
    public function index(){
        if(isset($_SESSION)){
            session_unset();
            session_destroy();
            redirect('login');
        }
    }
}
