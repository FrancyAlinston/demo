<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='login';
    }

    public function index()
    {
        $_SESSION['s_menu'] ='BatchList';
        $this->load->view('login');
    }

    public function validate()
    {
        $this->load->database();
        $query=$this->db->get_where(
            'users',
            array(
                 'name' => $this->input->post('txtUser'),
                 'password'  => $this->input->post('txtPwd')
      )
        );

        if ($query->num_rows() > 0) {
            $login = $query->row();
            $_SESSION['user'] = $login->full_name;
            echo 'success|'.$login->home_page;
        }
        //$_SESSION['s_menu'] ='BatchList';
        //$this->load->view('login');
    }
}
