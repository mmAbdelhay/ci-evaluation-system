<?php

class Evaluation extends CI_Controller{

    public function evaluate(){
        if ($this->session->userdata('role') != 'directManager') {
            redirect('directManager/login');
        }
        $checkIfHisEmployee = $this->employee_model->checkIfHisEmployee($this->input->post('id'), $this->session->userdata('user_id'));
        if($checkIfHisEmployee){
            $data['id'] = $this->input->post('id');
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->load->view('template/header');
            $this->load->view('evaluation/evaluation', $data);
            $this->load->view('template/footer');
        }else{
            show_error('dont play');
        }
    }

    public function submitEvaluation(){
        if ($this->session->userdata('role') != 'directManager') {
            redirect('directManager/login');
        }
        $this->form_validation->set_rules('period', 'Period', 'required|callback_check_period');
        $this->form_validation->set_rules('administrative', 'Administrative', 'required|callback_check_range');
        $this->form_validation->set_rules('quality_of_work', 'Quality of work', 'required|callback_check_range');
        $this->form_validation->set_rules('technical_skills', 'Technical skills', 'required|callback_check_range');
        $this->form_validation->set_rules('creativity', 'Creativity', 'required|callback_check_range');
        $this->form_validation->set_rules('honesty', 'Honesty', 'required|callback_check_range');
        $this->form_validation->set_rules('attendance', 'Attendance', 'required|callback_check_range');
        $this->form_validation->set_rules('productivity', 'Productivity', 'required|callback_check_range');
        $this->form_validation->set_rules('independent_work', 'Independent work', 'required|callback_check_range');
        $this->form_validation->set_rules('communication', 'Communication', 'required|callback_check_range');
        $this->form_validation->set_rules('integrity', 'Integrity', 'required|callback_check_range');
        $this->form_validation->set_rules('punctuality', 'Punctuality', 'required|callback_check_range');
        $this->form_validation->set_rules('coworker_relations', 'Coworker relations', 'required|callback_check_range');
        $this->form_validation->set_rules('work_consistency', 'Work consistency', 'required|callback_check_range');

        if ($this->form_validation->run() === FALSE) {

            $data['id'] = $this->input->post('id');
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->load->view('template/header');
            $this->load->view('evaluation/evaluation', $data);
            $this->load->view('template/footer');
        } else {
            $directManagerID = $this->session->userdata('user_id');
            $this->evaluation_model->evaluate($directManagerID);
            redirect('directManager/index');
        }

    }

    function check_range($value){
        $this->form_validation->set_message(
            'check_range', 'All ranges must be from 1 to 5'
        );
        if((int)$value < 1 || (int)$value > 5){
            return false;
        }else{
            return true;
        }
    }
    function check_period($period): bool {
        $this->form_validation->set_message(
            'check_period', 'Period must be either first or second'
        );
        if($period == 'first' || $period == 'second'){
            return true;
        }else{
            return false;
        }
    }

    public function getpdf($id){
        if (!$this->session->userdata('logged_in')) {
            redirect('employee/login');
        }

        $data['employee'] = $this->evaluation_model->getEvaluation($id);
        $employee = $data['employee'][0];
        $employee->firstAvg = ((
                    (int)$employee->quality_of_work + (int)$employee->technical_skills + (int)$employee->creativity + (int)$employee->honesty + (int)$employee->attendance + (int)$employee->productivity + (int)$employee->independent_work + (int)$employee->communication + (int)$employee->integrity + (int)$employee->punctuality + (int)$employee->coworker_relations + (int)$employee->work_consistency
                ) / 60) * 5;
        $employee->totalScore = (($employee->firstAvg + (int)$employee->administrative) / 10) * 100;

        $this->load->view('employee/evaluationPDF',$employee);
        $html = $this->output->get_output();
        $this->load->library('Pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream("$employee->empName-$employee->createdAt-evaluation.pdf", array("Attachment"=>0));
    }
}
