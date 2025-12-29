<?php

class Filter
{
    use Controller;

    public static function AdminFilter($params)
    {
        if ($_SESSION['role'] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    // doctor filter
    public static function DoctorFilter($params)
    {
        if ($_SESSION['role'] == 'doctor') {
            return true;
        } else {
            return false;
        }
    }
}