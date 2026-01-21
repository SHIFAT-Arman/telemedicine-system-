<?php

class PatientPortal
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
//        show($user);
        if ($user->role != 'patient') {
            redirect('login');
        }
        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $user->p_nid_no]);

        $announcement = new Announcement();
        $announcements = $announcement->find_all(1);
        
        $appointment = new Appointment();
        $appointments = $appointment->where(['p_nid_no' => $patient_data['p_nid_no']]);
        if (!$appointments) {
            $data = [
                'appointments_count' => 0,
                'announcements' => $announcements[0]['text'] ?? null
            ];
            $this->view('patient/dashboard', $data);
            return;
        }
        $doctors_with_appointments = $appointment->getDoctorsByPatient($appointments['p_nid_no']);
//        show($user);
//        show();
//        show($patient_data);

        $data = [
            'appointments_count' => count($doctors_with_appointments),
            'announcements' => $announcements[0]['text'] ?? null
        ];
        $this->view('patient/dashboard', $data);
    }

    public function manage_appointments()
    {
        require_login();
        $user = get_user();

        if ($user->role != 'patient') {
            redirect('login');
        }
        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $user->p_nid_no]);
                
        $appointment = new Appointment;
        $appointments = $appointment->where(['p_nid_no' => $patient_data['p_nid_no']]);
        
        if (!$appointments) {
            $data = [
                '$appointment_data' => [],
                'doctor_data' => [],
            ];
            $this->view('patient/manage_appointments', $data);
            return;
        }
        $doctors_with_appointments = $appointment->getDoctorsByPatient($appointments['p_nid_no']);
        $data = [
            '$appointment_data' => $appointments,
            'doctor_data' => $doctors_with_appointments,
        ];

        $this->view('patient/manage_appointments', $data);
    }

    public function profile()
    {
        require_login();
        $user = get_user();

        if ($user->role != 'patient') {
            redirect('login');
        }

        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $user->p_nid_no]);

        $data = [
            'p_nid_no' => $patient_data['p_nid_no'],
            'p_first_name' => $patient_data['p_first_name'],
            'p_last_name' => $patient_data['p_last_name'],
            'p_birth_date' => $patient_data['p_birth_date'],
            'p_gender' => $patient_data['p_gender'],
            'is_sensory_disabled' => $patient_data['is_sensory_disabled'],
            'p_email' => $patient_data['p_email'],
            'p_password' => $patient_data['p_password'],
            'p_phone_no' => substr($patient_data['p_phone_no'], 4),
            'p_address' => $patient_data['p_address'],
            'p_blood_group' => $patient_data['p_blood_group']
        ];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-type: application/json');
            $updatedData = [
                'p_nid_no' => $_POST['p_nid_no'],
                'p_first_name' => $_POST['p_first_name'],
                'p_last_name' => $_POST['p_last_name'],
                'p_birth_date' => $_POST['p_birth_date'],
                'p_gender' => $_POST['p_gender'],
                'is_sensory_disabled' => $_POST['is_sensory_disabled'],
                'p_email' => $_POST['p_email'],
                'p_password' => $_POST['p_password'],
                'p_phone_no' => $_POST['p_phone_no'],
                'p_address' => $_POST['p_address'],
                'p_blood_group' => $_POST['p_blood_group']
            ];
            $errors = validate_core_patient($updatedData);
            if(!empty($errors)){
                echo json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]);
                exit;
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'Profile updated successfully'
            ]);
            $patient->update($patient_data['p_nid_no'], $updatedData, 'p_nid_no');
            exit;
        }

        $this->view('patient/profile', $data = [
            'data' => $patient_data
        ]);
    }
    public function view_report()
    {
        require_login();
        $user = get_user();
        if ($user->role != 'patient') {
            redirect('login');
        }
        $d_reg_no = $_GET['d_reg_no'] ?? null;
        if (!$d_reg_no) {
            redirect('patientPortal/manage_appointments');
        }
        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $user->p_nid_no]);
        if (!$patient_data) {
            redirect('patientPortal/manage_appointments');
        }
        $report = new Report();
        $report_data = $report->first(['d_reg_no' => $d_reg_no]);
        if (!$report_data) {
            redirect('patientPortal/manage_appointments');
        }
        $doctor = new Doctor();
        $doctor_data = $doctor->first(['d_reg_no' => $d_reg_no]);
        if (!$doctor_data) {
            redirect('patientPortal/manage_appointments');
        }
        $data = [
            'patient_data' => $patient_data,
            'doctor_data' => $doctor_data,
            'report_data' => $report_data
        ];
        $this->view('patient/view_report', $data);
    }
}