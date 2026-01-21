<?php


class Appointment
{
    use Model;

    protected $table = 'appointments';
    protected $allowedColumns = [
        'p_id',
        'd_id',
        'appointment_date',
        'appointment_time',
        'creation_date'
    ];

    // specify which columns are allowed to be inserted or updated


    public function getPatientsByDoctor($d_reg_no)
    {
        $query = "SELECT p.*, a.appointment_date, a.appointment_time FROM appointments a JOIN patients p ON a.p_nid_no = p.p_nid_no WHERE a.d_reg_no = ? ORDER BY a.appointment_date DESC";

        $conn = $this->connect();
        $stmt = $conn->prepare($query);
        if (!$stmt){
            return [];
        }
        if ($stmt) {
            // bind parameter
            $stmt->bind_param("i", $d_reg_no);

            // execute
            $stmt->execute();

            // fetch result
            $result = $stmt->get_result();
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // cleanup
            $stmt->close();
            $conn->close();
            return $data;
        }
    }
    public function getDoctorsByPatient($p_nid_no)
    {
        $query = "SELECT d.*, a.appointment_date, a.appointment_time FROM appointments a JOIN doctors d ON a.d_reg_no = d.d_reg_no WHERE a.p_nid_no = ? ORDER BY a.appointment_date DESC";

        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // bind parameter
            $stmt->bind_param("i", $p_nid_no);

            // execute
            $stmt->execute();

            // fetch result
            $result = $stmt->get_result();
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // cleanup
            $stmt->close();
            $conn->close();

            return $data;
        }

        return false;
    }
}