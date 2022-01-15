<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Statutory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu'] = 'Mstatutory';
    }

    public function registerofmembers()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        if (isset($_GET['range'])) {
            $range = explode('-', $this->input->get('range'));
            $data['range']   = $range;
            $data['members'] = $this->db->query('select s.*, m.nominee_name, m.temporary_address, sh.shares from (select n.id memid, date(n.entry_date) membership_date, n.member_name, p.* from nidhi_member n left join parent_master p on p.share_member_id = n.id) s, member m, (select count(id) shares, member_id from nidhi_share_pool group by member_id) sh where s.memid = m.share_member_id and sh.member_id = s.memid and s.memid between '.$range[0].' and '.$range[1].' order by s.memid')->result();
            $data['shares']  = $this->db->query('select * from share_certificates where member_id between '.$range[0].' and '.$range[1])->result_array();
            $this->load->view('register_of_members', $data);
        } else {
            $this->load->view('register_of_members');
        }
    }

    public function registerofshareapplication()
    {
        $this->load->database();

        if (isset($_GET['range'])) {
            $range = explode('-', $this->input->get('range'));
            $data['range'] = $range;
            $data['members'] = $this->db->query('select s.*,p.* from (select c.*,c.id "certid", m.receipt_date from share_certificates c left join member m on c.holder_id = m.old_id where c.id between '.$range[0].' and '.$range[1].' ) s left join parent_master p on s.member_id = p.share_member_id order by s.id ')->result();
            $this->load->view('register_of_shares', $data);
        } else {
            $this->load->view('register_of_shares');
        }
    }

    public function registerofsharetransfer()
    {
        $this->load->database();

        if (isset($_GET['range'])) {
            $range = explode('-', $this->input->get('range'));
            $data['range'] = $range;
            $data['members'] = $this->db->query('select s.*,p.* from (select c.*,c.id "certid", m.receipt_date from share_certificates c left join member m on c.holder_id = m.old_id where c.id between '.$range[0].' and '.$range[1].' ) s left join parent_master p on s.member_id = p.share_member_id order by s.id ')->result();
            $this->load->view('register_of_share_transfer', $data);
        } else {
            $this->load->view('register_of_share_transfer');
        }
    }
    private function makedate($dt)
    {
        $newdt = explode('/', $dt);
        return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
    }
}
