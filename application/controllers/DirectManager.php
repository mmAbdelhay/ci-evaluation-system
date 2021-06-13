<?php

class DirectManager extends CI_Controller{
    public function register(){

        if($this->session->userdata('role') != 'superManager'){
            redirect('superManager/login');
        }

        $data['title'] = "Register";

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header');
            $this->load->view('directManager/register', $data);
            $this->load->view('template/footer');
        } else {
            $enc_password = md5($this->input->post('password'));
            $superManagerID = $this->session->userdata('user_id');
            $this->directManager_model->register($enc_password, $superManagerID);
            $this->session->set_flashdata('user_registered', 'direct manager registered successfully');
            redirect('pages/view');
        }
    }

    function check_email_exists($email){
        $this->form_validation->set_message(
            'check_email_exists', 'that email is taken please choose another one'
        );
        if ($this->directManager_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function login(){
        $data['title'] = 'Login';

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header');
            $this->load->view('directManager/login', $data);
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $user_id = $this->directManager_model->login($email, $password);
            if ($user_id) {
                $user_data = array(
                    'user_id' => $user_id,
                    'email' => $email,
                    'role' => 'directManager',
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('pages/view');
            } else {
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('directManager/login');
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('directManager/login');
    }

    public function index(){
        if($this->session->userdata('role') != 'directManager'){
            redirect('directManager/login');
        }

        if (date("Y-m-d") >= date('Y-06-30')){
            $period = 'second';
        }else{
            $period = 'first';
        }
        $data['employees'] = $this->employee_model->getAllNonEvaluatedEmployees($this->session->userdata('user_id'),$period);
        $this->load->view('template/header');
        $this->load->view('directManager/allNonEvaluated', $data);
        $this->load->view('template/footer');
    }

    public function getAllEvaluatedEmployees(){
        if($this->session->userdata('role') != 'directManager'){
            redirect('directManager/login');
        }
        $data['employees'] = $this->employee_model->getAllEvaluatedEmployees($this->session->userdata('user_id'));
        foreach ($data['employees'] as $employee){
            $employee->firstAvg = ((
                        (int)$employee->quality_of_work + (int)$employee->technical_skills + (int)$employee->creativity + (int)$employee->honesty + (int)$employee->attendance + (int)$employee->productivity + (int)$employee->independent_work + (int)$employee->communication + (int)$employee->integrity + (int)$employee->punctuality + (int)$employee->coworker_relations + (int)$employee->work_consistency
                    ) / 60) * 5;
            $employee->totalScore = (((int)$employee->firstAvg + (int)$employee->administrative) / 10) * 100;
        }
        $this->load->view('template/header');
        $this->load->view('directManager/allEvaluated', $data);
        $this->load->view('template/footer');
    }
}
