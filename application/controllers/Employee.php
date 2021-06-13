<?php

class Employee extends CI_Controller
{
    public function register()
    {

        if ($this->session->userdata('role') != 'directManager') {
            redirect('directManager/login');
        }

        $data['title'] = "Register";

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header');
            $this->load->view('employee/register', $data);
            $this->load->view('template/footer');
        } else {
            $enc_password = md5($this->input->post('password'));
            $directManagerID = $this->session->userdata('user_id');
            $this->employee_model->register($enc_password, $directManagerID);
            $this->session->set_flashdata('user_registered', 'employee registered successfully');
            redirect('pages/view');
        }
    }

    function check_email_exists($email)
    {
        $this->form_validation->set_message(
            'check_email_exists', 'that email is taken please choose another one'
        );
        if ($this->employee_model->check_email_exists($email)) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        $data['title'] = 'Login';

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header');
            $this->load->view('employee/login', $data);
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $user_id = $this->employee_model->login($email, $password);
            if ($user_id) {
                $user_data = array(
                    'user_id' => $user_id,
                    'email' => $email,
                    'role' => 'employee',
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

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('user_loggedout', 'You are now logged out');
        redirect('employee/login');
    }

    public function getEvaluation($id){
        if (!$this->session->userdata('logged_in')) {
            redirect('employee/login');
        }

        $data['employee'] = $this->evaluation_model->getEvaluation($id);
        $employee = $data['employee'][0];
        $employee->firstAvg = ((
                    (int)$employee->quality_of_work + (int)$employee->technical_skills + (int)$employee->creativity + (int)$employee->honesty + (int)$employee->attendance + (int)$employee->productivity + (int)$employee->independent_work + (int)$employee->communication + (int)$employee->integrity + (int)$employee->punctuality + (int)$employee->coworker_relations + (int)$employee->work_consistency
                ) / 60) * 5;
        $employee->totalScore = (($employee->firstAvg + (int)$employee->administrative) / 10) * 100;
        $this->load->view('template/header');
        $this->load->view('employee/evaluation', $employee);
        $this->load->view('template/footer');
    }

}
