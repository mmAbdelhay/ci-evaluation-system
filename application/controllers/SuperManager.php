<?php

class SuperManager extends CI_Controller{
    public function register(){
        $data['title'] = "Register";

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header');
            $this->load->view('superManager/register', $data);
            $this->load->view('template/footer');
        } else {
            $enc_password = md5($this->input->post('password'));
            $this->superManager_model->register($enc_password);
            $this->session->set_flashdata('user_registered', 'you are registered successfully');
            redirect('pages/view');
        }
    }

    function check_email_exists($email){
        $this->form_validation->set_message(
            'check_email_exists', 'that email is taken please choose another one'
        );
        if ($this->superManager_model->check_email_exists($email)) {
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
            $this->load->view('superManager/login', $data);
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $user_id = $this->superManager_model->login($email, $password);
            if ($user_id) {
                $user_data = array(
                    'user_id' => $user_id,
                    'email' => $email,
                    'role' => 'superManager',
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('pages/view');
            } else {
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('superManager/login');
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('superManager/login');
    }

    public function allPendingEvaluation(){
        if($this->session->userdata('role') != 'superManager'){
            redirect('superManager/login');
        }
        $data['evaluations'] = $this->evaluation_model->getAllPendingEvaluation($this->session->userdata('user_id'));
        $this->load->view('template/header');
        $this->load->view('superManager/allPendingEvaluations', $data);
        $this->load->view('template/footer');
    }

    public function acceptEvaluation(){
        if($this->session->userdata('role') != 'superManager'){
            redirect('superManager/login');
        }
        $this->evaluation_model->acceptEvaluation($this->input->post('id'),$this->session->userdata('user_id'));
        $this->session->set_flashdata('evaluation_accepted', 'Evaluation accepted successfully');
        redirect('superManager/allPendingEvaluation');
    }

    public function rejectEvaluation(){
        if($this->session->userdata('role') != 'superManager'){
            redirect('superManager/login');
        }
        $this->evaluation_model->rejectEvaluation($this->input->post('id'),$this->session->userdata('user_id'));
        $this->session->set_flashdata('evaluation_rejected', 'Evaluation rejected successfully');
        redirect('superManager/allPendingEvaluation');
    }


}
