<?php

class Evaluation_model extends CI_Model{

    public function evaluate($directManagerID){
        $data = $this->input->post(NULL, FALSE);
        unset($data['name']);
        unset($data['email']);
        $data['directManagerID'] = $directManagerID;
        $data['status'] = 'pending';
        return $this->db->insert('Evaluation', $data);
    }

    public function getAllPendingEvaluation($id){
        $query = $this->db->query("SELECT ev.id, e.name as empName, ev.empID ,d.name as directManagerName from Evaluation ev, Employee e, DirectManager d where ev.empID = e.id and e.directManagerID = d.id and ev.status = 'pending' and ev.directManagerID = (select id from DirectManager where superManagerID = $id)");
        if(empty($query->result())){
            return false;
        }else{
            return $query->result();
        }
    }

    public function acceptEvaluation($id, $superManagerID){
        $this->db->set('status','accepted');
        $this->db->set('superManagerID',$superManagerID);
        $this->db->where('id', $id);
        $this->db->update('Evaluation');
    }

    public function rejectEvaluation($id, $superManagerID){
        $this->db->set('status','rejected');
        $this->db->set('superManagerID',$superManagerID);
        $this->db->where('id', $id);
        $this->db->update('Evaluation');
    }

    public function getEvaluation($id){
        $query = $this->db->query("select ev.*, e.name as empName , e.email as empEmail ,e.id as empID,d.id as managerID , d.name as managerName , d.email as managerEmail from Evaluation ev , Employee e , DirectManager d where ev.empID = e.id and ev.directManagerID = d.id and ev.empID = $id");
        if(!empty($query->result())){
            unset($query->result()['password']);
            return $query->result();
        }else{
            return false;
        }
    }
}
