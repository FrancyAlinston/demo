<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beneficiary extends CI_Controller
{
    public function add()
    {
        $this->load->database();
        $data['forane'] = $this->db->get('forane_master');
        $this->load->view('add_beneficiary', $data);
    }

    public function add_()
    {
        $this->load->database();
    }

    public function singlephotoupload()
    {
        if ($_FILES['urlP']['error'] > 0) {
            echo "Return Code: " . $_FILES['urlP']['error']. "<br />";
        } else {
            $fileDir = "profilephotos/";
            $fileName = $this->input->post('stamp').'.'.pathinfo($_FILES['urlP']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['urlP']['tmp_name'], $fileDir.$fileName);
            echo $fileName;
        }
    }
}
