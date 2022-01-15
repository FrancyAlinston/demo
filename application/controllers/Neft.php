<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Neft extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='MNeft';
        $this->load->model('Neftmodal', 'neftm');
    }

    public function index()
    {
        $_SESSION['s_menu'] = "Editneft";
        $this->load->database();
        $data['neftDetails'] = $this->neftm->selectdata();
        $this->load->view('editneft', $data);
    }

    public function update()
    {
        $id = intval($this->input->post('id'));
        $nesId = htmlspecialchars($this->input->post('nesId'));
        $accNo = htmlspecialchars($this->input->post('accNo'));
        $accName = htmlspecialchars($this->input->post('accName'));
        $ifsc = htmlspecialchars($this->input->post('ifsc'));
        $branchCode = htmlspecialchars($this->input->post('branchCode'));
        $bankName = htmlspecialchars($this->input->post('bankName'));
        $schemeAmt = htmlspecialchars($this->input->post('schemeAmt'));
        $nidiAmt = htmlspecialchars($this->input->post('nidiAmt'));
        $date = htmlspecialchars($this->input->post('date'));
        $date = date_create_from_format("d M Y", $date);
        $date = date_format($date, "Y-m-d");
        $data = array(
                    'nes_id' => $nesId,
                    'acnumber' => $accNo,
                    'acname' => $accName,
                    'ifsc' => $ifsc,
                    'branchid' => $branchCode,
                    'bank_name' => $bankName,
                    'scheme_amt' => $schemeAmt,
                    'nidhi_amt' => $nidiAmt,
                    'date' => $date,
        );
        // $data = array(
        // 	'nes_id' => '$nesId',
        // 	'acnumber' => '$accNo',
        // 	'acname' => '$accName',
        // 	'ifsc' => '$ifsc',
        // 	'branchid' => '$branchCode',
        // 	'bank_name' => '$bankName',
        // 	'scheme_amt' => '$schemeAmt',
        // 	'nidhi_amt' => '$nidiAmt',
        // 	'date' => '',
        // );
        $this->load->database();
        $this->db->where('id', $id);
        $this->db->update('neftaccountclosed', $data);
        // print_r($data);
        $response = array(
            'error' => false,
            'msg'	=> 'Success'
        );
        echo json_encode($response);
    }

    public function neftaccountclose()
    {
        $this->load->database();
        $data = $this->db->query('SELECT id, nes_id, acnumber, acname, branchid, ifsc, scheme_amt, nidhi_amt FROM neftaccountclosed');
        $arrayData = array();
        $_SESSION['s_menu'] = "Neftclose";
    }

    public function neftaccountclosedView($refresh = 0)
    {
        $_SESSION['s_menu'] = "Neftclose";
        $this->load->helper('url');
        if ($refresh == 1) {
            redirect('/neft/neftaccountclosedView/', 'refresh');
        }
        $this->load->view('neftaccountclosed');
    }

    public function neftaccountclosed()
    {
        $this->load->database();
        $this->load->helper('url');
        //$this->output->enable_profiler(true);
        $data=array('nes_id' => $this->input->post('txtNesid'),
            'acnumber' => $this->input->post('txtBankAC'),
            'acname' => $this->input->post('txtBnkAcHolder'),
            'bank_name' => $this->input->post('txtBankName'),
            'branchid' => $this->input->post('txtBankBranch'),
            'ifsc' => $this->input->post('txtIFSC'),
            'scheme_amt' => $this->input->post('txtSchemeamt'),
            'nidhi_amt' => $this->input->post('txtNidhiamt')
            );
        if ($this->db->insert('neftaccountclosed', $data)) {
        }
        redirect('/neft/neftaccountclosedView/1', 'refresh');
    }

    public function editneft()
    {
        $_SESSION['s_menu'] = "Editneft";
        // $this->output->enable_profiler(true);
        $this->load->database();
        $this->load->helper('url');
        $last = $this->uri->total_segments();
        $nes_id = $this->uri->segment($last);
        $data['neft'] = $this->db->get_where('neftaccountclosed', array('nes_id' => $nes_id,))->row();
        $this->load->view('editneft', $data);
    }

    // Fetch Education Forum
    //     $query = $this->db->get_where('neftaccountclose',array('eduforum' => $this->input->post('selEduFrm')));
    //     $ret = $query->row();
    //     $frmAbbr =  $ret->abbr;

    // 	 if($this->db->insert('member', $benData)){

    // 	 	$insert_id = $this->db->insert_id();
    // 		if(trim($this->input->post('txtBenIDOver')) != ''){
    // 			$updateDate=array('old_id' => 'N'.sprintf('%06d',$this->input->post('txtBenIDOver')).$frmAbbr);
    // 		}else{
    // 			$updateDate=array('old_id' => 'N'.sprintf('%06d',$insert_id).$frmAbbr);
    // 		}


    // 	    $this->db->where('id', $insert_id);
    //         if($this->db->update('member', $updateDate)){
    //         	echo $updateDate['old_id'];
    //         }

    // 	 }
    // }

    // function neftaccountclose(){
    // 	$this->load->database();
    // 	$data['forane'] = $this->db->get('forane_master');
    // 	$_SESSION['s_menu'] = "neftaccountclose";
    // 	if(isset($_GET['gaadhar'])){
    // 		$data['gaadhar'] = $this->input->get('gaadhar');
    // 		$data['old_id'] = $this->input->get('old_id');
    // 	}
    // 	$this->load->view('add_beneficiary_nidhi',$data);
    // }
    // public function ben_data_json(){
    // 	$this->load->database();
    // 	$data['ben'] = $this->db->get_where('member',array('old_id'=> $this->input->post('id')));
    // 	echo json_encode($data['ben']->result());
    // }
}
