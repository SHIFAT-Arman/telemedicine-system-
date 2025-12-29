<?php

class _404 
{
    use Controller;
    
    public function index()
    {
        var_dump($_SESSION);
        $this->view('404');
    }
}