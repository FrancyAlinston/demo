<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Staff extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Staff_model', 'neftaccountclosed');
    }
    public function index() {
        $data['page'] = 'staff-list';
        $data['title'] = 'Datatables Add Edit Delete with CodeIgniter and Ajax';
        $this->load->view('staff/index', $data);
    }

    public function getStaffListing(){
        $json = array();
        $list = $this->neftaccountclosed->getStaffList();
        $data = array();
        foreach ($list as $element) {
            $row = array();
            $row[] = $element['id'];
            $row[] = $element['nes_id'];
            $row[] = $element['acnumber'];
            $row[] = $element['ifsc'];
            $row[] = $element['branchid'];
            $row[] = $element['bank_name'];
            $data[] = $row;
        }
        $json['data'] = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->neftaccountclosed->countAll(),
            "recordsFiltered" => $this->neftaccountclosed->countFiltered(),
            "data" => $data,
        );
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json['data']);
    }
    public function save() {
        $json = array();
        $nes_id = $this->input->post('name');
        $acnumber = $this->input->post('email');
        $ifsc = $this->input->post('address');
        $branchid = $this->input->post('mobile');
        $bank_name = $this->input->post('salary');

        // if(empty(trim($nes_id))){
        //     $json['error']['name'] = 'Please enter name';
        // }
        //
        // if(empty(trim($acnumber))){
        //     $json['error']['email'] = 'Please enter email address';
        // }

        // if ($this->staff->validateEmail($email) == FALSE) {
            // $json['error']['email'] = 'Please enter valid email address';
        // }
        // if(empty($ifsc)){
        //     $json['error']['address'] = 'Please enter address';
        // }
        // if($this->staff->validateMobile($mobile) == FALSE) {
        //     $json['error']['mobile'] = 'Please enter valid mobile no';
        // }

        // if(empty($bank_name)){
        //     $json['error']['salary'] = 'Please enter salary';
        // }

        if(empty($json['error'])){
            $this->neftaccountclosed->setName($nes_id);
            $this->neftaccountclosed->setEmail($acnumber);
            $this->neftaccountclosed->setAddress($ifsc);
            $this->neftaccountclosed->setSalary($branchid);
            $this->neftaccountclosed->setMobile($bank_name);
            try {
                $last_id = $this->neftaccountclosed->createStaff();
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            if (!empty($last_id) && $last_id > 0) {
                $neftaccountclosedID = $last_id;
                $this->neftaccountclosed->setStaffID($neftaccountclosedID);
                $staffInfo = $this->neftaccountclosed->getStaff();
                $json['staff_id'] = $staffInfo['id'];
                $json['name'] = $staffInfo['name'];
                $json['email'] = $staffInfo['email'];
                $json['address'] = $staffInfo['address'];
                $json['mobile'] = $staffInfo['mobile'];
                $json['salary'] = $staffInfo['salary'];
                $json['status'] = 'success';
            }
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    public function edit() {
        $json = array();
        $neftaccountclosedID = $this->input->post('neftaccountclosed_id');
        $this->neftaccountclosed->setStaffID($neftaccountclosedID);
        $json['staffInfo'] = $this->neftaccountclosed->getStaff();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('staff/popup/renderEdit', $json);
    }
    public function update() {
        $json = array();
        $neftaccountclosed_id = $this->input->post('neftaccountclosed_id');
        $nes_id = $this->input->post('nes_id');
        $acnumber = $this->input->post('email');
        $ifsc = $this->input->post('address');
        $branchid = $this->input->post('mobile');
        $bank_name = $this->input->post('salary');

        // if(empty(trim($nes_id))){
        //     $json['error']['name'] = 'Please enter name';
        // }
        //
        // if(empty(trim($acnumber))){
        //     $json['error']['email'] = 'Please enter email address';
        // }

        // if ($this->neftaccountclosed->validateEmail($acnumber) == FALSE) {
        //     $json['error']['email'] = 'Please enter valid email address';
        // }
        // if(empty($ifsc)){
        //     $json['error']['address'] = 'Please enter address';
        // }
        // if($this->neftaccountclosed->validateMobile($branchid) == FALSE) {
        //     $json['error']['mobile'] = 'Please enter valid mobile no';
        // }

        // if(empty($bank_name)){
        //     $json['error']['salary'] = 'Please enter salary';
        // }

        if(empty($json['error'])){
            $this->neftaccountclosed->setStaffID($neftaccountclosed_id);
            $this->neftaccountclosed->setName($nes_id);
            $this->neftaccountclosed->setEmail($acnumber);
            $this->neftaccountclosed->setAddress($ifsc);
            $this->neftaccountclosed->setSalary($bank_name);
            $this->neftaccountclosed->setMobile($branchid);
            try {
                $last_id = $this->neftaccountclosed->updateStaff();;
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            if (!empty($neftaccountclosed_id) && $neftaccountclosed_id > 0) {
                $this->neftaccountclosed->setStaffID($neftaccountclosed_id);
                $staffInfo = $this->neftaccountclosed->getStaff();
                $json['neftaccountclosed_id'] = $staffInfo['id'];
                $json['name'] = $staffInfo['name'];
                $json['email'] = $staffInfo['email'];
                $json['address'] = $staffInfo['address'];
                $json['mobile'] = $staffInfo['mobile'];
                $json['salary'] = $staffInfo['salary'];
                $json['status'] = 'success';
            }
        }
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
    public function display() {
        $json = array();
        $neftaccountclosedID = $this->input->post('neftaccountclosed_id');
        $this->neftaccountclosed->setStaffID($neftaccountclosedID);
        $json['staffInfo'] = $this->neftaccountclosed->getStaff();

        $this->output->set_header('Content-Type: application/json');
        $this->load->view('staff/popup/renderDisplay', $json);
    }
    public function delete() {
        $json = array();
        $neftaccountclosedID = $this->input->post('neftaccountclosed_id');
        $this->neftaccountclosed->setStaffID($neftaccountclosedID);
        $this->neftaccountclosed->deleteStaff();
        $this->output->set_header('Content-Type: application/json');
        echo json_encode($json);
    }
}
