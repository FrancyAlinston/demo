<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Share extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('session');
            $_SESSION['m_menu']='Mnidhi';
        }

        // public function index()
        // {
        // }

        public function checkmember()
        {
            //$this->output->enable_profiler(TRUE);
            $this->load->database();
            $this->db->select('id');
            $query = $this->db->get_where('nidhi_member', array('aadhar' => $this->input->post('aadhaar')));
            if ($query->num_rows() > 0) {
                $member = $query->row();
                echo $member->id;
            } else {
                echo "Member Not Found";
            }
        }

        public function createmember()
        {
            $this->load->view('_create_member');
        }

        public function createmember_()
        {
            $this->load->database();

            $member = array(
                //'id' => 12879,
                'member_name' => $this->input->post('memberName'),
                'aadhar' => $this->input->post('aadhaar'),
                'entry_date' => date('Y-m-d H:i:s')
            );
            $orphanMember = $this->getorphanmember();
            if ($orphanMember != 0) {
                $member['id'] = $orphanMember;
            }
            if ($this->db->insert('nidhi_member', $member)) {
                echo $this->db->insert_id();
            } else {
                echo 'Please check the entry';
            }
        }

        public function createshare()
        {
            $this->load->database();
            $data['last_share'] = $this->db->query('select max(share_id) last_share from nidhi_share_pool')->row()->last_share;
            $this->load->view('_create_share', $data);
        }


        public function createshare_()
        {
            $this->load->database();

            $pre_query = $this->db->query('select * from share_certificates where share_id = "'.$this->input->post('share_id').'"');
            if ($pre_query->num_rows() > 0) {
                exit('Shares Range already issued..!! Please Check');
            }
            $share = array(
                //'id' => 17571,
                'member_id' => $this->input->post('member_id'),
                'holder_id' => $this->input->post('holder_id'),
                'share_id' => $this->input->post('share_id'),
                'share_count' => $this->input->post('share_count')
            );


            // Share Cerificate Override
            if (trim($this->input->post('txtCertOverride')) != '') {
                $share['id'] = trim($this->input->post('txtCertOverride'));
            }
            $this->db->insert('share_certificates', $share);
            $cert_id = $this->db->insert_id();

            if ($this->updateshares($this->input->post('share_id'), $this->input->post('holder_id'), $this->input->post('member_id'), $cert_id)) {
                $this->db->query('update share_history set issued_to_member ="'.$this->input->post('member_id').'", re_issue_date ="'.date('Y-m-d').'" where cert_id ="'.$cert_id.'" and issued_to_member is null');
                echo 'Certificate No: '.$cert_id.' and Share Range '.$this->input->post('share_id');
            }
        }

        public function getorphanmember()
        {
            $this->load->database();
            $query = $this->db->query("SELECT (t1.id + 1) as gap_starts_at,(SELECT MIN(t3.id) -1 FROM nidhi_member t3 WHERE t3.id > t1.id) as gap_ends_at FROM nidhi_member t1 WHERE NOT EXISTS (SELECT t2.id FROM nidhi_member t2 WHERE t2.id = t1.id + 1) HAVING gap_ends_at IS NOT NULL");
            $result = $query->result();
            //print_r($result);
            $missing_id = array();
            foreach ($result as $missing) {
                $missing_id = array_merge($missing_id, range($missing->gap_starts_at, $missing->gap_ends_at));
                //print_r($missing_id);
            }

            if (count($missing_id) !=0) {
                return min($missing_id);
            } else {
                return 0;
            }
        }

        public function issuesharebulk()
        {
            $_SESSION['s_menu'] = 'NidhiBulkIssueShares';
            $this->load->database();
            $data['shares'] = $this->db->query('select m.old_id, m.name, m.guardian_name, m.education_forum, m.forane, m.share_member_id from member m where m.is_nidhi = 1 and m.old_id
			not in (select holder_id from share_certificates) order by m.share_member_id limit 1000')->result();
            $this->load->view('share_bulk_issue', $data);
        }

        public function updateshares($shareids, $holder_id, $member_id, $cert_id)
        {
            //$this->output->enable_profiler(TRUE);
            if ($shareids == 0) {
                return true;
            }
            $temp = $shareids;
            $tshare = explode(',', $temp);
            $shares = array();

            foreach ($tshare as $item) {
                if (strpos($item, '-') !== false) {
                    $range = explode('-', $item);
                    if ((intval($range[1])-intval($range[0])) < 1) {
                        exit('Unreal Share Range');
                    }
                    $shares = array_merge($shares, range(intval($range[0]), intval($range[1])));
                } elseif (trim($item)=='') {
                } else {
                    $shares[] = intval($item);
                }
            }
            $shares = array_flip(array_flip($shares));

            $updateArr = array();
            foreach ($shares as $sid) {
                $updateArr[] = array('share_id' => $sid,
                'status' => 'issued',
                'holder_id' => $holder_id,
                'cert_id' => $cert_id,
                'member_id' => $member_id
            );
            }

            if ($this->db->insert_batch('nidhi_share_pool', $updateArr)) {
                return true;
            } else {
                return false;
            }
        }

        public function getsharelist()
        {
            //$this->output->enable_profiler(TRUE);
            $this->load->database();
            $query = $this->db->query('select * from share_certificates where holder_id ="'.$this->input->post('holderID').'"');
            $data['shares'] = $query->result();
            $data['show'] = 'share_list';
            $this->load->view('_xhr', $data);
        }

        public function getsharedetails()
        {
            //$this->output->enable_profiler(TRUE);
            $this->load->database();
            $share = $this->db->query('select member_id, share_id, share_count, id  from share_certificates where holder_id ="'.$this->input->post('holderID').'"');
            if ($share->num_rows()) {
                $share = $share->row();
                echo '[ Share Certificate: '.$share->id.' | Membership ID: '.$share->member_id.' | No of Shares: '.$share->share_count.' | Share Range: '.$share->share_id.']';
            }
        }

        public function showmembers()
        {
            $this->load->database();
            $data['forane'] = $this->db->get('forane_master');
            $_SESSION['m_menu']='Mnidhi';
            $_SESSION['s_menu'] = 'ShareHoldersList';
            $this->load->view('share_member_filter', $data);
        }

        public function modifiedprofileslist()
        {
            $this->load->database();
            $data['forane'] = $this->db->get('forane_master');
            $_SESSION['m_menu']='Mnidhi';
            $_SESSION['s_menu'] = 'Modifiedprofileslist';
            $this->load->view('modified_profiles', $data);
        }

        public function srchmemberbyidcertid()
        {
            $_SESSION['m_menu']='Mnidhi';
            $_SESSION['s_menu'] = 'SearchMemberByIdCertID';
            $this->load->view('srch_by_memid_crtid_');
        }

        public function srchmemberbyidcertid_()
        {
            $this->load->database();
            if (trim($this->input->post('txtMembershipID')) == '' && trim($this->input->post('txtShareCertificateID')) =='') {
                exit('Search terms cannot be empty');
            }
            if ($this->input->post('txtMembershipID') != '') {
                $data['searchResult'] = $this->db->query('select * from member where share_member_id ='.$this->input->post('txtMembershipID'));
            } else {
                $data['searchResult'] = $this->db->query('select * from member where old_id in(select holder_id from share_certificates where id = '.$this->input->post('txtShareCertificateID').')');
            }
            $data['show'] = 'adv_search_suggest';
            $data['opt']  = '';
            $data['ref']  = '';
            $this->load->view('_xhr', $data);
        }

        public function sharecertificate()
        {
            $this->load->database();
            $this->load->helper('url');
            $last = $this->uri->total_segments();
            $id = $this->uri->segment($last);
            $data['cert'] = $this->db->query('select s.*, m.forane, m.education_forum, m.name, m.permanent_address, m.bcc_name, m.bcc_number, m.guardian_phone, m.guardian_gender, m.guardian_occupation, m.guardians_guardian from (select n.id membership_id, n.member_name, c.holder_id, c.share_id, c.id certificate_number, c.share_count, date_format(c.issue_date,"%d/%m/%Y") issue_date from nidhi_member n, share_certificates c where n.id = c.member_id) s left outer join member m on s.holder_id = m.old_id where s.certificate_number='.$id)->row();
            $this->load->view('share_certificate', $data);
        }

        public function sharecertificateseries()
        {
            //$this->output->enable_profiler(TRUE);
            $this->load->database();
            $this->load->helper('url');
            $last = $this->uri->total_segments();
            $series = explode('-', $this->uri->segment($last));

            $data['certs'] = $this->db->query('select s.*, m.forane, m.education_forum, m.name, m.permanent_address, m.bcc_name, m.bcc_number, m.guardian_phone, m.guardian_gender, m.guardian_occupation, m.guardians_guardian from (select n.id membership_id, n.member_name, c.holder_id, c.share_id, c.id certificate_number, c.share_count, date_format(c.issue_date,"%d/%m/%Y") issue_date from nidhi_member n, share_certificates c where n.id = c.member_id) s left outer join member m on s.holder_id = m.old_id where s.certificate_number between '.$series[0].' and '.$series[1].' order by m.forane, m.education_forum, s.certificate_number')->result();
            $this->load->view('share_certificateseries', $data);
        }

        public function registerofmembersseries()
        {
            $this->load->database();
            $this->load->helper('url');
            $last = $this->uri->total_segments();
            $series = explode('-', $this->uri->segment($last));

            $data['certs'] = $this->db->query('select s.*, m.forane, m.education_forum, m.name, m.permanent_address, m.bcc_name, m.bcc_number, m.guardian_phone, m.guardian_gender, m.guardian_occupation, m.guardian_aadhar, m.guardians_guardian,m.pan_card, m.nominee_name, m.temporary_address from (select n.id membership_id, n.member_name, c.holder_id, c.share_id, c.id certificate_number, c.share_count, date_format(c.issue_date,"%d/%m/%Y") issue_date from nidhi_member n, share_certificates c where n.id = c.member_id and n.id between '.$series[0].' and '.$series[1].') s left outer join member m on s.holder_id = m.old_id order by s.membership_id')->result();
            $this->load->view('registerof_membersseries', $data);
        }

        public function nidhireportexport()
        {
            $_SESSION['m_menu']='Mnidhi';
            $_SESSION['s_menu'] = 'NidhiReportExport';
            $this->load->view('nidhi_report_export');
        }

        public function sharedate()
        {
            $_SESSION['s_menu'] = 'ShareDates';
            $this->load->view('apply_share_date');
        }

        public function sharedate_()
        {
            $this->load->database();
            $this->load->library('table');
            //$this->output->enable_profiler(TRUE);

            $this->db->where('id between '.$this->input->post('txtShareFrm').' and '.$this->input->post('txtShareTo'));
            $result = $this->db->update('share_certificates', array('issue_date' => $this->makedate($this->input->post('txtShareIssueDate')), 'allotment_num' => $this->input->post('txtShareAllotmentNumber') ));

            //print_r($result);
            if ($this->db->affected_rows() > 0) {
                echo "<h3>Updated ".$this->db->affected_rows()." Shares Issue Dates to ".$this->input->post('txtShareIssueDate').'</h3>';
                $rseffected = $this->db->query(' select id,member_id,holder_id,share_id,share_count,date_format(issue_date,"%d/%m/%Y") from share_certificates where id between '.$this->input->post('txtShareFrm').' and '.$this->input->post('txtShareTo'));
                $this->table->set_heading('Certificate ID', 'Membership ID', 'Beneficiary ID ', 'Share Range', 'Number Of Shares', 'Issue Date');
                echo $this->table->generate($rseffected->result_array());
            } else {
                echo "<h3 style='color:red'>No Certificates where updated, Please check the input field details, Also see the selected certifiate range below.</h3>";
                $rseffected = $this->db->query(' select id,member_id,holder_id,share_id,share_count,date_format(issue_date,"%d/%m/%Y") from share_certificates where id between '.$this->input->post('txtShareFrm').' and '.$this->input->post('txtShareTo'));
                $this->table->set_heading('Certificate ID', 'Membership ID', 'Beneficiary ID ', 'Share Range', 'Number Of Shares', 'Issue Date');
                echo $this->table->generate($rseffected->result_array());
            }
        }

        public function nidhicloseaccount()
        {
            $_SESSION['s_menu'] = 'CloseNidhiAccount';
            $this->load->database();
            $data['forane'] = $this->db->get('forane_master');
            $this->load->view('share_close_nidhi', $data);
        }

        public function nidhicloseaccount_()
        {
            $this->load->database();
            $this->db->where('old_id', $this->input->post('id'));
            if ($this->db->update('member', array('status'=>'closed','is_nidhi' => 0))) {

            // Keep a record of individual shares
                $this->db->query('insert into nidhi_individual_share_history (share_id,status,holder_id,cert_id,member_id,issue_date,close_date) select p.share_id,"closed",p.holder_id,p.cert_id,p.member_id,c.issue_date,curdate() from nidhi_share_pool p left join share_certificates c on c.holder_id =  p.holder_id where p.holder_id = "'.$this->input->post('id').'"');
                if ($this->db->query('delete from nidhi_share_pool where holder_id ="'.$this->input->post('id').'"')) {
                    //Stores the certificate details to History Table
                    $this->db->query('insert into share_history (cert_id,member_id,holder_id,share_id,share_count,issue_date,close_date) select id, member_id,holder_id,share_id,share_count,issue_date,curdate() from share_certificates where holder_id ="'.$this->input->post('id').'"');
                    if ($this->db->query('delete from share_certificates where holder_id ="'.$this->input->post('id').'"')) {
                        echo 'Account associated with ID : '.$this->input->post('id').' is closed';
                    }
                }
            }
        }

        public function sharecertcunterack()
        {
            $this->load->view('sharecert_counter_check');
        }
        public function sharecertcunterack_()
        {
            //$this->output->enable_profiler(TRUE);
            $this->load->database();
            $update_data = array(
            'ack_date' => date('Y-m-d'),
            'counter_ack' => 1
        );
            $this->db->where('id', $this->input->post('cert_id'));
            if ($this->db->update('share_certificates', $update_data)) {
                $ack = $this->db->query('select s.id, s.holder_id, m.name, m.guardian_name, m.education_forum, s.ack_date from share_certificates s left join member m on s.holder_id = m.old_id where s.id="'.$this->input->post('cert_id').'" order by s.id asc limit 10')->row();
                echo '<tr>';
                //print_r($ack);
                foreach ($ack as $key => $fields) {
                    if ($key == 'ack_date') {
                        echo '<td>'.$this->makedatefromsql($fields).'</td>';
                    } else {
                        echo '<td>'.$fields.'</td>';
                    }
                }
                echo '</tr>';
            }
        }

        public function conterackexport()
        {
            $this->load->database();
            $this->db->order_by("eduforum", "asc");
            $data['eduFrm'] = $this->db->get('eduforum_master')->result();
            $this->load->view('share_ack_export', $data);
        }


        public function resetnidhi()
        {
            $_SESSION['s_menu'] = 'NidhiResetAccount';
            $this->load->database();
            $data['forane'] = $this->db->get('forane_master');
            $this->load->view('resetnidhi', $data);
        }

        private function makedatefromsql($dt)
        {
            $newdt = explode('-', $dt);
            if (count($newdt)<2) {
                return '00/00/0000';
            } else {
                return $newdt[2].'/'. $newdt[1].'/'. $newdt[0];
            }
        }

        private function makedate($dt)
        {
            $newdt = explode('/', $dt);
            return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
        }
    }
