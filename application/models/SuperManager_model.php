<?php

class SuperManager_model extends CI_Model{

    public function register($enc_password){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $enc_password,
        );

        return $this->db->insert('SuperManager', $data);
    }

    public function check_email_exists($email){
        $query = $this->db->get_where('SuperManager', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password){
        $result = $this->db->get_where('SuperManager',array('email'=>$email, 'password'=>$password));
        if(empty($result->row_array())){
            return false;
        }else{
            return $result->row_array()['id'];
        }
    }

}
