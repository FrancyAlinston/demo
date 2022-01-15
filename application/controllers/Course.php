<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

    public function __construct(){
         parent::__construct();
         $this->load->library('session');
         $_SESSION['m_menu']='Mcourses';
    }

	public function index()
	{
		$_SESSION['s_menu'] ='CourseList';
		$this->load->view('manage_course');
	}

	public function create()
	{
		$_SESSION['s_menu'] ='CreateCourse';
		$this->load->view('create_course');
	}

	public function create_(){
		$this->load->database();

		$courseData=array('course' => $this->input->post('txtCourseName'),
			'abbr' => $this->input->post('txtCourseAbbr'),
			'notes' => $this->input->post('txtCourseNotes')
		);
		 if($this->db->insert('course_master', $courseData)){
		 	$this->load->helper('url');
		 	redirect('/xhr/courselist', 'location');
		 }
	}
	public function update_(){
		//$this->output->enable_profiler(TRUE);
		$this->load->database();

		$courseData=array('course' => $this->input->post('course'),
			'abbr' => $this->input->post('abbr'),
			'notes' => $this->input->post('notes')
		);

		$this->db->where('id', $this->input->post('id'));

		if($this->db->update('course_master', $courseData)){
		 	$this->load->helper('url');
		 	redirect('/xhr/courselist', 'location');
		}
	}


}
