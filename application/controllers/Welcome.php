<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        $this->load->database();

        $query = $this->db->query('select count(id) active from member where status = "active"');
        $data['active'] = $query->row();
        $data['active'] = $data['active']->active;
        $query = $this->db->query('select count(id) closed from member where status = "closed"');
        $data['closed'] = $query->row();
        $data['closed'] = $data['closed']->closed;
        $query = $this->db->query('select count(id) nidhi from member where is_nidhi = 1');
        $data['nidhi'] = $query->row();
        $data['nidhi'] = $data['nidhi']->nidhi;
        $query = $this->db->query('select count(id) notnidhi from member where is_nidhi != 1');
        $data['notnidhi'] = $query->row();
        $data['notnidhi'] = $data['notnidhi']->notnidhi;
        $this->load->view('welcome_message', $data);
    }
}
