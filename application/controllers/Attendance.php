<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='Mbatch';
    }


    public function checkattendance()
    {
        $this->load->database();
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'NewScholarship';
        $this->load->view('check_attendance');
    }

    public function check_validate()
    {
        $this->load->database();
        $ids = explode("\n", trim($this->input->post('emp_no')));
        $result = $this->db->query('select group_concat(phone) phone from attendance where emp_code in ('.implode(',', $ids).')')->row();

        echo '<h4>Phone Numbers</h4><br>'.$result->phone;
    }
}
