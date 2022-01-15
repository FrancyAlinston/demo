<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receipt extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='Mbatch';
    }

    public function index()
    {
        $_SESSION['s_menu'] ='BatchList';
        $this->load->view('manage_batch');
    }

    public function create()
    {
        $this->load->database();
        $this->db->order_by('course', 'asc');
        $data['courses'] = $this->db->get('course_master');
        $_SESSION['s_menu'] = 'CreateBatch';
        $this->load->view('create_batch', $data);
    }

    public function create_()
    {
        $this->load->database();

        print_r($_POST);

        $courseData=array('course_id' => $this->input->post('SelCourseId'),
            'year_span' => $this->input->post('selStartYear').'-'.$this->input->post('selEndYear'),
            'notes' => $this->input->post('txtCourseNotes')
        );


        if ($this->db->insert('batch_master', $courseData)) {
            $this->load->helper('url');
            redirect('/xhr/batchlist', 'location');
        }
    }
    public function update_()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->database();

        $courseData=array('year_span' => $this->input->post('year_span'),
            'notes' => $this->input->post('notes')
        );

        $this->db->where('id', $this->input->post('id'));

        if ($this->db->update('batch_master', $courseData)) {
            $this->load->helper('url');
            redirect('/xhr/batchlist', 'location');
        }
    }

    public function delete_()
    {
        $this->load->database();
        if ($this->db->delete('batch_master', array('id' => $this->input->post('id')))) {
            $this->load->helper('url');
            redirect('/xhr/batchlist', 'location');
        }
    }

    public function newapplication()
    {
        //$this->load->database();
        $_SESSION['m_menu']='Mnidhi';
        $_SESSION['s_menu'] = 'NewShareApplication';
        $this->load->view('new_share_receipt');
    }
    public function editapplication()
    {
        $this->load->database();
        $data['batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span, c.abbr from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $_SESSION['m_menu']='Madmission';
        $_SESSION['s_menu'] = 'EditApplication';

        if ($this->input->get('id', true) != '') {
            $data['id'] = $this->input->get('id', true);
        }
        $this->load->view('edit_application', $data);
    }

    public function saveapplication_()
    {
        $this->load->database();
        $ipplicationData = array(
                'nes_id' => $this->input->post('txtNesId'),
                'student_name' => $this->input->post('txtStudName'),
                'guardian' => $this->input->post('txtGuardian'),
                'gender' => $this->input->post('selGender'),
                'education_forum' => $this->input->post('txtEduFrm'),
                'phone' => $this->input->post('txtPhone'),
                'receipt' => $this->input->post('txtReceipt'),
                'shares' => $this->input->post('txtShares'),
                'entry_date' => date('Y-m-d')
            );
        if ($this->db->insert('shares_rec', $ipplicationData)) {
            echo $this->db->insert_id();
        } else {
            echo "error";
        }
    }

    public function updateapplication_()
    {
        $this->load->database();
        $ipplicationData = array(
                'nes_id' => $this->input->post('txtNesId'),
                'student_name' => $this->input->post('txtStudName'),
                'guardian' => $this->input->post('txtGuardian'),
                'gender' => $this->input->post('selGender'),
                'school' => $this->input->post('txtSchool'),
                'medium' => $this->input->post('txtMedium'),
                'syllabus' => $this->input->post('txtSyllabus'),
                'education_forum' => $this->input->post('txtEduFrm'),
                'bcc_number' => $this->input->post('txtBCCNum'),
                'bcc_name' => $this->input->post('txtBCCName'),
                'phone' => $this->input->post('txtPhone'),
                'phone_secondry' => $this->input->post('txtPhoneSec'),
                'receipt' => $this->input->post('txtReceipt')
            );
        $this->db->where('id', $this->input->post('txtAppId'));

        if ($this->db->update('application', $ipplicationData)) {
            echo $this->input->post('txtAppId');
        } else {
            echo "error";
        }
    }

    public function batchfilter()
    {
        $this->load->database();
        $data['batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $data['status'] = $this->db->query('select distinct status from application');
        //$data['edufrm'] = $this->db->query('select * from eduforum_master order by eduforum asc');
        $data['forane'] = $this->db->get('forane_master');
        $_SESSION['m_menu']='Madmission';
        $_SESSION['s_menu'] = 'CandidateListFilter';
        $this->load->view('batch_filter', $data);
    }

    public function forumwiseaggregate()
    {
        $this->load->database();
        $data['batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $data['status'] = $this->db->query('select distinct status from application');
        $_SESSION['m_menu']='Madmission';
        $_SESSION['s_menu'] = 'ForumwiseCombined';
        $this->load->view('application_combined', $data);
    }

    public function importexam()
    {
        $this->load->database();
        $_SESSION['m_menu']='Madmission';
        $_SESSION['s_menu'] = 'Exam';
        $data['batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('import_exam', $data);
    }

    public function importinterview()
    {
        $this->load->database();
        $_SESSION['m_menu']='Madmission';
        $_SESSION['s_menu'] = 'Interview';
        $data['batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('import_interview', $data);
    }

    public function promotetointerview()
    {
        $this->load->database();
        $forane_id = explode('|', $this->input->post('selForane'));
        $query = 'update application set status = "Eligible for Interview" where id in ('.
                 'select r.candidate_id from (select a.student_name, a.education_forum, a.phone, e.* from application a, exams e '.
                 'where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ='.$this->input->post('txtBatch').' and cast(e.total as int) > '.$this->input->post('txtCutOffMarks').') r '.
                 'where r.education_forum in (select eduforum from eduforum_master where forane='.$forane_id[0].'))';
        if ($this->db->query($query)) {
            echo $this->db->affected_rows()." Students Promoted";
        }
    }

    public function promotetostudent()
    {
        $this->load->database();
        //$this->output->enable_profiler(TRUE);

        $forane_id = explode('|', $this->input->post('selForane'));
        $query = 'update application set status = "Student" where id in ('.
                 'select r.candidate_id from (select a.student_name, a.education_forum, a.phone, e.* from application a, exams e '.
                 'where a.id = e.candidate_id and e.batch_id = a.batch and e.batch_id ='.$this->input->post('txtBatch').' and cast(e.grand_total as int) > '.$this->input->post('txtCutOffMarks').') r '.
                 'where r.education_forum in (select eduforum from eduforum_master where forane='.$forane_id[0].'))';
        if ($this->db->query($query)) {
            echo $this->db->affected_rows()." Students Promoted";
        }
    }

    public function intereviewmarks()
    {
        $this->load->database();
        $ids = explode(',', $this->input->post('ids'));
        $marks = array();
        foreach ($ids as $id) {
            if (abs($this->input->post('txtInt'.$id)) > 0) {
                $marks[] = array('candidate_id'=> $id,
                           'interview'   => $this->input->post('txtInt'.$id),
                           'grand_total' => $this->input->post('txtTot'.$id));
            }
        }

        //print_r($marks);

        if ($this->db->update_batch('exams', $marks, 'candidate_id')) {
            echo 'Marks Updated Successfully';
        } else {
            echo 'Update error..!! or Nothing new to update';
        }
    }

    public function students()
    {
        $this->load->database();
        $_SESSION['m_menu']='Madmission';
        $_SESSION['s_menu'] = 'Students';
        $data['batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('students', $data);
    }

    public function camp()
    {
        $this->load->database();
        $_SESSION['m_menu']='Madmission';
        $_SESSION['s_menu'] = 'Camp';
        $data['batches'] = $this->db->query('select b.id, c.course, b.course_id, b.year_span from batch_master b, course_master c where c.id = b.course_id order by b.year_span desc');
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('camp', $data);
    }
}
