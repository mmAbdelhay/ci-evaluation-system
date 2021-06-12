<?php

class Employee_model extends CI_Model{

    public function register($enc_password, $directManagerID){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $enc_password,
            'directManagerID' => $directManagerID,
        );

        return $this->db->insert('Employee', $data);
    }

    public function check_email_exists($email){
        $query = $this->db->get_where('Employee', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password){
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $result = $this->db->get('Employee');
        if($result->num_rows() == 1){
            return $result->row(0)->id;
        } else {
            return false;
        }
    }
}
