<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scholarship extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='Mbatch';
    }


    public function newapplication()
    {
        $this->load->database();
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'NewScholarship';
        $data['forums'] = $this->db->query('select eduforum from eduforum_master order by eduforum')->result();
        $this->db->order_by('course');
        $data['courses'] = $this->db->get('scholarship_courses')->result();
        $this->load->view('new_scholarship_application', $data);
    }

    public function saveapplication_()
    {
        $this->load->database();

        $applicationData = array(
            'nes_id'  => $this->input->post('txtNesId'),
            'app_num'  => $this->input->post('txtAppNum'),
            'name'  => $this->input->post('txtStudName'),
            'gauardain'  => $this->input->post('txtGuardian'),
            'phone'  => $this->input->post('txtPhone'),
            'edu_forum'  => $this->input->post('txtEduFrm'),
            'bcc_number'  => $this->input->post('txtBCCNum'),
            'bcc_name'  => $this->input->post('txtBCCName'),
            'phone_sec'  => $this->input->post('txtPhoneSec'),
            'status'  => $this->input->post('selStatus'),
            'course_text' =>  $this->input->post('course'),
            'specialisation' =>  $this->input->post('txtSpcialisation'),
            'gender' => $this->input->post('selGender'),
            'payee' => $this->input->post('txtPayee'),
            // 'institution' => $this->input->post('institution'),
            // 'bankname' => $this->input->post('bankname'),
            // 'acname' => $this->input->post('acname'),
            // 'ifsc' => $this->input->post('ifsc'),
            // 'bcode' => $this->input->post('bcode'),
            'a1'  => $this->input->post('txtA1'),
            'a2'  => $this->input->post('txtA'),
            'b1'  => $this->input->post('txtB1'),
            'b2'  => $this->input->post('txtB'),
            'c1'  => $this->input->post('txtC1'),
            'c2'  => $this->input->post('txtC'),
            'd1'  => $this->input->post('txtD1'),
            'd2'  => $this->input->post('txtD'),
            'plustwo_total' => $this->input->post('txt12total'),
            'course_certificate'  => $this->input->post('chkCourseCertificate'),
            'plus_two'  => $this->input->post('chkplus2'),
            'mark_list'  => $this->input->post('chkMrklist'),
            'course'  => $this->input->post('selCourse'),
            'performance'  => $this->input->post('selPerfomance'),
            'nav_regularity'  => $this->input->post('selRegular'),
            'special_points' => $this->input->post('txtSpcialPoints'),
            'membership_period'  => $this->input->post('selMembershipPeriod'),
            'points'  => $this->input->post('totalPoints'),
            'entry_date' => date('Y-m-d H:i:s')
        );


        if ($this->db->insert('scholarship', $applicationData)) {
            $genID = 'SCOL/'.$this->db->insert_id().'/'.date("Y");
            $this->db->where('id', $this->db->insert_id());
            if ($this->db->update('scholarship', array('generated_id' => $genID))) {
                echo $genID;
            }
        } else {
            echo "error";
        }
    }

    public function updateapplication_()
    {
        $this->output->enable_profiler(true);
        $this->load->database();

        $applicationData = array(
            'nes_id'  => $this->input->post('txtNesId'),
            'name'  => $this->input->post('txtStudName'),
            'gauardain'  => $this->input->post('txtGuardian'),
            'phone'  => $this->input->post('txtPhone'),
            'app_num'  => $this->input->post('txtAppNum'),
            'edu_forum'  => $this->input->post('txtEduFrm'),
            'bcc_number'  => $this->input->post('txtBCCNum'),
            'bcc_name'  => $this->input->post('txtBCCName'),
            'email' => $this->input->post('txtemail'),
            'phone_sec'  => $this->input->post('txtPhoneSec'),
            'status'  => $this->input->post('selStatus'),
            'course_text' =>  $this->input->post('course'),
            'study_year' => $this->input->post('txtyearofstudy'),
            'specialisation' =>  $this->input->post('txtSpcialisation'),
            'gender' => $this->input->post('selGender'),
            'payee' => $this->input->post('txtPayee'),
            'institution' => $this->input->post('institution'),
            'bankname' => $this->input->post('bankname'),
            'acname' => $this->input->post('acname'),
            'ifsc' => $this->input->post('ifsc'),
            'bcode' => $this->input->post('bcode'),
            'a1'  => $this->input->post('txtA1'),
            'a2'  => $this->input->post('txtA'),
            'b1'  => $this->input->post('txtB1'),
            'b2'  => $this->input->post('txtB'),
            'c1'  => $this->input->post('txtC1'),
            'c2'  => $this->input->post('txtC'),
            'd1'  => $this->input->post('txtD1'),
            'd2'  => $this->input->post('txtD'),
            'plustwo_total' => $this->input->post('txt12total'),
            'course_certificate'  => $this->input->post('chkCourseCertificate'),
            'plus_two'  => $this->input->post('chkplus2'),
            'mark_list'  => $this->input->post('chkMrklist'),
            'course'  => $this->input->post('selCourse'),
            'performance'  => $this->input->post('selPerfomance'),
            'nav_regularity'  => $this->input->post('selRegular'),
            'special_points' => $this->input->post('txtSpcialPoints'),
            'membership_period'  => $this->input->post('selMembershipPeriod'),
            'points'  => $this->input->post('totalPoints'),
            'entry_date' => date('Y-m-d H:i:s')

        );


        $this->db->where(array('nes_id' => $this->input->post('txtNesId'),'year(entry_date)' => date("Y")));

        if ($this->db->update('scholarship', $applicationData)) {
            echo "Scholarship Application Updated Succssfully";
        }
    }


    public function editscholarship()
    {
        $this->output->enable_profiler(true);
        $this->load->database();
        $this->load->helper('url');
        $last = $this->uri->total_segments();
        $id = $this->uri->segment($last);
        $data['candidate'] = $this->db->get_where('scholarship', array('nes_id' => $id,'year(entry_date)' => date("Y")))->row();
        $data['forums'] = $this->db->query('select eduforum from eduforum_master order by eduforum')->result();
        $data['courses'] = $this->db->get('scholarship_courses')->result();
        $this->load->view('edit_scholarship_application', $data);
    }

    public function calcualtescholarship()
    {
        $this->load->database();
        $data['points'] = $this->db->query('select sum(points) points from scholarship where year(entry_date) = year(curdate())')->row()->points;
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'CaclulateScholarship';
        $this->load->view('calculatescholarship', $data);
    }

    public function porcessscholarship()
    {
        $this->load->database();
        $this->db->query('delete from scholership_allocation where allotted_year = '.date('Y'));
        $allotment = array(
            'allotted_amount' => $this->input->post('txtScholarshipAmount'),
            'total_points' => $this->input->post('txtPoints'),
            'cost_per_point' => $this->input->post('txtcostPerPoints'),
            'allotted_year' => date('Y')
        );
        if ($this->db->insert('scholership_allocation', $allotment)) {
            if ($this->db->query('update scholarship set amount_recived = truncate((points * '.$this->input->post('txtcostPerPoints').'),-1) where year(entry_date) = year(curdate())'));
            $data['scholarship'] = $this->db->query('select * from scholarship where year(entry_date) = year(curdate())')->result();
            $data['show'] = 'scholarship_update';
            $this->load->view('_xhr', $data);
        } else {
            echo "Error Please Try Again";
        }
    }

    public function scholarshipfilter()
    {
        $this->load->database();
        $data['year'] = $this->db->query('select distinct year(entry_date) year from scholarship');
        $data['courses'] = $this->db->query('select distinct course_text course from scholarship order by course_text asc');
        //$data['edufrm'] = $this->db->query('select * from eduforum_master order by eduforum asc');
        $data['forane'] = $this->db->get('forane_master');
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'ScholarshipFilter';
        $this->load->view('scholarship_filter', $data);
    }

    public function scholarshipfiltercoursewise()
    {
        $this->load->database();
        $data['year'] = $this->db->query('select distinct year(entry_date) year from scholarship');
        $data['courses'] = $this->db->query('select distinct course_text course from scholarship order by course_text asc');
        //$data['edufrm'] = $this->db->query('select * from eduforum_master order by eduforum asc');
        $data['forane'] = $this->db->get('forane_master');
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'CaclulateScholarshipCourseWise';
        $this->load->view('scholarship_filter_coursewise', $data);
    }

    public function scholarshipfilterforumwise()
    {
        $this->load->database();
        $data['year'] = $this->db->query('select distinct year(entry_date) year from scholarship');
        $data['courses'] = $this->db->query('select distinct course_text course from scholarship order by course_text asc');
        //$data['edufrm'] = $this->db->query('select * from eduforum_master order by eduforum asc');
        $data['forane'] = $this->db->get('forane_master');
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'CaclulateScholarshipCourseWise';
        $this->load->view('scholarship_filter_forumwise', $data);
    }


    public function scholarshipcover()
    {
        $this->load->database();
        $data['year'] = $this->db->query('select distinct year(entry_date) year from scholarship');
        $data['courses'] = $this->db->query('select distinct course_text course from scholarship order by course_text asc');
        //$data['edufrm'] = $this->db->query('select * from eduforum_master order by eduforum asc');
        $data['forane'] = $this->db->get('forane_master');
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'ScholarshipFilter';
        $this->load->view('scholarship_filter_cover', $data);
    }

    public function scholarshipcoverprint()
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

        $data['scholarship'] = $this->db->query($this->db->get_compiled_select('scholarship').$appendQuery.' order by edu_forum asc, name asc');
        $this->load->view('scholarshipcover', $data);
    }

    public function eligibility()
    {
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'CheckEligibility';
        $this->load->view('scholarship_eligiblity');
    }

    public function eligibilitycalc()
    {
        $this->load->database();
        //$data['payments'] = $this->db->get_where('ben_yearly_transaction',array('old_id' => $this->input->post('old_id') ))->result();
        $data['payments'] = $this->db->get_where('daybook', array('old_id' => $this->input->post('old_id') ))->result();
        $data['show'] = 'scholarship_applicant';
        $this->load->view('_xhr', $data);
    }

    public function update_special()
    {
        $this->load->database();
        $this->db->where(array('id' => $this->input->post('id'),'year(entry_date)' => date("Y")));
        $data = array('special_points' => $this->input->post('splpt'));
        if ($this->db->update('scholarship', $data)) {
            //echo "updated";
            $this->db->query('update scholarship set points = special_points+points where id = '.$this->input->post('id'));
            $rs = $this->db->query('select points from scholarship where id = '.$this->input->post('id'))->row();
            echo $rs->points;
        } else {
            echo "error";
        }
    }

    public function update_amt()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $this->db->where(array('id' => $this->input->post('id')));
        $data = array('amount_recived' => $this->input->post('amt'));
        if ($this->db->update('scholarship', $data)) {
            $rs = $this->db->query('select amount_recived from scholarship where id = '.$this->input->post('id'))->row();
            echo $rs->amount_recived;
        } else {
            echo "error";
        }
    }


    public function managecourses()
    {
        $this->load->database();
        $data['courses'] = $this->db->get('scholarship_courses')->result();
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'ManageCourses';
        $this->load->view('manage_course_scholarship', $data);
    }

    public function update_course()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();

        $courseData=array('course' => $this->input->post('course'),
            'points' => $this->input->post('abbr')
        );

        $this->db->where('id', $this->input->post('id'));

        if ($this->db->update('scholarship_courses', $courseData)) {
            $this->load->helper('url');
            redirect('/xhr/courselistscholar', 'location');
        }
    }

    public function addnewcourse()
    {
        $this->load->database();

        $courseData=array(
            'course' => $this->input->post('newCourse'),
            'points' => $this->input->post('newPoint')
        );

        if ($this->db->insert('scholarship_courses', $courseData)) {
            echo "success";
        }
    }

    public function yearlyamt()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();
        $this->load->library('table');
        $template = array(
        'table_open'  => '<table style="width:40%;text-align:center; margin-left:20px" class="table table-primary table-striped table-bordered pull-left">'
    );
        // $this->output->enable_profiler(TRUE);
        $this->table->set_template($template);
        //$query = $this->db->query('select sum(amount) "Total Amount" ,count(amount) Transactions  from ben_yearly_transaction where old_id =  "'.$this->input->post('oldID').'" group by old_id');
        //$query = $this->db->query('select sum(amount) "Total Amount" ,count(amount) Transactions  from daybook where old_id =  "'.$this->input->post('oldID').'" group by old_id');
        $query = $this->db->query("select sum(amount) 'Total Amount' ,count(amount) Transactions from daybook where old_id =  '".$this->input->post('oldID')."' and voucher_type = 'Receipt' and date > concat(year(curdate())-1,'-03-31') and date < concat(year(curdate()),'-04-01') group by old_id");
        $amtPaid = $this->db->query('select SUBSTRING_INDEX(generated_id, "/", -1) Year, amount_recived "Scolarship Recived" from scholarship where nes_id ="'.$this->input->post('oldID').'" and amount_recived !=""');
        echo $this->table->generate($query);
        echo $this->table->generate($amtPaid);
    }

    public function delete_course()
    {
        $this->load->database();
        if ($this->db->delete('scholarship_courses', array('id' => $this->input->post('id')))) {
            $this->load->helper('url');
            redirect('/xhr/courselistscholar', 'location');
        }
    }

    public function deleteapplication()
    {
        $this->load->database();
        $this->db->query('insert into scholarship_deleted select * from scholarship where generated_id = "'.$this->input->post('genID').'"');
        if ($this->db->delete('scholarship', array('generated_id' => $this->input->post('genID')))) {
            echo 'deleted';
        }
    }

    public function scholarshiplivereview()
    {
        $_SESSION['m_menu']='MScholarship';
        $_SESSION['s_menu'] = 'ScholarshipForumWise';
        $live_db = $this->load->database('live', true);
        $sql=$data['scholarship'] = $live_db->query('select *,CASE WHEN coursecert_file=" " AND marklist_file=" " THEN "btn-danger" WHEN coursecert_file="1"   OR  marklist_file=" " THEN "btn-warning"  ELSE "btn-success"  END AS btnColor  from scholarship_live where year(entry_date) = year(curdate())')->result();


        $this->load->view('scholarship_live_review', $data);
    }

    public function loadscholarshipforreview()
    {
        $live_db = $this->load->database('live', true);
        $data['scholarship'] = $live_db->query('select * from scholarship_live where id = '.$this->input->post('id'))->row();
        $this->load->view('_load_scholarship_for_review', $data);
    }

    public function approvescholarship()
    {
        //$this->output->enable_profiler(TRUE);
        $live_db = $this->load->database('live', true);
        $this->load->database();
        $approved = $live_db->query('select * from scholarship_live where id = '.$this->input->post('id'))->result_array();
        if ($this->db->insert('scholarship', $approved[0])) {
            if ($live_db->insert('scholarship', $approved[0])) {
                echo "Approved";
                $live_db->query('delete from scholarship_live where id = '.$this->input->post('id'));
            }
        }
    }
}
