<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guardain extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='MGuardain';
    }

    public function checkaadhar()
    {
        $this->load->database();
        $data['Guardian'] = $this->db->get_where('parent_master', array('guardian_aadhar'=> $this->input->post('Gaadhar')));
        echo json_encode($data['Guardian']->result());
    }
    public function getguardianfrommember()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $data['Guardian'] = $this->db->get_where('member', array('old_id'=> $this->input->post('id')));
        echo json_encode($data['Guardian']->result());
    }
    public function getguardian()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $data['Guardian'] = $this->db->get_where('parent_master', array('share_member_id'=> $this->input->post('share_memeber_id')));
        echo json_encode($data['Guardian']->result());
    }

    public function addguardian()
    {
        $this->load->database();
        if (isset($_GET['old_id'])) {
            $data['old_id'] = $this->input->get('old_id');
            $data['gaadhar'] = $this->input->get('gaadhar');
            $this->load->view('add_guardian', $data);
        } else {
            $this->load->view('add_guardian');
        }
    }
    public function editguardian()
    {
        $this->output->enable_profiler(true);
        $this->load->database();
        $data['share_memeber_id'] = $this->input->get('share_memeber_id');
        $this->load->view('edit_guardian', $data);
    }
    public function add_()
    {
        $this->load->database();
        $GData = array(
            'permanent_address' => $this->input->post('txtAddrPermnt'),
            'guardian_name' => $this->input->post('txtGuardian'),
            'guardian_gender' => $this->input->post('selGGender'),
            'guardian_dob' => $this->makedate($this->input->post('txtGDOB')),
            'guardian_occupation' => $this->input->post('txtGccupation'),
            'guardians_guardian' => $this->input->post('txtGGuardian'),
            'guardian_aadhar' => $this->input->post('txtGuardianAadhaar'),
            'bank_account' => $this->input->post('txtBankAC'),
            'bank_account_holder' => $this->input->post('txtBnkAcHolder'),
            'bank_name' => $this->input->post('txtBankName'),
            'bank_branch' => $this->input->post('txtBankBranch'),
            'IFSC_code' => $this->input->post('txtIFSC'),
            'pan_card' => $this->input->post('txtPAN'),
            'email' => $this->input->post('txtEmail'),
            'guardian_phone' => $this->input->post('txtGphone')
            );

        if ($this->db->insert('parent_master', $GData)) {
            $gid = $this->db->insert_id();
            echo "Guardian Added Succssfully";
            $GMember = array(
                'member_name' => $this->input->post('txtGuardian'),
                'aadhar' => $this->input->post('txtGuardianAadhaar'),
                'entry_date' => date('Y-m-d H:i:s')
            );

            // Over Ride Membership
            // $orphanMember = $this->getorphanmember();
            // if($orphanMember != 0){
            // 	$GMember['id'] = $orphanMember;
            // }

            if ($this->db->insert('nidhi_member', $GMember)) {
                $this->db->where('id', $gid);
                $nidhiId = $this->db->insert_id();
                $this->db->update('parent_master', array('share_member_id' => $this->db->insert_id()));
                echo 'Guardain Created with Membership ID '.$nidhiId.' on '.$GMember['entry_date'];
            }
        }
    }

    public function update_()
    {
        $this->load->database();
        $GData = array(
            'permanent_address' => $this->input->post('txtAddrPermnt'),
            'guardian_name' => $this->input->post('txtGuardian'),
            'guardian_gender' => $this->input->post('selGGender'),
            'guardian_dob' => $this->makedate($this->input->post('txtGDOB')),
            'guardian_occupation' => $this->input->post('txtGccupation'),
            'guardians_guardian' => $this->input->post('txtGGuardian'),
            'guardian_aadhar' => $this->input->post('txtGuardianAadhaar'),
            'email' => $this->input->post('txtEmail'),
            'phone' => $this->input->post('txtGphone'),
            'bank_account' => $this->input->post('txtBankAC'),
            'bank_account_holder' => $this->input->post('txtBnkAcHolder'),
            'bank_name' => $this->input->post('txtBankName'),
            'bank_branch' => $this->input->post('txtBankBranch'),
            'IFSC_code' => $this->input->post('txtIFSC'),
            'pan_card' => $this->input->post('txtPAN')
            );
        $this->db->where('share_member_id', $this->input->post('txtMembershipID'));
        if ($this->db->update('parent_master', $GData)) {
            $gid = $this->db->insert_id();
            echo "Parent Master updated Succssfully \n";
            $member = array(
                              'permanent_address' => $this->input->post('txtAddrPermnt'),
                                            'guardian_name' => $this->input->post('txtGuardian'),
                                            'guardian_gender' => $this->input->post('selGGender'),
                                            'guardian_dob' => $this->makedate($this->input->post('txtGDOB')),
                                            'guardian_occupation' => $this->input->post('txtGccupation'),
                                            'guardians_guardian' => $this->input->post('txtGGuardian'),
                                            'guardian_aadhar' => $this->input->post('txtGuardianAadhaar'),
                                            'email' => $this->input->post('txtEmail'),
                                            'guardian_phone' => $this->input->post('txtGphone'),
                                            'bank_account_number' => $this->input->post('txtBankAC'),
                                            'bank_account_holder_name' => $this->input->post('txtBnkAcHolder'),
                                            'bank_name' => $this->input->post('txtBankName'),
                                            'bank_branch' => $this->input->post('txtBankBranch'),
                                            'ifsc_code' => $this->input->post('txtIFSC'),
                                            'pan_card' =>  $this->input->post('txtPAN')
            );
            $this->db->where('share_member_id', $this->input->post('txtMembershipID'));
            if ($this->db->update('member', $member)) {
                echo "Beneficiary Master updated Succssfully \n";

                $nidhi_member = array(
                    'member_name' => $this->input->post('txtGuardian'),
                    'aadhar' => $this->input->post('txtGuardianAadhaar')
                );
                $this->db->where('id', $this->input->post('txtMembershipID'));
                if ($this->db->update('nidhi_member', $nidhi_member)) {
                    echo "Nidhi Member updated Succssfully \n";
                }
            }
        }
    }

    public function getorphanmember()
    {
        $this->load->database();
        $query = $this->db->query("SELECT (t1.id + 1) as gap_starts_at,(SELECT MIN(t3.id) -1 FROM nidhi_member t3 WHERE t3.id > t1.id) as gap_ends_at FROM nidhi_member t1 WHERE NOT EXISTS (SELECT t2.id FROM nidhi_member t2 WHERE t2.id = t1.id + 1) HAVING gap_ends_at IS NOT NULL");
        $result = $query->result();
        $missing_id = array();
        foreach ($result as $missing) {
            $missing_id = array_merge($missing_id, range($missing->gap_starts_at, $missing->gap_ends_at));
        }

        if (count($missing_id) != 0) {
            return min($missing_id);
        } else {
            return 0;
        }
    }


    private function makedate($dt)
    {
        $newdt = explode('/', $dt);
        return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
    }
}
