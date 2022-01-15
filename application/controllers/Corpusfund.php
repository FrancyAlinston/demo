<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Corpusfund extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='Mcorpusfund';
    }

    public function add()
    {
        $this->load->database();
        $data['forane'] = $this->db->get('forane_master');
        $_SESSION['s_menu'] = "AddDonor";
        $this->load->view('add_donor', $data);
    }

    public function add_()
    {
        $this->load->database();
        //$this->output->enable_profiler(TRUE);
        $benData=array('donor' => $this->input->post('txtDonName'),
            'in_memory' => $this->input->post('txtInMemory'),
            'edu_forum' => $this->input->post('txtEduFrm'),
            'directory_page' => $this->input->post('txtDirPage'),
            'ppt_page' => $this->input->post('txtPPTPage'),
            'don_picture' => $this->input->post('txtDonorPicture'),
            'inmem_picture' => $this->input->post('txtinMemoryPicture'),
            'donor_address' => $this->input->post('txtDonorAddress'),
            'nominee_address' => $this->input->post('txtNomineeAddress'),
            'phone' => $this->input->post('txtPhone'),
            'email' => $this->input->post('txtEmail'),
            'status_text' => $this->input->post('txtStatusTxt')
        );

        if ($this->input->post('txtStatus') != '') {
            $benData['status'] = $this->makedate($this->input->post('txtStatus'));
        }

        if ($this->db->insert('corpus_fund', $benData)) {
            echo $this->db->insert_id();
        }
    }

    public function donors()
    {
        $this->load->database();
        $data['donor'] = $this->db->query('select * from corpus_fund order by donor asc');
        $_SESSION['s_menu'] = 'DonorList';
        $this->load->view('donor_list', $data);
    }

    public function update_()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();

        $benData=array('donor' => $this->input->post('txtDonName'),
            'in_memory' => $this->input->post('txtInMemory'),
            'edu_forum' => $this->input->post('txtEduFrm'),
            'directory_page' => $this->input->post('txtDirPage'),
            'ppt_page' => $this->input->post('txtPPTPage'),
            'don_picture' => $this->input->post('txtDonorPicture'),
            'inmem_picture' => $this->input->post('txtinMemoryPicture'),
            'donor_address' => $this->input->post('txtDonorAddress'),
            'nominee_address' => $this->input->post('txtNomineeAddress'),
            'status_text' => $this->input->post('txtStatusTxt'),
            'phone' => $this->input->post('txtPhone'),
            'email' => $this->input->post('txtEmail')
        );

        if ($this->input->post('txtStatus') != '') {
            $benData['status'] = $this->makedate($this->input->post('txtStatus'));
        }

        $this->db->where('id', $this->input->post('txtDId'));

        if ($this->db->update('corpus_fund', $benData)) {
            echo $this->input->post('txtDId');
        }
    }

    public function view()
    {
        $this->load->database();
        $this->load->helper('url');
        $last = $this->uri->total_segments();
        $id = $this->uri->segment($last);
        $data['mode'] = 'view';
        $query = $this->db->get_where('corpus_fund', array('id' => $id));
        $data['corpusfund'] = $query->row();
        $_SESSION['s_menu'] = "EditCorpusfund";
        $this->load->view('edit_donor', $data);
    }

    public function advancedsearch()
    {
        $this->load->database();
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('adv_search_beneficiary', $data);
    }

    public function removephoto()
    {
        $this->load->database();
        if ($this->db->query('update corpus_fund set '.$this->input->post('type').' = "" where id='.$this->input->post('id'))) {
            echo "success";
        }
    }

    public function addfund()
    {
        $this->load->database();
        //$this->output->enable_profiler(TRUE);
        $fund=array('voucher_number' => $this->input->post('voucher_number'),
            'narration' => $this->input->post('narration'),
            'transaction_date' => $this->makedate($this->input->post('transaction_date')),
            'Amount' => $this->input->post('Amount'),
            'corp_id' => $this->input->post('corp_id'),
        );

        $query = $this->db->query('select * from corpus_transactions where corp_id ='.$this->input->post('voucher_number').' and transaction_date ="'.$this->makedate($this->input->post('transaction_date')).'"');
        if ($query->num_rows() == 0) {
            if ($this->db->insert('corpus_transactions', $fund)) {
                $this->db->query('update corpus_fund c, (select corp_id, sum(amount) amountt from corpus_transactions where corp_id = '.$this->input->post('corp_id').' group by corp_id) t set c.amount = t.amountt where c.id = '.$this->input->post('corp_id'));
                echo "Fund Added Successfully";
            }
        } else {
            echo "Voucher Already Exist";
        }
    }

    public function removetransaction()
    {
        $this->load->database();
        if ($query = $this->db->query('delete from corpus_transactions where voucher_number ='.$this->input->post('voucher_number').' and transaction_date ="'.$this->input->post('transaction_date').'"')) {
            echo 'Transaction deleted';
            $this->db->query('update corpus_fund c, (select corp_id, sum(amount) amountt from corpus_transactions where corp_id = '.$this->input->post('corp_id').' group by corp_id) t set c.amount = t.amountt where c.id = '.$this->input->post('corp_id'));
        }
    }


    public function forumwiseaggregate()
    {
        $this->load->database();
        $data['funds'] = $this->db->query('select edu_forum, sum(amount) amount from corpus_fund group by edu_forum');
        $_SESSION['m_menu']='Mcorpusfund';
        $_SESSION['s_menu'] = 'CForumwiseCombined';
        $this->load->view('corpus_combined', $data);
    }

    private function makedate($dt)
    {
        $newdt = explode('/', $dt);
        return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
    }
}
