<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Headless extends CI_Controller
{
    public function qualification_search()
    {
        $this->load->view('_qualification_search');
    }
    public function beneficiary_search()
    {
        $this->load->database();
        $data['forane'] = $this->db->get('forane_master');
        $data['type'] = $this->input->post('type');
        $this->load->view('_adv_search_beneficiary', $data);
    }
    public function passbook_batch_search()
    {
        $this->load->database();
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('_adv_search_beneficiary_passbook', $data);
    }
    public function passbook_batch_search_laser()
    {
        $this->load->database();
        $this->load->helper('url');
        $data['site_url'] = base_url();
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('_adv_search_beneficiary_passbook_laser', $data);
    }

    public function corp_search()
    {
        $this->load->database();
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('_adv_search_corpfund', $data);
    }
    public function gettable()
    {
        $this->load->helper('url');
        $last = $this->uri->total_segments();
        $tbl = $this->uri->segment($last);
        $this->load->database();
        $data['columns'] = $this->db->query('show columns from '.$tbl);
        $this->load->view('_table_clolumn_filter', $data);
    }
    public function corpdonationhistory()
    {
        //	$this->output->enable_profiler(TRUE);
        $this->load->database();
        $this->load->helper('url');
        $last = $this->uri->total_segments();
        $id = $this->uri->segment($last);
        $donations = $this->db->query('select corp_id,voucher_number,transaction_date,narration,ledger_name,amount from corpus_transactions where corp_id='.$id);
        $data['donations'] = $donations->result();
        $data['show'] = 'donations';
        $this->load->view('_xhr', $data);
    }
    public function getbenstatus()
    {
        $this->load->database();
        $this->load->helper('url');
        $last = $this->uri->total_segments();
        $id = $this->uri->segment($last);
        $query = $this->db->get_where('closed_accounts', array('nes_id' => $id));
        $data['status'] = $query->row();
        if ($query->num_rows() < 1) {
            echo 'Account Active';
            return;
        }
        $this->load->view('_ben_status', $data);
    }
    public function add_fund()
    {
        $data['doner'] = $this->input->post('doner');
        $this->load->view('_add_fund', $data);
    }
}
