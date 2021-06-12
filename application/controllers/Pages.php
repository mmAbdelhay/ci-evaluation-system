<?php

class Pages extends CI_Controller
{
    public function view($page = 'home'){
        if(!$this->session->userdata('logged_in')){
            redirect('employee/login');
        }

        if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page);

        $this->load->view('template/header');
        $this->load->view('pages/home', $data);
        $this->load->view('template/footer');
    }
}
