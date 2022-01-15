<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Xhr extends CI_Controller
{
    public function getedufrm()
    {
        $this->load->database();
        $data['eduforum'] = $this->db->get_where('eduforum_master', array('forane' => $this->input->post('forane')));
        $data['show'] = 'eduforum_select';
        $this->load->view('_xhr', $data);
    }

    public function searchsuggest()
    {
        $this->output->enable_profiler(true);
        $this->load->database();
        $this->db->or_like(array(
            'old_id' => $this->input->post('q'),
            'education_forum' => $this->input->post('q'),
            'old_id' => $this->input->post('q'),
            'name' => $this->input->post('q')
        ));

        $data['searchResult'] = $this->db->get('member', 100);
        $data['show'] = 'search_suggest';
        $data['opt']  = $this->input->post('opt');
        $this->load->view('_xhr', $data);
    }
    public function searchsuggesteligiblity()
    {
        $this->output->enable_profiler(true);
        $this->load->database();
        $this->db->or_like(array(
            'old_id' => $this->input->post('q'),
            'beneficary' => $this->input->post('q'),
            'guardian' => $this->input->post('q')
        ));

        $data['searchResult'] = $this->db->get('ben_yearly_transaction', 100);
        $data['show'] = 'search_suggest_elg';
        $this->load->view('_xhr', $data);
    }
    public function searchsuggestcert()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $data['searchResult'] = $this->db->query('select s.id, s.holder_id, m.name, m.guardian_name, m.education_forum from share_certificates s left join member m on s.holder_id = m.old_id where s.id = "'.$this->input->post('q').'" and s.counter_ack is null order by s.id asc limit 100')->result();
        $data['show'] = 'search_suggest_cert_ack';
        $this->load->view('_xhr', $data);
    }
    public function searchsuggestappl()
    {
        $this->load->database();
        $this->db->or_like(array(
            'id' => $this->input->post('q'),
            'student_name' => $this->input->post('q')
        ));

        $data['candidates'] = $this->db->get('application', 100);
        $data['show'] = 'search_suggestappl';
        $data['opt']  = $this->input->post('opt');
        $this->load->view('_xhr', $data);
    }
    public function searchsuggestfilter()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $this->db->like(array(
            'student_name' => $this->input->post('q')
        ));
        $this->db->where('batch', $this->input->post('batch'));
        $data['candidates'] = $this->db->get('application', 100);
        $data['show'] = 'search_suggestfilter';
        $data['opt']  = $this->input->post('opt');
        $this->load->view('_xhr', $data);
    }

    public function advbensearchsuggest()
    {

        //$this->output->enable_profiler(TRUE);
        $this->load->library('user_agent');
        $data['ref'] = explode('/', $this->agent->referrer());
        $data['ref'] = end($data['ref']);
        $whereparam = array();

        $this->load->database();

        $param = array();

        if ($this->input->post('txtOldid') != '') {
            $param['old_id'] = $this->input->post('txtOldid');
        }
        if ($this->input->post('selEduFrmS') != '') {
            $param['education_forum'] = $this->input->post('selEduFrmS');
        }
        if ($this->input->post('txtGuardianS') != '') {
            $param['guardian_name'] = $this->input->post('txtGuardianS');
        }
        if ($this->input->post('txtBenNameS') != '') {
            $param['name'] = $this->input->post('txtBenNameS');
        }
        if ($this->input->post('txtPhoneS') != '') {
            $param['phone'] = $this->input->post('txtPhoneS');
        }
        if ($this->input->post('SelForaneT') != '') {
            $param['forane'] = $this->input->post('SelForaneS');
        }

        if ($this->input->post('txtMembershipId') != '') {
            $whereparam['share_member_id'] = $this->input->post('txtMembershipId');
        }
        if ($this->input->post('txtShareCertificateId') != '') {
            $whereparam['old_id'] = $this->db->query('select holder_id from share_certificates where id = '.$this->input->post('txtShareCertificateId'))->row()->holder_id;
        }


        if ($data['ref'] == 'nidhicloseaccount') {
            $param['is_nidhi'] = 1;
        }
        if (isset($_POST['nidhiBen'])) {
            $data['nidhiBen'] = 'nidhiBen';
            # Omits already nidhi enrolled benificiary
            $whereparam['share_member_id'] = 0;
        }
        if (isset($_POST['nidhiGuard'])) {
            $data['nidhiGuard'] = 'nidhiGuard';
        }

        $this->db->like($param);
        if (count($whereparam) > 0) {
            $this->db->where($whereparam);
        }
        $data['searchResult'] = $this->db->get('member', 500);
        $data['show'] = 'adv_search_suggest';
        $data['opt']  = $this->input->post('opt');
        $this->load->view('_xhr', $data);
    }
    public function advbensearchsuggestpassbook()
    {

        //$this->output->enable_profiler(TRUE);
        $this->load->database();

        $param = array();

        if ($this->input->post('txtOldid') != '') {
            $param['old_id'] = $this->input->post('txtOldid');
        }
        if ($this->input->post('selEduFrmS') != '') {
            $param['education_forum'] = $this->input->post('selEduFrmS');
        }
        if ($this->input->post('txtGuardianS') != '') {
            $param['guardian_name'] = $this->input->post('txtGuardianS');
        }
        if ($this->input->post('txtBenNameS') != '') {
            $param['name'] = $this->input->post('txtBenNameS');
        }
        if ($this->input->post('txtPhoneS') != '') {
            $param['phone'] = $this->input->post('txtPhoneS');
        }
        if ($this->input->post('SelForaneT') != '') {
            $param['forane'] = $this->input->post('SelForaneS');
        }

        $this->db->like($param);
        $data['searchResult'] = $this->db->get('member', 500);
        $data['show'] = 'adv_search_suggest_passbook';
        $data['opt']  = $this->input->post('opt');
        $this->load->view('_xhr', $data);
    }



    public function advbensearchsuggestpassbooklaser()
    {

        //$this->output->enable_profiler(TRUE);
        $this->load->database();

        $param = array();

        if ($this->input->post('txtMemberFrm') != '') {
            $param['txtFrm'] = $this->input->post('txtMemberFrm');
        } else {
            exit('Please set the membership range');
        }
        if ($this->input->post('txtMemberTo') != '') {
            $param['txtTo'] = $this->input->post('txtMemberTo');
        } else {
            exit('Please set the membership range');
        }
        if ($this->input->post('selEduFrmS') != '') {
            $param['education_forum'] = $this->input->post('selEduFrmS');
            $edFrmQuery = 'and education_forum ="'.$param['education_forum'].'"';
        } else {
            $edFrmQuery ='';
            //exit('Please select Education Forum');
        }
        if ($this->input->post('SelForaneT') != '') {
            $forQuery = 'and lower(forane) = lower("'.$this->input->post('SelForaneT').'")';
        } else {
            $forQuery = '';
        }



        $data['ids'] = $this->db->query('select old_id ids from member where share_member_id in (select id from nidhi_member where id between '.$param['txtFrm'].' and '.$param['txtTo'].' ) '.$edFrmQuery.' '.$forQuery.' and (passbook = 0 or passbook is null) order by education_forum')->result_array();
        //$data['ids'] = $this->db->query('select old_id ids from member where share_member_id between '.$param['txtFrm'].' and '.$param['txtTo'].' '.$edFrmQuery.' '.$forQuery.' and passbook = 0 or passbook is null')->result_array();

        //echo 'select old_id ids from member where share_member_id in (select id from nidhi_member where id between '.$param['txtFrm'].' and '.$param['txtTo'].' ) and education_forum ="'.$param['education_forum'].'" and passbook is null';

        $bookId = array();

        foreach ($data['ids'] as $item) {
            $bookId[] = $item['ids'];
        };

        echo implode('-', $bookId);
        /*		//$data['ids'] =
                $data['show'] = 'adv_search_suggest_passbook';
                $data['opt']  = $this->input->post('opt');
                $this->load->view('_xhr',$data);*/
    }

    public function advcorpsearchsuggest()
    {

        //$this->output->enable_profiler(TRUE);
        $this->load->database();

        $param = array();

        if ($this->input->post('txtDId') != '') {
            $param['id'] = $this->input->post('txtDId');
        }
        if ($this->input->post('txtDonorName') != '') {
            $param['donor'] = $this->input->post('txtDonorName');
        }
        if ($this->input->post('txtEduForum') != '') {
            $param['edu_forum'] = $this->input->post('txtEduForum');
        }


        $this->db->like($param);
        $data['searchResult'] = $this->db->get('corpus_fund', 500);
        $data['show'] = 'adv_search_suggest_donor';
        $this->load->view('_xhr', $data);
    }
    public function qualificationsuggest()
    {
        $this->load->database();
        $this->db->or_like(array(
            'course' => $this->input->post('q'),
            'abbr' => $this->input->post('q')
        ));

        $data['searchResult'] = $this->db->get('qualification_master', 100);
        $data['show'] = 'qualification_suggest';
        $this->load->view('_xhr', $data);
    }

    public function courselist()
    {
        $this->load->database();
        $this->db->order_by('course', 'asc');
        $data['courses'] = $this->db->get('course_master');
        $data['show'] = 'course_list';
        $this->load->view('_xhr', $data);
    }

    public function courselistscholar()
    {
        $this->load->database();
        $this->db->order_by('course', 'asc');
        $data['courses'] = $this->db->get('scholarship_courses');
        $data['show'] = 'course_list_scholar';

        $this->load->view('_xhr', $data);
    }

    public function batchlist()
    {
        $this->load->database();
        $data['Batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span, b.notes from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $data['show'] = 'batch_list';
        $this->load->view('_xhr', $data);
    }

    public function getbeneficiary()
    {
        $this->load->database();
        $query = $this->db->get_where('member', array('id' => $this->input->post('id')));
        echo json_encode($query->result());
    }

    public function getapplicant()
    {
        $this->load->database();
        $query = $this->db->get_where('application', array('id' => $this->input->post('id')));
        echo json_encode($query->result());
    }

    public function schoolsuggest()
    {
        $this->load->database();
        /*$query = $this->db->query('select concat(school," - ",location) school from school_master where school like "%'.$this->input->get('term', TRUE).'%" or location like "%'.$this->input->get('term', TRUE).'%"');*/


        $where_clause = explode(' ', $this->input->get('term', true));
        $where_clause = array_map(array($this,"arraywrap"), $where_clause);



        $query = $this->db->query('select concat(school," - ",location) school from school_master where '.implode(' and ', $where_clause));

        echo json_encode($query->result());
    }
    public function banksuggest()
    {
        $this->load->database();
        $where_clause = explode(' ', $this->input->get('term', true));
        $where_clause = array_map(array($this,"bankwrap"), $where_clause);

        $query = $this->db->query('select bank from bank_master where '.implode(' and ', $where_clause));

        echo json_encode($query->result());
    }
    public function eduformsuggest()
    {
        $this->load->helper('url');
        $this->load->database();
        $query = $this->db->query('select eduforum from eduforum_master where eduforum like "%'.$this->input->get('term', true).'%"');
        echo json_encode($query->result());
    }

    public function candidatesfilter()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $appendQuery = '';
        if ($this->input->post('txtBatch') == '') {
            exit("Please Select Batch");
        }
        $this->db->where('batch', $this->input->post('txtBatch'));
        if ($this->input->post('txtStatus') !='') {
            $this->db->where('status', $this->input->post('txtStatus'));
        }
        if ($this->input->post('selYear') !='') {
            $this->db->where('enrolemnt_year', $this->input->post('selYear'));
        }

        if ($this->input->post('selEduFrm') !='') {
            $this->db->where('education_forum', $this->input->post('selEduFrm'));
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = ' and education_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }

        $data['candidates'] = $this->db->query($this->db->get_compiled_select('application').$appendQuery.' order by education_forum asc');
        $data['show'] = 'candidatelist';
        $this->load->view('_xhr', $data);
    }

    public function scholarshipfilter()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $appendQuery = '';
        if ($this->input->post('txtYear') == '') {
            exit("Please Select Year");
        }
        $forane = explode('|', $this->input->post('forane'));
        $this->db->where('year(entry_date)', $this->input->post('txtYear'));
        if ($this->input->post('txtCourse') !='') {
            $this->db->where('course_text', $this->input->post('txtCourse'));
        }
        if ($this->input->post('selEduFrm') !='') {
            $this->db->where('edu_forum', $this->input->post('selEduFrm'));
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = ' and edu_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }

        $data['scholarship'] = $this->db->query($this->db->get_compiled_select('scholarship').$appendQuery.' order by name,edu_forum asc');
        $data['show'] = 'scholarshiplist';
        $this->load->view('_xhr', $data);
    }

    public function scholarshipfiltercoursewise()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $appendQuery = '';
        if ($this->input->post('txtYear') == '') {
            exit("Please Select Year");
        }
        $forane = explode('|', $this->input->post('forane'));
        $this->db->where('year(entry_date)', $this->input->post('txtYear'));
        if ($this->input->post('txtCourse') !='') {
            $this->db->where('course_text', $this->input->post('txtCourse'));
        }
        if ($this->input->post('selEduFrm') !='') {
            $this->db->where('edu_forum', $this->input->post('selEduFrm'));
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = ' and edu_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }
        $this->db->select('course_text, COUNT(course_text) as count');
        $data['scholarship'] = $this->db->query($this->db->get_compiled_select('scholarship').$appendQuery.' group by course_text order by count desc');
        $data['show'] = 'scholarshiplistcoursewise';
        $this->load->view('_xhr', $data);
    }


    public function scholarshipfilterforumwise()
    {
        //	$this->output->enable_profiler(TRUE);
        $this->load->database();
        $data['scholarship'] = $this->db->query('select s.edu_forum, count(s.edu_forum) count, e.forane from scholarship s left join eduforum_master e on e.eduforum = s.edu_forum where year(s.entry_date) = "'.$this->input->post('txtYear').'" group by s.edu_forum order by count desc');
        $data['show'] = 'scholarshipfilterforumwise';
        $this->load->view('_xhr', $data);
    }

    public function campfilter()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $appendQuery = '';
        if ($this->input->post('txtBatch') == '') {
            exit("Please Select Batch");
        }
        $this->db->where('batch', $this->input->post('txtBatch'));
        $this->db->where('status', 'Student');
        if ($this->input->post('selEduFrm') !='') {
            $this->db->where('education_forum', $this->input->post('selEduFrm'));
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = ' and education_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }

        $data['candidates'] = $this->db->query($this->db->get_compiled_select('application').$appendQuery.' order by education_forum, student_name asc');
        $data['show'] = 'campEdit';
        $this->load->view('_xhr', $data);
    }

    public function beneficaryfilter()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $appendQuery = '';

        if ($this->input->post('selEduFrm') == '' && $this->input->post('selForane') == '') {
            exit('<h5 style="color:red"> Please Select a Forane <h5>');
        }

        if ($this->input->post('selEduFrm') !='') {
            $this->db->where('education_forum', $this->input->post('selEduFrm'));
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = ' where education_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }

        $data['candidates'] = $this->db->query($this->db->get_compiled_select('member').$appendQuery.' order by education_forum asc');
        $data['show'] = 'beneficarylist';
        $this->load->view('_xhr', $data);
    }

    public function sharememberfilter()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->helper('url');
        $this->load->database();
        $appendQuery = '';

        if ($this->input->post('selEduFrm') == '' && $this->input->post('selForane') == '') {
            exit('<h5 style="color:red"> Please Select a Forane <h5>');
        }

        if ($this->input->post('selEduFrm') !='') {
            $appendQuery= 'm.education_forum = "'.$this->input->post('selEduFrm').'"';
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = 'm.education_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }

        $data['shares'] = $this->db->query('select s.*, m.forane, m.education_forum, m.name from (select n.id membership_id, n.member_name, c.holder_id, c.share_id, c.id certificate_number, c.share_count, c.issue_date from nidhi_member n, share_certificates c where n.id = c.member_id) s left outer join member m on s.holder_id = m.old_id where '.$appendQuery.' order by m.education_forum asc')->result();
        $data['show'] = 'shareMemberList';
        $this->load->view('_xhr', $data);
    }


    public function forumwiseaggregate()
    {
        $this->load->database();
        $this->db->order_by('id', 'asc');
        $stat = '';
        if ($this->input->post('txtStatus') !='') {
            $stat = ' and status="'.$this->input->post('txtStatus').'"';
        }

        /*$data['list'] = $this->db->query('select education_forum, count(education_forum) count from application where batch="'.$this->input->post('txtBatch').'"'.$stat.' group by education_forum order by education_forum asc');*/

        $data['list'] = $this->db->query('select a.*, f.forane from forane_master f , (select a.education_forum, a.count, e.forane fid from eduforum_master e, (select education_forum, count(education_forum) count from application where batch="'.$this->input->post('txtBatch').'"'.$stat.' group by education_forum order by education_forum asc) a
where a.education_forum = e.eduforum) a where a.fid = f.id order by a.fid, a.education_forum');
        $data['show'] = 'forumwiseAggregate';
        $this->load->view('_xhr', $data);
    }

    public function examresults()
    {
        if ($this->input->post('txtBatch') == '') {
            echo "Please Select a Batch";
        }
        $this->load->database();

        if ($this->input->post('selForane') == '') {
            $condition = '';
        } elseif ($this->input->post('selEduFrm') == '') {
            $forane_id = explode('|', $this->input->post('selForane'));
            $condition = 'where r.education_forum in (select eduforum from eduforum_master where forane ='.$forane_id[0].')';
        } else {
            $condition = 'where r.education_forum = "'.$this->input->post('selEduFrm').'"';
        }

        $data['exresults'] = $this->db->query('select r.* from (select a.student_name, a.education_forum, a.phone, e.* from application a, exams e
where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ="'.$this->input->post('txtBatch').'") r '.$condition.' order by r.total desc');


        $data['show'] = 'examResults';
        $this->load->view('_xhr', $data);
    }

    private function arraywrap($term)
    {
        return 'concat(school," - ",location) like "%'.$term.'%"';
    }
    private function bankwrap($term)
    {
        return 'bank like "%'.$term.'%"';
    }

    public function innterviewcandidates()
    {
        //$this->output->enable_profiler(TRUE);
        if ($this->input->post('txtBatch') == '') {
            exit(" Please Select a Batch");
        }
        $this->load->database();

        if ($this->input->post('selForane') == '') {
            $condition = '';
        } elseif ($this->input->post('selEduFrm') == '') {
            $forane_id = explode('|', $this->input->post('selForane'));
            $condition = 'where r.education_forum in (select eduforum from eduforum_master where forane ='.$forane_id[0].')';
        } else {
            $condition = 'where r.education_forum = "'.$this->input->post('selEduFrm').'"';
        }

        $data['exresults'] = $this->db->query('select r.* from (select a.student_name, a.education_forum, a.phone, e.* from application a, exams e
where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ="'.$this->input->post('txtBatch').'" and a.status="eligible for interview") r '.$condition.' order by r.total desc');


        $data['show'] = 'interviewCandidates';
        $this->load->view('_xhr', $data);
    }

    public function students()
    {
        //$this->output->enable_profiler(TRUE);
        if ($this->input->post('txtBatch') == '') {
            exit(" Please Select a Batch");
        }
        $this->load->database();

        if ($this->input->post('selForane') == '') {
            $condition = '';
        } elseif ($this->input->post('selEduFrm') == '') {
            $forane_id = explode('|', $this->input->post('selForane'));
            $condition = 'where r.education_forum in (select eduforum from eduforum_master where forane ='.$forane_id[0].')';
        } else {
            $condition = 'where r.education_forum = "'.$this->input->post('selEduFrm').'"';
        }

        $data['exresults'] = $this->db->query('select r.* from (select a.student_name, a.education_forum, a.phone, e.* from application a, exams e
where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ="'.$this->input->post('txtBatch').'" and a.status="Student") r '.$condition);


        $data['show'] = 'students';
        $this->load->view('_xhr', $data);
    }

    public function getscholarshipdetails()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $query = $this->db->get_where('scholarship', array('nes_id' => $this->input->post('id')));
        $data['scholarships'] = $query->result();
        if ($query->num_rows() > 0) {
            $data['show'] = 'scholarships';
            $this->load->view('_xhr', $data);
        }
    }

    public function certacklist()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $condition = array();
        if ($this->input->post('selEduFrm') != '') {
            $condition [] = ' and m.education_forum = "'.$this->input->post('selEduFrm').'"';
        }
        if ($this->input->post('txtAck') != '') {
            $condition [] =  ' and s.ack_date = "'.$this->makedate($this->input->post('txtAck')).'"';
        }

        $data['searchResult'] = $this->db->query('select s.id, s.holder_id, m.share_member_id, s.ack_date, m.name, m.guardian_name, m.education_forum, s.ack_date from share_certificates s left join member m on s.holder_id = m.old_id where s.counter_ack is not null'.implode('', $condition).' order by m.education_forum asc')->result();


        $data['show'] = 'certack_export';
        $this->load->view('_xhr', $data);
    }

    public function orphancertificates()
    {
        $this->load->database();
        $data['show'] = 'orphanCert';
        $data['certs'] = $this->db->query('(select 1 as gap_starts_at,(select min(t4.id) -1 from share_certificates t4 where t4.id > 1) as gap_ends_at from share_certificates t5 where not exists (select t6.id from share_certificates t6 where t6.id = 1) having gap_ends_at is not null limit 1) union (select (t1.id + 1) as gap_starts_at, (select min(t3.id) -1 from share_certificates t3 where t3.id > t1.id) as gap_ends_at from share_certificates t1 where not exists (select t2.id from share_certificates t2 where t2.id = t1.id + 1) having gap_ends_at is not null)')->result();

        $this->load->view('_xhr', $data);
    }

    public function newnidhientrylist()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        if ($this->input->post('txtFrom') == '' || $this->input->post('txtTo') == '') {
            exit('Select Date');
        } elseif ($this->input->post('txtFrom') == $this->input->post('txtTo')) {
            $appendQuery =' n.entry_date = "'.$this->makedate($this->input->post('txtFrom')).'"';
        } else {
            $appendQuery = ' n.entry_date between "'.$this->makedate($this->input->post('txtFrom')).'" and "'.$this->makedate($this->input->post('txtTo')).'"';
        }
        if ($this->input->post('selEduFrm') != '') {
            $appendQuery = $appendQuery.' and m.education_forum ="'.$this->input->post('selEduFrm').'" and m.forane="'.$this->input->post('selForane').'"';
        } else {
            //echo "Please Select Education Forum";
        }
        $entries = $this->db->query('select t.*, p.pan_card, p.guardian_aadhar, p.guardian_name pguardain from
(select n.*, m.guardian_name,m.education_forum,m.nominee_name,m.share_member_id from nidhi_ack n
left join member m on n.old_id = m.old_id where '.$appendQuery.' ) t
left join parent_master p on p.share_member_id = t.share_member_id');
        $data['results'] = $entries->result();
        $data['show'] = 'new_nidhi_entry';
        $this->load->view('_xhr', $data);
    }

    public function removecertack()
    {
        $this->load->database();
        $data = array(
        'counter_ack'	=>  null,
        'ack_date'=>  null
        );
        $this->db->where('holder_id', $this->input->post('holder'));
        if ($this->db->update('share_certificates', $data)) {
            echo 'removed';
        }
    }

    private function makedate($dt)
    {
        $newdt = explode('/', $dt);
        return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
    }
}
