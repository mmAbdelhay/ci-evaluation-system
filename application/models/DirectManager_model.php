<?php

class DirectManager_model extends CI_Model{

    public function register($enc_password, $superManagerID){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $enc_password,
            'superManagerID' => $superManagerID,
        );

        return $this->db->insert('DirectManager', $data);
    }

    public function check_email_exists($email){
        $query = $this->db->get_where('DirectManager', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password){
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $result = $this->db->get('DirectManager');
        if($result->num_rows() == 1){
            return $result->row(0)->id;
        } else {
            return false;
        }
    }
}
