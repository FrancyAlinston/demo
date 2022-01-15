<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiary extends CI_Controller {

	public function __construct(){
         parent::__construct();
         $this->load->library('session');
         $_SESSION['m_menu']='Mbeneficiary';
    }

	public function add(){
		$this->load->database();
		$data['forane'] = $this->db->get('forane_master');
		$_SESSION['s_menu'] = "AddBeneficiary";
		if(isset($_GET['gaadhar'])){
			$data['gaadhar'] = $_GET['gaadhar'];
		}
		$this->load->view('add_beneficiary',$data);
	}

	public function add_(){
		$this->load->database();
        //$this->output->enable_profiler(TRUE);
		$benData=array('name' => $this->input->post('txtBenName'),
			'gender' => $this->input->post('selGender'),
			'dob' => $this->makedate($this->input->post('txtDOB')),
			'phone' => $this->input->post('txtPhone'),
			'email' => $this->input->post('txtEmail'),
			'aadhaar' => $this->input->post('txtAadhaar'),
			'permanent_address' => $this->input->post('txtAddrPermnt'),
			'temporary_address' => $this->input->post('txtAddrTemp'),
			'school'  => $this->input->post('txtSchool'),
			'syllabus'  => $this->input->post('txtSyllabus'),
			'medium'  => $this->input->post('txtMedium'),
			'college'  => $this->input->post('txtCollege'),
			'qualification' => $this->input->post('txtQualification'),
			'guardian_name' => $this->input->post('txtGuardian'),
			'guardian_relation' => $this->input->post('txtGuardianRel'),
			'guardian_gender' => $this->input->post('selGGender'),
			'guardian_dob' => $this->makedate($this->input->post('txtGDOB')),
			'guardian_occupation' => $this->input->post('txtGccupation'),
			'guardians_guardian' => $this->input->post('txtGGuardian'),
			'guardian_phone' => $this->input->post('txtGuardianPhone'),
			'guardian_aadhar' => $this->input->post('txtGuardianAadhaar'),
			'nominee_name' => $this->input->post('txtNominee'),
			'nominee_relation' =>$this->input->post('txtNomineeRel'),
			'nominee_phone' => $this->input->post('txtNomineePhone'),
			'nominee_aadhar' => $this->input->post('txtNomineeAadhaar'),
			'forane' => $this->input->post('selForane'),
			'education_forum' => $this->input->post('selEduFrm'),
			'bcc_name' => $this->input->post('txtBCCName'),
			'bcc_number' => $this->input->post('txtBCCNum'),
			'bank_account_number' => $this->input->post('txtBankAC'),
			'bank_account_holder_name' => $this->input->post('txtBnkAcHolder'),
			'bank_name' => $this->input->post('txtBankName'),
			'bank_branch' => $this->input->post('txtBankBranch'),
			'ifsc_code' => $this->input->post('txtIFSC'),
			'pan_card' => $this->input->post('txtPAN'),
			'photoid' => $this->input->post('txtBenPhoto'),
			'initial_payment' => $this->input->post('txtInitialPay'),
			'receipt_number' => $this->input->post('txtReceipt'),
			'receipt_date' => $this->makedate($this->input->post('txtReceiptDate')),
			'is_nidhi' => $this->input->post('selIsNidhi'),
			'share_member_id' => $this->input->post('txtMembershipID'),
			'status' => 'active',
			'account_date' => date('Y-m-d')
			);


		// Fetch Education Forum
        $query = $this->db->get_where('eduforum_master',array('eduforum' => $this->input->post('selEduFrm')));
        $ret = $query->row();
        $frmAbbr =  $ret->abbr;

		 if($this->db->insert('member', $benData)){

		 	$insert_id = $this->db->insert_id();
			if(trim($this->input->post('txtBenIDOver')) != ''){
				$updateDate=array('old_id' => 'N'.sprintf('%06d',$this->input->post('txtBenIDOver')).$frmAbbr);
			}else{
				$updateDate=array('old_id' => 'N'.sprintf('%06d',$insert_id).$frmAbbr);
			}


		    $this->db->where('id', $insert_id);
            if($this->db->update('member', $updateDate)){
            	echo $updateDate['old_id'];
            }

		 }
	}

	function addnidhi(){
		$this->load->database();
		$data['forane'] = $this->db->get('forane_master');
		$_SESSION['s_menu'] = "AddNidhiBeneficiary";
		if(isset($_GET['gaadhar'])){
			$data['gaadhar'] = $this->input->get('gaadhar');
			$data['old_id'] = $this->input->get('old_id');
		}
		$this->load->view('add_beneficiary_nidhi',$data);
	}
	public function ben_data_json(){
		$this->load->database();
		$data['ben'] = $this->db->get_where('member',array('old_id'=> $this->input->post('id')));
		echo json_encode($data['ben']->result());
	}

	public function update_(){
		//$this->output->enable_profiler(TRUE);
		$this->load->database();
		
		$benData=array('name' => $this->input->post('txtBenName'),
			'gender' => $this->input->post('selGender'),
			'dob' => $this->makedate($this->input->post('txtDOB')),
			'phone' => $this->input->post('txtPhone'),
			'email' => $this->input->post('txtEmail'),
			'aadhaar' => $this->input->post('txtAadhaar'),
			'permanent_address' => $this->input->post('txtAddrPermnt'),
			'temporary_address' => $this->input->post('txtAddrTemp'),
			'school'  => $this->input->post('txtSchool'),
			'syllabus'  => $this->input->post('txtSyllabus'),
			'medium'  => $this->input->post('txtMedium'),
			'college'  => $this->input->post('txtCollege'),
			'qualification' => $this->input->post('txtQualification'),
			'guardian_name' => $this->input->post('txtGuardian'),
			'guardian_relation' => $this->input->post('txtGuardianRel'),
			'guardian_gender' => $this->input->post('selGGender'),
			'guardian_dob' => $this->makedate($this->input->post('txtGDOB')),
			'guardian_occupation' => $this->input->post('txtGccupation'),
			'guardians_guardian' => $this->input->post('txtGGuardian'),
			'guardian_phone' => $this->input->post('txtGuardianPhone'),
			'guardian_aadhar' => $this->input->post('txtGuardianAadhaar'),
			'nominee_name' => $this->input->post('txtNominee'),
			'nominee_relation' =>$this->input->post('txtNomineeRel'),
			'nominee_phone' => $this->input->post('txtNomineePhone'),
			'nominee_aadhar' => $this->input->post('txtNomineeAadhaar'),
			'forane' => $this->input->post('selForane'),
			'education_forum' => $this->input->post('selEduFrm'),
			'bcc_name' => $this->input->post('txtBCCName'),
			'bcc_number' => $this->input->post('txtBCCNum'),
			'bank_account_number' => $this->input->post('txtBankAC'),
			'bank_account_holder_name' => $this->input->post('txtBnkAcHolder'),
			'bank_name' => $this->input->post('txtBankName'),
			'bank_branch' => $this->input->post('txtBankBranch'),
			'ifsc_code' => $this->input->post('txtIFSC'),
			'pan_card' => $this->input->post('txtPAN'),
			'photoid' => $this->input->post('txtBenPhoto'),
			'initial_payment' => $this->input->post('txtInitialPay'),
			'receipt_number' => $this->input->post('txtReceipt'),
			'receipt_date' => $this->makedate($this->input->post('txtReceiptDate')),
			'is_nidhi' => $this->input->post('selIsNidhi'),
			'share_member_id' => $this->input->post('txtMembershipID'));

		$this->db->where('id', $this->input->post('txtId'));

		 if($this->db->update('member', $benData)){
		 	 echo "Beneficiary Updated Succssfully";
		 }
	}

	public function nidhientryack(){
    $this->load->database();
		$benData=array(
			'name'   => $this->input->post('txtBenName'),
		  'old_id' => $this->input->post('old_id'),
			'entry_date' => date('Y-m-d')
		);
		 if($this->db->insert('nidhi_ack', $benData)){
			 echo "Entry Number : ".$this->input->post('old_id')." - ".$this->db->insert_id();
		 }
	}


	public function view(){
		$this->load->database();
		$this->load->helper('url');
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);
		$data['mode'] = 'view';
		$query = $this->db->get_where('member',array('id' => $id));
		$data['beneficiary'] = $query->row();
		$data['nav_history'] = $this->db->query('select id, generated_id, status, receipt from application where nes_id = (select old_id from member where id = '.$id.')');
		if(abs($data['beneficiary']->share_member_id) > 0){
		  $data['membership'] = $this->db->query('select * from nidhi_member where id = '.$data['beneficiary']->share_member_id)->row();
	  }
		$data['schol_history'] = $this->db->query('select id, generated_id, status, receipt from application where nes_id = (select old_id from member where id = '.$id.')');
		$_SESSION['s_menu'] = "EditBeneficiary";
		$this->load->view('edit_benificiary',$data);
	}

	public function closeben(){
		$this->load->database();
		$this->db->where('old_id', $this->input->post('id'));
		if($this->db->update('member', array('status'=>'closed','is_nidhi' => 0))){
			echo 'Account associated with ID : '.$this->input->post('id').' is closed';
		}
	}

	public function singlephotoupload(){
		if ($_FILES['urlP']['error'] > 0){
			echo "Return Code: " . $_FILES['urlP']['error']. "<br />";
		}else{
			$fileDir = "profilephotos/";
			$fileName = $this->input->post('stamp').'.'.pathinfo($_FILES['urlP']['name'], PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['urlP']['tmp_name'], $fileDir.$fileName);
			echo $fileName;
		}
	}

	public function makeprint(){
		$this->load->database();
		$this->load->helper('url');
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);
		$data['mode'] = 'view';
		$query = $this->db->get_where('member',array('id' => $id));
		$data['beneficiary'] = $query->row();
		$this->load->view('print_benificiary',$data);
		$this->db->query('update member set passbook = 1, passbook_print_date = curdate() where id = '.$id);
	}
	public function makeprintseries(){
		$this->load->database();
		$this->load->helper('url');
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);
		$id = explode('-', $id);
		$oid = implode('","', $id);

		$data['mode'] = 'view';
		$this->db->where('old_id in ("'.$oid.'")');
		$query = $this->db->get('member');
		$data['beneficiaries'] = $query->result();

		$this->db->query('update member set passbook = 1, passbook_print_date = curdate() where old_id in ("'.$oid.'")');
		$this->load->view('print_benificiary_series',$data);
	}
	public function makeprintserieslegal(){
		$this->load->database();
		$this->load->helper('url');
		$this->db->insert('print_log',array('url' => base_url().$this->uri->uri_string()));
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);
		$id = explode('-', $id);
		$oid = implode('","', $id);

		$data['mode'] = 'view';
		$this->db->where('old_id in ("'.$oid.'")');
		$this->db->order_by('education_forum');
		$query = $this->db->get('member');
		$data['beneficiaries'] = $query->result();
		$this->load->view('print_benificiary_series_a4',$data);

		//Mark as Printed
		$this->db->query('update member set passbook = 1, passbook_print_date = curdate() where old_id in ("'.$oid.'")');
	}

	public function advancedsearch(){
		$this->load->database();
		$data['forane'] = $this->db->get('forane_master');
		$this->load->view('adv_search_beneficiary',$data);
	}

	public function benfilter(){
		$this->load->database();
		$data['forane'] = $this->db->get('forane_master');
		$_SESSION['m_menu']='Mbeneficiary';
		$_SESSION['s_menu'] = 'BeneficiaryExport';
		$this->load->view('beneficiary_filter',$data);
	}

	public function nidhiapplentryexport(){
		$this->load->database();
		$data['forane'] = $this->db->get('forane_master');
		$_SESSION['m_menu'] = 'Mbeneficiary';
		$_SESSION['s_menu'] = 'NidhiApplicationEntryReport';
		$this->load->view('nidhi_application_entry_ack',$data);
	}

	public function importtally(){
		$this->load->view('import_xml');
		$_SESSION['m_menu']='Mbeneficiary';
		$_SESSION['s_menu'] = 'CloseAccounts';
	}
	public function importbendeposit(){
		$this->load->view('import_ben_deposit');
		$_SESSION['m_menu']='Mbeneficiary';
		$_SESSION['s_menu'] = 'BenDeposit';
	}
	public function importbendepositscheme(){
		$this->load->view('import_ben_deposit_scheme');
		$_SESSION['m_menu']='Mbeneficiary';
		$_SESSION['s_menu'] = 'BenDeposit';
	}
	public function importbentrialbalance(){
		$this->load->view('import_ben_trialbalance');
		$_SESSION['m_menu']='Mbeneficiary';
		$_SESSION['s_menu'] = 'BenTrialBalance';
	}



  private function makedate($dt){
     $newdt = explode('/',$dt);
     return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
  }
}
