<?php

class Doctors
{
    use Controller;
    public function index()
    {
        $doctor = new Doctor();
        
        $specialties = $doctor->distinct('d_specialty');
        $genders = $doctor->distinct('d_gender');
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = max($page, 1);
//        show($page);
        $all_doctors = $doctor->get_paginated(3, $page);
        
        
//        show($all_doctors);
        $this->view('doctors', [
            'all_doctors' => $all_doctors,
            'specialties' => $specialties,
            'genders' => $genders
        ]);
    }
}

