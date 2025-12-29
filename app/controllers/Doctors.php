<?php

class Doctors
{
    use Controller;
    public function index()
    {
        $doctor = new Doctor;
        
        $specialties = $doctor->distinct('d_specialty');
        $genders = $doctor->distinct('d_gender');
        $all_doctors = $doctor->find_all();
//        show($all_doctors);
        $this->view('doctors', [
            'all_doctors' => $all_doctors,
            'specialties' => $specialties,
            'genders' => $genders
        ]);
    }
}

