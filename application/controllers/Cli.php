<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller {

	public function __construct(){
       parent::__construct();
       $this->load->library('session');
       $_SESSION['m_menu']='Mbeneficiary';
   }


	  public function exportcorp(){
		 $this->load->database();
		 $don = $this->db->get('corpus_fund');

		 foreach($don->result() as $donor){
			 echo $donor->don_picture."\n";
		  }


	}

    private function makedate($dt){
       $newdt = explode('/',$dt);
       return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
    }
}
