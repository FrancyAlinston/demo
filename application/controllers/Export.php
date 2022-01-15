<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='Mexport';
    }

    public function courselist()
    {
        $this->load->database();
        $this->db->order_by('course', 'asc');
        $courses = $this->db->get('course_master');

        $arrayData = array();
        $arrayData[] = array('Course Name','Course Abbreviation', 'Notes', 'Action');

        foreach ($courses->result() as $course) {
            $arrayData[] = array($course->course,
            $course->abbr,
            $course->notes);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Course List.xlsx');
        $this->load->helper('url');
        redirect(base_url().'export/Course List.xlsx', 'location');
    }

    public function batchlist()
    {
        $this->load->database();
        $courses = $this->db->query('select b.id, c.course, b.course_id, b.year_span, b.notes from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');

        $arrayData = array();
        $arrayData[] = array('Course Name','Batch', 'Notes');

        foreach ($courses->result() as $course) {
            $arrayData[] = array($course->course,
            $course->year_span,
            $course->notes);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Batch List.xlsx');
        $this->load->helper('url');
        redirect(base_url().'export/Batch List.xlsx', 'location');
    }

    public function applicationlist()
    {
        $this->load->database();
        //$this->output->enable_profiler(TRUE);
        $appendQuery = '';
        if ($this->input->post('txtBatch') == '') {
            exit("Please Select Batch");
        }
        $this->db->select($this->input->post('col'));
        $this->db->where('batch', $this->input->post('txtBatch'));
        if ($this->input->post('txtStatus') !='') {
            $this->db->where('status', $this->input->post('txtStatus'));
        }
        if ($this->input->post('selEduFrm') !='') {
            $this->db->where('education_forum', $this->input->post('selEduFrm'));
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = ' and education_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }
        $data['candidates'] = $this->db->query($this->db->get_compiled_select('application').$appendQuery.' order by education_forum asc');
        //$data['candidates'] = $this->db->get_where('application', $filter);
        $arrayData = array();
        $header = explode(',', $this->input->post('col'));
        array_unshift($header, 'Si.No');
        $arrayData[] = $header;
        $cnt=0;
        foreach ($data['candidates']->result_array() as $row) {
            $cnt++;
            array_unshift($row, $cnt);
            $arrayData[] = $row;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Students List.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Students List.xlsx';
    }

    public function beneficiarylist()
    {
        $this->load->database();
        //$this->output->enable_profiler(TRUE);
        $appendQuery = '';
        $this->db->select($this->input->post('col'));
        if ($this->input->post('selEduFrm') !='') {
            $this->db->where('education_forum', $this->input->post('selEduFrm'));
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = ' where education_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }

        $data['beneficiary'] = $this->db->query($this->db->get_compiled_select('member').$appendQuery.' order by education_forum asc');


        $arrayData = array();

        $header = explode(',', $this->input->post('col'));
        array_unshift($header, 'Si.No');
        $arrayData[] = $header;
        $cnt=0;
        foreach ($data['beneficiary']->result_array() as $row) {
            $cnt++;
            array_unshift($row, $cnt);
            $arrayData[] = $row;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Beneficiary List.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Beneficiary List.xlsx';
    }


    public function forumwiseaggregate()
    {
        $this->load->database();
        $this->db->order_by('id', 'asc');
        $stat = '';
        if ($this->input->post('txtStatus') !='') {
            $stat = ' and status="'.$this->input->post('txtStatus').'"';
        }

        $data['list'] = $this->db->query('select a.*, f.forane from forane_master f , (select a.education_forum, a.count, e.forane fid from eduforum_master e, (select education_forum, count(education_forum) count from application where batch="'.$this->input->post('txtBatch').'"'.$stat.' group by education_forum order by education_forum asc) a
		where a.education_forum = e.eduforum) a where a.fid = f.id order by a.fid, a.education_forum');

        $arrayData = array();
        //Header
        $arrayData[] = array('Si.No','Education Forun', 'Count', 'Forane ID', 'Forane');
        $cnt=0;
        $total = 0;
        foreach ($data['list']->result_array() as $row) {
            $cnt++;
            $arrayData[] = array($cnt,ucwords($row['education_forum']),$row['count'],$row['fid'],ucwords($row['forane']));
            $total += $row['count'];
        }
        $arrayData[] = array('','Total',$total,'','');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Forumwise Combined.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Forumwise Combined.xlsx';
    }

    public function examresults()
    {
        if ($this->input->post('txtBatch') == '') {
            echo "Please Select a Batch";
        }
        $this->load->database();
        //$data['exresults'] = $this->db->query('select a.student_name,a.education_forum, e.* from application a, exams e where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ="'.$this->input->post('txtBatch').'"');

        if ($this->input->post('selForane') == '') {
            $condition = '';
        } elseif ($this->input->post('selEduFrm') == '') {
            $forane_id = explode('|', $this->input->post('selForane'));
            $condition = 'where r.education_forum in (select eduforum from eduforum_master where forane ='.$forane_id[0].')';
        } else {
            $condition = 'where r.education_forum = "'.$this->input->post('selEduFrm').'"';
        }

        $exresults = $this->db->query('select r.* from (select a.student_name, a.education_forum, a.phone, e.* from application a, exams e
		where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ="'.$this->input->post('txtBatch').'") r '.$condition.' order by r.total desc');


        $res = $exresults->result();
        $arrayData=array();
        $header = array('Si.No','ID','Student Name','Phone','Education Forum');

        if (count($res) == 0) {
            exit('No exams available for this batch');
        }
        $markhead = json_decode($res{0}->marks, true);
        $temp = '';

        foreach ($markhead as $key => $value) {
            $header[] = ucwords(str_replace('sub-', '', $key));
        }
        array_push($header, 'Total', 'Rank', 'Percentage');
        $arrayData[] = $header;

        $rcnt = 1;
        foreach ($res as $result) {
            $row = array($rcnt,$result->candidate_id,$result->student_name,$result->phone,$result->education_forum);
            $markhead = json_decode($result->marks, true);

            foreach ($markhead as $key => $value) {
                $row[] = ucwords($value);
            }

            array_push($row, $result->total, $result->rank, $result->percentage);
            $rcnt++;
            $arrayData[] = $row;
        }


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Exam Results.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Exam Results.xlsx';
    }

    public function innterviewcandidates()
    {
        //$this->output->enable_profiler(TRUE);
        if ($this->input->post('txtBatch') == '') {
            echo "Please Select a Batch";
        }
        $this->load->database();

        if ($this->input->post('selForane') == '') {
            $condition = ' order by r.education_forum';
        } elseif ($this->input->post('selEduFrm') == '') {
            $forane_id = explode('|', $this->input->post('selForane'));
            $condition = 'where r.education_forum in (select eduforum from eduforum_master where forane ='.$forane_id[0].') order by r.education_forum';
        } else {
            $condition = 'where r.education_forum = "'.$this->input->post('selEduFrm').'" order by r.education_forum';
        }

        $exresults = $this->db->query('select r.* from (select a.student_name, a.education_forum, a.phone, e.* from application a, exams e
		where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ="'.$this->input->post('txtBatch').'" and a.status="eligible for interview") r '.$condition);


        $res = $exresults->result();
        $arrayData=array();
        $header = array('Si.No','ID','Student Name','Phone','Education Forum');

        if (count($res) == 0) {
            exit('No exams available for this batch');
        }
        $markhead = json_decode($res{0}->marks, true);
        $temp = '';

        foreach ($markhead as $key => $value) {
            $header[] = ucwords(str_replace('sub-', '', $key));
        }
        array_push($header, 'Total', 'Rank', 'Percentage', 'Interview', 'Grand Total');
        $arrayData[] = $header;

        $rcnt = 1;
        foreach ($res as $result) {
            $row = array($rcnt,$result->candidate_id,$result->student_name,$result->phone,$result->education_forum);
            $markhead = json_decode($result->marks, true);

            foreach ($markhead as $key => $value) {
                $row[] = ucwords($value);
            }

            array_push($row, $result->total, $result->rank, $result->percentage, $result->interview, $result->grand_total);
            $rcnt++;
            $arrayData[] = $row;
        }


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Interview_Selected_Candidates.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Interview_Selected_Candidates.xlsx';
    }

    public function studentscandidates()
    {
        //$this->output->enable_profiler(TRUE);
        if ($this->input->post('txtBatch') == '') {
            echo "Please Select a Batch";
        }
        $this->load->database();

        if ($this->input->post('selForane') == '') {
            $condition = ' order by r.education_forum';
        } elseif ($this->input->post('selEduFrm') == '') {
            $forane_id = explode('|', $this->input->post('selForane'));
            $condition = 'where r.education_forum in (select eduforum from eduforum_master where forane ='.$forane_id[0].') order by r.education_forum';
        } else {
            $condition = 'where r.education_forum = "'.$this->input->post('selEduFrm').'" order by r.education_forum';
        }

        $exresults = $this->db->query('select r.* from (select a.student_name, a.education_forum, a.phone, a.gender, e.* from application a, exams e
		where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ="'.$this->input->post('txtBatch').'" and a.status="Student") r '.$condition);


        $res = $exresults->result();
        $arrayData=array();
        $header = array('Si.No','ID','Student Name','Gender','Phone','Education Forum');

        if (count($res) == 0) {
            exit('No exams available for this batch');
        }
        $markhead = json_decode($res{0}->marks, true);
        $temp = '';

        foreach ($markhead as $key => $value) {
            $header[] = ucwords(str_replace('sub-', '', $key));
        }
        array_push($header, 'Total', 'Rank', 'Percentage', 'Interview', 'Grand Total');
        $arrayData[] = $header;

        $rcnt = 1;
        foreach ($res as $result) {
            $row = array($rcnt,$result->candidate_id,$result->student_name,$result->gender,$result->phone,$result->education_forum);
            $markhead = json_decode($result->marks, true);

            foreach ($markhead as $key => $value) {
                $row[] = ucwords($value);
            }

            array_push($row, $result->total, $result->rank, $result->percentage, $result->interview, $result->grand_total);
            $rcnt++;
            $arrayData[] = $row;
        }


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Student_Candidates.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Student_Candidates.xlsx';
    }



    public function corplist()
    {
        $this->load->database();
        $courses = $this->db->query('select id,donor,edu_forum,donor_address,directory_page,ppt_page,amount,in_memory,don_picture,inmem_picture from corpus_fund');

        $arrayData = array();
        $arrayData[] = array('ID','Donor', 'Education Forum / Institution', 'Donor Address', 'Directory page','PPT Page','Amount','In Memmory Of', 'Donor Image', 'InMemmory Image');

        foreach ($courses->result() as $course) {
            $arrayData[] = array($course->id,
            $course->donor,
            $course->edu_forum,
            $course->donor_address,
            $course->directory_page,
            $course->ppt_page,
            $course->amount,
            $course->in_memory,
            $course->don_picture,
            $course->inmem_picture
        );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Corpus_Fund.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Corpus_Fund.xlsx';
    }

    public function shareapplicationlist()
    {
        $this->load->database();
        if ($this->input->post('from') == '' || $this->input->post('to') == '') {
            $courses = $this->db->query('select * from shares_rec');
        } else {
            $courses = $courses = $this->db->query('select * from shares_rec where entry_date between "'.$this->makedate($this->input->post('from')).'" and "'.$this->makedate($this->input->post('to')).'"');
        }

        $arrayData = array();
        $arrayData[] = array('ID','NES ID', 'Beneficiary','Duardian','Education Forum','Phone','Receipt','Shares','Entry Date');

        foreach ($courses->result() as $course) {
            $arrayData[] = array($course->id,
        $course->nes_id,
        $course->student_name,
        $course->guardian,
        $course->education_forum,
        $course->phone,
        $course->receipt,
        $course->shares,
        $course->entry_date
    );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Share_Application_List.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Share_Application_List.xlsx';
    }

    public function sharememberlsit()
    {
        $this->load->database();

        if ($this->input->post('selEduFrm') == '' && $this->input->post('selForane') == '') {
            //exit('<h5 style="color:red"> Please Select a Forane <h5>');
            $appendQuery = '';
        }
        if ($this->input->post('selEduFrm') !='') {
            $appendQuery= 'where education_forum = "'.$this->input->post('selEduFrm').'"';
        } elseif ($this->input->post('selForane') != '') {
            $forane = explode('|', $this->input->post('selForane'));
            $appendQuery = 'where education_forum in (select eduforum from eduforum_master where forane ='.$forane[0].')';
        }


        if ($this->input->post('txtFrom') == '' || $this->input->post('txtTo') == '') {
            $appendDate = '';
        } elseif ($this->input->post('txtFrom') == $this->input->post('txtTo')) {
            $appendDate =' and date(entry_date) = "'.$this->makedate($this->input->post('txtFrom')).'"';
        } else {
            $appendDate = 'and entry_date between "'.$this->makedate($this->input->post('txtFrom')).'" and "'.$this->makedate($this->input->post('txtTo')).'"';
        }

        $shares = $this->db->query('select id,member_name,aadhar,date_format(entry_date,"%d/%m/%Y") entry_date from nidhi_member where aadhar in (select distinct guardian_aadhar from member '.$appendQuery.') '.$appendDate.'order by id asc');

        $arrayData = array();
        $arrayData[] = array('Membership ID','Member Name','Aadhar','Members Since');

        foreach ($shares->result() as $share) {
            $arrayData[] = array($share->id,
        $share->member_name,
        $share->aadhar,
        $share->entry_date
    );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Share_Member_List.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Share_Member_List.xlsx';
    }
    public function sharecertificatelisttally()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        if ($this->input->post('txtFrom') == '' || $this->input->post('txtTo') == '') {
            exit('Select Date');
        } elseif ($this->input->post('txtFrom') == $this->input->post('txtTo')) {
            $appendQuery =' and date(n.entry_date) = "'.$this->makedate($this->input->post('txtFrom')).'"';
        } else {
            $appendQuery = 'and n.entry_date between "'.$this->makedate($this->input->post('txtFrom')).'" and "'.$this->makedate($this->input->post('txtTo')).'"';
            if ($this->input->post('selEduFrm') != '') {
                $appendQuery = $appendQuery.' and m.education_forum ="'.$this->input->post('selEduFrm').'" and m.forane="'.$this->input->post('selForane').'"';
            } else {
                //echo "Please Select Education Forum";
            }
        }



        $shares = $this->db->query('select r.*,c.id certificate_id from (select n.member_name, m.name, m.old_id, m.forane, m.education_forum, m.permanent_address, m.guardian_phone,m.guardian_aadhar, m.nominee_name, m.share_member_id, m.pan_card,m.email, n.entry_date from nidhi_member n, member m where n.id = m.share_member_id '.$appendQuery.' order by m.education_forum asc)r left outer join share_certificates c on r.old_id = c.holder_id');


        $arrayData = array();
        $arrayData[] = array('Ledger Name','Drirect Group','Address line1','Address line2','Address line3','Address line4','Address line 5','State','Rate','Per','On','Applicable','Rounding','Rounding Limit','Nomnee name','Memebership No','Certificate No','Pan Card','Aadhar','Email','Member Since');

        foreach ($shares->result() as $share) {
            $addr = explode("\n", $share->permanent_address);
            if (!isset($addr[1])) {
                $addr[1]='';
            }
            if (!isset($addr[2])) {
                $addr[2]='';
            }
            if (!isset($addr[3])) {
                $addr[3]='';
            }


            $forane = explode('|', $share->forane);
            $arrayData[] = array(
            $share->old_id.' '.$share->name.' - '.$share->member_name,
            $share->education_forum.' Forum',
            trim($addr[0]),
            trim($addr[1]),
            trim($addr[2]),
            trim($addr[3]),
            $share->guardian_phone,
            'Kerala',
            '2.76%',
            'Calender Year',
            'On All Balances',
            '01-04-2020','not applicable','0',
            $share->nominee_name,
            $share->share_member_id.' - '.$share->member_name,
            $share->certificate_id,
            $share->pan_card,
            $share->guardian_aadhar,
            $share->email,
            $share->entry_date
        );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/tallyExport.xlsx');
        $this->load->helper('url');
        echo base_url().'export/tallyExport.xlsx';
    }

    public function modifiedprofilestally()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        if ($this->input->post('txtFrom') == '' || $this->input->post('txtTo') == '') {
            exit('Select Date');
        } elseif ($this->input->post('txtFrom') == $this->input->post('txtTo')) {
            $appendQuery =' date(m.entry_date) = "'.$this->makedate($this->input->post('txtFrom')).'"';
        } else {
            $appendQuery = ' m.entry_date between "'.$this->makedate($this->input->post('txtFrom')).'" and "'.$this->makedate($this->input->post('txtTo')).'"';
        }
        if ($this->input->post('selEduFrm') != '') {
            $appendQuery = $appendQuery.' and m.education_forum ="'.$this->input->post('selEduFrm').'" and m.forane="'.$this->input->post('selForane').'"';
        } else {
            //echo "Please Select Education Forum";
        }

        $shares = $this->db->query('select m.*, mb.member_name from member m left join nidhi_member mb  on m.share_member_id = mb.id where '.$appendQuery.' and m.is_nidhi=1 order by m.education_forum asc');

        $arrayData = array();
        $arrayData[] = array('Ledger Name','Drirect Group','Address line1','Address line2','Address line3','Address line4','Address line 5','State','Rate','Per','On','Applicable','Rounding','Rounding Limit','Nomnee name','Memebership No','Certificate No','Pan Card','Aadhar','Email');

        foreach ($shares->result() as $share) {
            $addr = explode("\n", $share->permanent_address);
            if (!isset($addr[1])) {
                $addr[1]='';
            }
            if (!isset($addr[2])) {
                $addr[2]='';
            }
            if (!isset($addr[3])) {
                $addr[3]='';
            }


            $forane = explode('|', $share->forane);
            $arrayData[] = array(
            $share->old_id.' '.$share->name.' - '.$share->guardian_name,
            $share->education_forum.' Forum',
            trim($addr[0]),
            trim($addr[1]),
            trim($addr[2]),
            trim($addr[3]),
            $share->guardian_phone,
            'Kerala',
            '2.76%',
            'Calender Year',
            'On All Balances',
            '01-04-2020','not applicable','0',
            $share->nominee_name,
            $share->share_member_id.' - '.$share->member_name,
            '',
            $share->pan_card,
            $share->guardian_aadhar,
            $share->email
        );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/tallyExportChangedProfiles.xlsx');
        $this->load->helper('url');
        echo base_url().'export/tallyExportChangedProfiles.xlsx';
    }


    public function sharecertificatealloteeslist()
    {
        $this->load->database();
        //$this->output->enable_profiler(TRUE);
        if ($this->input->post('txtFrom') == '' || $this->input->post('txtTo') == '') {
            exit('Select Date');
        } elseif ($this->input->post('txtFrom') == $this->input->post('txtTo')) {
            $appendQuery ='date(s.issue_date) = "'.$this->makedate($this->input->post('txtFrom')).'"';
        } else {
            $appendQuery = 's.issue_date between "'.$this->makedate($this->input->post('txtFrom')).'" and "'.$this->makedate($this->input->post('txtTo')).'"';
        }

        //$shares = $this->db->query('select s.*,p.guardian_aadhar , p.pan_card, p.email, p.guardian_name, p.permanent_address, p.guardian_occupation from share_certificates s left outer join parent_master p on p.share_member_id = s.member_id where '.$appendQuery.' order by s.id');
        $shares = $this->db->query('select s.*,m.guardian_aadhar, m.pan_card, m.email, m.guardian_name, m.permanent_address, m.guardian_occupation from share_certificates s left outer join member m on m.old_id = s.holder_id where '.$appendQuery.' order by s.id');


        $arrayData = array();
        $arrayData[] = array('VNEN No','Folio Number','Share Certificate No','Name','Aadhar','PAN','Email','Address','Number Of Shares','Paid Up Amount','Distinctive No Of Shares From-To','Occupation');

        foreach ($shares->result() as $share) {
            $addr = explode("\n", $share->permanent_address);
            $arrayData[] = array(
            $share->holder_id,
            $share->member_id,
            $share->id,
            $share->guardian_name,
            $share->guardian_aadhar,
            $share->pan_card,
            $share->email,
            preg_replace("/[\n\r]/", ' ', $share->permanent_address),
            $share->share_count,
            (abs($share->share_count)*10),
            $share->share_id,
            $share->guardian_occupation
        );
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/alloteeslist.xlsx');
        $this->load->helper('url');
        echo base_url().'export/alloteeslist.xlsx';
    }

    public function scholarshipalloties()
    {
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

        $scholarship = $this->db->query($this->db->get_compiled_select('scholarship').$appendQuery.' order by name,edu_forum asc');

        $arrayData = array();
        $arrayData[] = array('Application No','Batch ID','NES ID','Name','Payee','Guardain','Gender','Course','Specialization','Education Forun','BCC Number','BCC Name','Phone','Phone Secondry','Status','PlusTwo Percentage','Cert PlusTwo','Cert Course','Cert Marklist','Pts Course','Pts Perfomance','Pts Regularity','Pts Membership Period','Pts Special','Points','Shcolarship');

        foreach ($scholarship->result() as $ship) {
            if ($ship->gender == 1) {
                $gender = 'Male';
            } else {
                $gender = 'Female';
            }
            $forum = ucwords($ship->edu_forum);
            $arrayData[] = array(
            $ship->app_num,
            $ship->generated_id,
            $ship->nes_id,
            $ship->name,
            $ship->payee,
            $ship->gauardain,
            $gender,
            $ship->course_text,
            $ship->specialisation,
            $ship->edu_forum,
            $ship->bcc_number,
            $ship->bcc_name,
            $ship->phone,
            $ship->phone_sec,
            $ship->status,
            $ship->plustwo_total,
            $ship->plus_two,
            $ship->course_certificate,
            $ship->mark_list,
            $ship->course,
            $ship->performance,
            $ship->nav_regularity,
            $ship->membership_period,
            $ship->special_points,
            $ship->points,
            $ship->amount_recived
        );
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Scholarshipalloteeslist.xlsx');
        $this->load->helper('url');
        echo base_url().'export/Scholarshipalloteeslist.xlsx';
    }


    public function scholarshipcoursewise()
    {
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
        $scholarship = $data['scholarship'] = $this->db->query($this->db->get_compiled_select('scholarship').$appendQuery.' group by course_text order by count desc');

        $arrayData = array();
        $arrayData[] = array('Course','Count');
        $total = 0;

        foreach ($scholarship->result() as $ship) {
            $total = $total + $ship->count;
            $arrayData[] = array(
            $ship->course_text,
            $ship->count
        );
        }
        $arrayData[] = array(
        'Total',
        $total
    );
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/ScholarshipCourseWise.xlsx');
        $this->load->helper('url');
        echo base_url().'export/ScholarshipCourseWise.xlsx';
    }



    public function scholarshipindividualhistory()
    {
        $this->load->database();
        $scholarship = $this->db->query('select nes_id, name, edu_forum, year(entry_date) year ,amount_recived from scholarship where nes_id in(select nes_id from scholarship where year(entry_date)  = year(curdate())) order by nes_id, year(entry_date) desc')->result();
        $yearly = array();
        $arrayData = array();

        foreach (range(2018, date('Y')) as $number) {
            $yearly[$number] = $number ;
        }
        $arrayData[] = array_merge_recursive(array('NES ID','Name','Forum'), $yearly);
        $yearly = array_fill_keys(array_keys($yearly), null);
        $cnt = 0;
        foreach ($scholarship as $ship) {
            if (isset($scholarship[$cnt+1]) && $scholarship[$cnt+1]->nes_id == $ship->nes_id) {
                $yearly[$ship->year] = $ship->amount_recived;
                $cnt++;
                continue;
            } else {
                $yearly[$ship->year] = $ship->amount_recived;
                $arrayData[] = array_merge_recursive(array(
                $ship->nes_id,
                $ship->name,
                $ship->edu_forum
            ), $yearly);
                $yearly = array_fill_keys(array_keys($yearly), null);
            }
            $cnt++;
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/scholarshipindividualhistory.xlsx');
        $this->load->helper('url');
        echo base_url().'export/scholarshipindividualhistory.xlsx';
    }



    public function scholarshipforumwise()
    {
        $this->load->database();
        $scholarship = $this->db->query('select s.edu_forum, count(s.edu_forum) count, e.forane from scholarship s left join eduforum_master e on e.eduforum = s.edu_forum where year(s.entry_date) = "'.$this->input->post('txtYear').'" group by s.edu_forum order by count desc');

        $arrayData = array();
        $arrayData[] = array('Forane','Education Forum','Count');
        $total = 0;

        foreach ($scholarship->result() as $ship) {
            $total = $total + $ship->count;
            $arrayData[] = array(
            $ship->forane,
            $ship->edu_forum,
            $ship->count
        );
        }
        $arrayData[] = array(
        ' ',
        'Total',
        $total
    );
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/scholarshipforumwise.xlsx');
        $this->load->helper('url');
        echo base_url().'export/scholarshipforumwise.xlsx';
    }

    public function corpusForumwiseAggregate()
    {
        $this->load->database();
        $funds = $this->db->query('select c.*, e.forane from (select edu_forum, sum(amount) amount from corpus_fund group by edu_forum)c left join eduforum_master e on e.eduforum = c.edu_forum');
        $arrayData = array();
        $arrayData[] = array('Si No','Education Forun','Forane', 'Amount');
        $total = 0;
        $cnt = 0;
        foreach ($funds->result() as $fund) {
            $total = $total + abs($fund->amount);
            $cnt++;
            $arrayData[] = array(
            $cnt,
            $fund->edu_forum,
            $fund->forane,
            $fund->amount
        );
        }
        $arrayData[] = array('','','Total',$total);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/CorpusForumwiseAggregate.xlsx');
        $this->load->helper('url');
        echo base_url().'export/CorpusForumwiseAggregate.xlsx';
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

        $certs = $this->db->query('select s.id, s.holder_id, s.ack_date, m.share_member_id, m.name, m.guardian_name, m.education_forum, s.ack_date from share_certificates s left join member m on s.holder_id = m.old_id where s.counter_ack is not null'.implode('', $condition).' order by m.education_forum asc')->result();
        $arrayData = array();
        $arrayData[] = array('Si No','ID','Ack Date','Beneficary ID','Memeber ID','Beneficary','Guardain','Education Forun');
        $total = 0;
        $cnt = 0;
        foreach ($certs as $cert) {
            $cnt++;
            $arrayData[] = array(
            $cnt,
            $cert->id,
            $cert->ack_date,
            $cert->holder_id,
            $cert->share_member_id,
            $cert->name,
            $cert->guardian_name,
            $cert->education_forum
        );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/CertAckReport.xlsx');
        $this->load->helper('url');
        echo base_url().'export/CertAckReport.xlsx';
    }

    public function newnidhienntryexport()
    {
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
        $results = $entries->result();
        $arrayData = array();
        $arrayData[] = array('Entry ID','Nes ID','Entry Date','Beneficary','Guardian [Member Profile]','Guardian [Parent Profile]','Education Forun','Nomnee','Member ID','Guardian Aadhar','Guardian PAN');
        $total = 0;
        $cnt = 0;
        foreach ($results as $item) {
            $cnt++;
            $arrayData[] = array(
            $item->id,
            $item->old_id,
            $item->entry_date,
            $item->name,
            $item->guardian_name,
            $item->pguardain,
            $item->education_forum,
            $item->nominee_name,
            $item->share_member_id,
            $item->guardian_aadhar,
            $item->pan_card
        );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/NidhiNewEntryReport.xlsx');
        $this->load->helper('url');
        echo base_url().'export/NidhiNewEntryReport.xlsx';
    }

    public function scolarshipcoursepoints()
    {
        $this->load->database();
        $this->db->order_by('points', 'asc');
        $results = $this->db->get('scholarship_courses')->result();
        $arrayData = array();
        $arrayData[] = array('Si No','Course','Points');
        $total = 0;
        $cnt = 0;

        foreach ($results as $item) {
            $cnt++;
            $arrayData[] = array(
            $cnt,
            $item->course,
            $item->points
        );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/ScolarshipCoursePoints.xlsx');
        $this->load->helper('url');
        echo base_url().'export/ScolarshipCoursePoints.xlsx';
    }

    public function accountstally()
    {
        $this->load->database();
        if (isset($_POST['frm_date'])) {
            $frm_date = $this->makedate($_POST['frm_date']);
        } else {
            $frm_date = date('Y-m-d');
        }
        if (isset($_POST['to_date'])) {
            $to_date = $this->makedate($_POST['to_date']);
        } else {
            $to_date = date('Y-m-d');
        }
        //$condition = array('tran_date' => $tran_date);

        if ($this->input->post('selUser') != '') {
            $condition['accountant'] =$this->input->post('selUser');
        }

        $condition['date(entry_date) >='] = $frm_date;
        $condition['date(entry_date) <='] = $to_date;
        $this->db->select('id,ledger,type,forum,account,tran_date,amount,narration,accountant,payment_id,receipt_id,contra_id');
        $results = $this->db->get_where('accounts', $condition)->result();
        $arrayReceipt = $arrayPayment = $arrayContra = array();
        $arrayReceipt[] = $arrayPayment[] = $arrayContra[] = array('Date','Voucher No','Credit / Debit Led Name','Ref.Dr Amount','Ref.Cr Amount','Narration','Favouring','Trans Type','Inst.No','Inst Date','Bank Name','Branch');
        $total = 0;
        $cnt = 0;

        foreach ($results as $item) {
            $item->tran_date = \PhpOffice\PhpSpreadsheet\Shared\Date::stringToExcel($item->tran_date);
            $credit = $debit = '';
            if ($item->amount > 0) {
                $credit =  $item->amount;
            } else {
                $debit = abs($item->amount);
            }
            if ($item->type == 'Reciept') {
                $instDate = $favouring = $tranType = $bankName = '';
                if ($item->account != 'Cash') {
                    $ledhead = $bankName = $item->account;
                    $tranType = 'Cheque/DD';
                    $favouring = $item->ledger;
                    $instDate = $item->tran_date;
                } else {
                    $ledhead = 'Cash';
                }
                $arrayReceipt[] = array(
                $item->tran_date,
                'R'.$item->receipt_id,
                $ledhead,
                $credit,
                $debit,
                $item->narration,
                $favouring,
                $tranType,
                '',
                $instDate,
                $bankName,
                ''
            );

                $arrayReceipt[] = array(
                $item->tran_date,
                'R'.$item->receipt_id,
                $item->ledger,
                $debit,
                $credit,
                $item->narration,
                '',
                $tranType,
                '',
                $instDate,

                $bankName,
                ''
            );
            }
            if ($item->type == 'Payment') {
                $instDate = $favouring = $tranType = $bankName = '';
                if ($item->account == 'Cash') {
                    $ledhead = $item->ledger;
                } else {
                    $ledhead = 'Cash';
                }
                $start = $item->tran_date;
                $arrayPayment[] = array(
                $item->tran_date,
                'P'.$item->payment_id,
                $ledhead,
                $debit,
                $credit,
                $item->narration,
                $favouring,
                $tranType,
                $instDate,
                '',
                $bankName,
                ''
            );

                $arrayPayment[] = array(
                $item->tran_date,
                'P'.$item->payment_id,
                $item->account,
                $credit,
                $debit,
                $item->narration,
                '',
                $tranType,
                $instDate,
                '',
                $bankName,
                ''
            );
            }

            if ($item->type == 'Contra') {
                $instDate = $favouring = $tranType = $bankName = '';
                if ($item->account != 'Cash') {
                    $ledhead = $bankName = $item->account;
                    $tranType = 'Cash';
                    $favouring = $item->ledger;
                    $instDate = $item->tran_date;
                } else {
                    $ledhead = 'Cash';
                }

                $arrayContra[] = array(
                $item->tran_date,
                'C'.$item->contra_id,
                $ledhead,
                $debit,
                $credit,
                $item->narration,
                '',
                $tranType,
                '',
                $instDate,
                $bankName,
                ''
            );

                $arrayContra[] = array(
                $item->tran_date,
                'C'.$item->contra_id,
                $item->ledger,
                $credit,
                $debit,
                $item->narration,
                '',
                $tranType,
                '',
                $instDate,
                $bankName,
                ''
            );
            }
        }

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('Receipt');
        $spreadsheet->getActiveSheet()->fromArray($arrayReceipt, null, 'A1');
        $spreadsheet->getActiveSheet()->getStyle('A1:A5000')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
        $spreadsheet->getActiveSheet()->getStyle('J1:J5000')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Receipt.xlsx');

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('Payment');
        $spreadsheet->getActiveSheet()->fromArray($arrayPayment, null, 'A1');
        $spreadsheet->getActiveSheet()->getStyle('A1:A5000')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
        $spreadsheet->getActiveSheet()->getStyle('J1:J5000')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Payment.xlsx');

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('Contra');
        $spreadsheet->getActiveSheet()->fromArray($arrayContra, null, 'A1');
        $spreadsheet->getActiveSheet()->getStyle('A1:A5000')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
        $spreadsheet->getActiveSheet()->getStyle('J1:J5000')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Contra.xlsx');

        //$writer->setShouldFormatDates(true);
    //$writer->save(FCPATH.'export/AccountsTallyExport.xlsx');
    //$this->load->helper('url');
    //print_r($arrayReceipt);
    //echo base_url().'export/AccountsTallyExport.xlsx';
    }

    public function accountsfilter()
    {
        $this->load->database();
        $condition = array();
        if ($this->input->post('type') != '') {
            $condition['type'] = $this->input->post('type');
        }
        if ($this->input->post('leadger_head') != '') {
            $condition['ledger'] = $this->input->post('leadger_head');
        }

        if ($this->input->post('bank') != '') {
            $condition['account'] = $this->input->post('bank');
        }

        if ($this->input->post('eduforum') != '') {
            $condition['forum'] = $this->input->post('bank');
        }

        $condition['entry_date >='] = $this->makedate($_POST['frm_date']);
        $condition['entry_date <='] = $this->makedate($_POST['to_date']);

        $this->db->select('id,ledger,type,forum,account,tran_date,amount,narration,accountant,entry_date,payment_id,receipt_id,contra_id');
        $this->db->where($condition);
        $transactions = $this->db->get('accounts')->result();
        $arrayData = array();
        $arrayData[] = array('ID#','Voucher#','User','Date','Ledger','Type','Forum','Account','Narration','Amount');
        foreach ($transactions as $tran) {
            if ($tran->type == 'Reciept') {
                $voucher = 'R'.$tran->receipt_id;
            } elseif ($tran->type == 'Payment') {
                $voucher = 'P'.$tran->payment_id;
            } elseif ($tran->type == 'Contra') {
                $voucher = 'C'.$tran->contra_id;
            }
            $arrayData[] = array(
            $tran->id,
            $voucher,
            $tran->accountant,
            date('d-m-Y', strtotime($tran->tran_date)),
            $tran->ledger,
            $tran->type,
            $tran->forum,
            $tran->account,
            $tran->narration,
            $tran->amount
        );
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/AccountsFilter.xlsx');
        $this->load->helper('url');
        echo base_url().'export/AccountsFilter.xlsx';
    }


    private function makedate($dt)
    {
        $newdt = explode('/', $dt);
        return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
    }


    public function neftExport()
    {
        // $this->output->enable_profiler(true);
        $this->load->database();
        // print_r($_POST);
        $response = array(
        'error' => true,
        'msg'	=> 'Unknown error'
    );
        $dateFrom = htmlspecialchars($this->input->post('dateFrom'));
        $dateTo = htmlspecialchars($this->input->post('dateTo'));


        if (!$dateFrom) {
            $response = array(
            'error' => true,
            'msg'	=> 'please provide start date'
        );
        }

        if (!$dateTo) {
            $dateTo = date('d M Y');
        }


        $dateFrom = date_create_from_format("d M Y", $dateFrom);
        $dateFrom = date_format($dateFrom, "Y-m-d");
        $dateTo = date_create_from_format("d M Y", $dateTo);
        $dateTo = date_format($dateTo, "Y-m-d");

        // echo $dateFrom;
        // echo $dateTo;
        // $this->db->order_by('course', 'asc');
        // $courses = $this->db->get('course_master');
        $query = $this->db->query("SELECT * FROM `neftaccountclosed` WHERE `date` BETWEEN '$dateFrom' AND '$dateTo' ORDER BY `date` ASC");

        $arrayData = array();
        $arrayData[] = array('Nes Id','Account Number', 'Account Name', 'IFSC', 'Branch Id', 'Bank Name', 'Scheme Amount', 'Nidhi Amount');

        foreach ($query->result_array() as $value) {
            $arrayData[] = array(
                            $value['nes_id'],
                            $value['acnumber'],
                            $value['acname'],
                            $value['ifsc'],
                            $value['branchid'],
                            $value['bank_name'],
                            $value['scheme_amt'],
                            $value['nidhi_amt'],
                            // $value['date']
                    );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Neft List.xlsx');
        $this->load->helper('url');
        // redirect(base_url().'export/Neft List.xlsx', 'location');

        $response = array(
        'error' => false,
        'msg'	=> base_url().'export/Neft List.xlsx'
    );
        echo json_encode($response);
    }

    //RazorPay export

    public function razorExport()
    {
        // $this->output->enable_profiler(true);
        $this->load->database();
        // print_r($_POST);
        $response = array(
        'error' => true,
        'msg'	=> 'Unknown error'
    );
        $dateFrom = htmlspecialchars($this->input->post('dateFrom'));
        $dateTo = htmlspecialchars($this->input->post('dateTo'));


        if (!$dateFrom) {
            $response = array(
            'error' => true,
            'msg'	=> 'please provide start date'
        );
        }

        if (!$dateTo) {
            $dateTo = date('d M Y');
        }


        $dateFrom = date_create_from_format("d M Y", $dateFrom);
        $dateFrom = date_format($dateFrom, "Y-m-d");
        $dateTo = date_create_from_format("d M Y", $dateTo);
        $dateTo = date_format($dateTo, "Y-m-d");

        // echo $dateFrom;
        // echo $dateTo;
        // $this->db->order_by('course', 'asc');
        // $courses = $this->db->get('course_master');
        // $query = $this->db->query("SELECT * FROM `razorpay` WHERE `settled_date` BETWEEN '$dateFrom' AND '$dateTo' ORDER BY `settled_date` ASC");
        $query = $this->db->query("SELECT
        r.*,e.tallyforum
        FROM `razorpay` r
        LEFT JOIN
        member m
        ON
        m.old_id = r.nesidcorrect
        LEFT JOIN
        eduforum_master e
        ON
        (
        (e.eduforum = SUBSTRING(m.`forane`, POSITION('|' IN m.`forane`)+1))
        AND
        (e.forane=SUBSTRING_INDEX(m.`forane`, '|', 1))
        )
        WHERE r.`settled_date` BETWEEN '$dateFrom' AND '$dateTo'
        AND
        r.`nesidcorrect` IS NOT NULL
        ORDER BY r.`settled_date` ASC
        ");

        $arrayData = array();
        $arrayData[] = array('Gen ID','Entity ID', 'Settled Date', 'Date', 'Beneficiary Name', 'Nes ID', 'ID', 'Ledger Name', 'Forum Name', 'Education forum','Credit', 'Tally Edu Forum');

        foreach ($query->result_array() as $value) {
            $arrayData[] = array(
                            $value['id'],
                            $value['entity_id'],
                            $value['settled_date'],
                            $value['settled'],
                            $value['beneficiary_name'],
                            $value['beneficiary_id'],
                            $value['settled'],
                            $value['nesidcorrect'] . ' ' . $value['beneficiaryName'] . ' - '. $value['memeberName'],
                            $value['forum'],
                            $value['forumcurrect'].' '.'Forum',
                            $value['credit'],
                            $value['settled']
                            );
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()->fromArray($arrayData, null, 'A1');
        $writer = new Xlsx($spreadsheet);
        $writer->save(FCPATH.'export/Razor List.xlsx');
        $this->load->helper('url');
        // redirect(base_url().'export/Neft List.xlsx', 'location');

        $response = array(
        'error' => false,
        'msg'	=> base_url().'export/Razor List.xlsx'
    );
        echo json_encode($response);
    }
}
