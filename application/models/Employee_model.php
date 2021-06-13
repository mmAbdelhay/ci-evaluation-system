<?php

class Employee_model extends CI_Model
{

    public function register($enc_password, $directManagerID)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $enc_password,
            'directManagerID' => $directManagerID,
        );

        return $this->db->insert('Employee', $data);
    }

    public function check_email_exists($email)
    {
        $query = $this->db->get_where('Employee', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $result = $this->db->get('Employee');
        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    public function getAllNonEvaluatedEmployees($id, $period)
    {

        if ($period == 'first') {
            $firstOfTheYear = mktime(00, 00, 00, 01, 01, date('y'));
            $firstOfTheYearDate = date("Y-m-d h:i:s", $firstOfTheYear);
            $lastOfJune = mktime(00, 00, 00, 06, 30, date('y'));
            $lastOfJuneDate = date("Y-m-d h:i:s", $lastOfJune);
            $query = $this->db->query("select id, name, email from Employee where id not in (select empID from Evaluation where directManagerID = $id and status <> 'rejected' and createdAt between '$firstOfTheYearDate' and '$lastOfJuneDate')");
        } else {
            $firstOfJuly = mktime(00, 00, 00, 07, 01, date('y'));
            $firstOfJulyDate = date("Y-m-d h:i:s", $firstOfJuly);
            $lastOfTheYear = mktime(00, 00, 00, 12, 31, date('y'));
            $lastOfTheYearDate = date("Y-m-d h:i:s", $lastOfTheYear);
            $query = $this->db->query("select id, name, email from Employee where id not in (select empID from Evaluation where directManagerID = $id and status <> 'rejected' and createdAt between '$firstOfJulyDate' and '$lastOfTheYearDate')");
        }
        if (empty($query->result())) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function getAllEvaluatedEmployees($id)
    {
        $query = $this->db->query("SELECT * from Employee e, Evaluation ev where e.id = ev.empID and ev.status = 'accepted' and ev.directManagerID = $id");
        if (empty($query->result())) {
            return false;
        } else {
            unset($query->result()['password']);
            return $query->result();
        }
    }

    public function checkIfHisEmployee($empID, $directManagerID)
    {
        $query = $this->db->get_where('Employee', array('directManagerID' => $directManagerID));
        $employees = $query->result();
        foreach ($employees as $employee) {
            if ($employee->id == $empID) {
                return true;
            }
        }
        return false;
    }
}
