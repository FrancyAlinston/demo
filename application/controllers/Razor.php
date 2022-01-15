<?php
    defined('BASEPATH') or exit('No direct script access allowed');

            use PhpOffice\PhpSpreadsheet\Calculation\Functions;
            use PhpOffice\PhpSpreadsheet\Spreadsheet;
            use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
            use PhpOffice\PhpSpreadsheet\Reader\Csv;

    class Razor extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('session');
            $_SESSION['m_menu']='MRazorpay';
        }


        // public Function razorpay(){
        //         $this->load->view('razorpay');
        //     }
        public function razorpay()
        {
            $_SESSION['s_menu'] ='Razorpayexport';
            $this->load->view('razorpay');
            $this->load->database();
            $razorpay = $this->db->query('SELECT id, beneficiary_id, beneficiary_name, member_name, forum, settled_date, credit, parish_name FROM razorpay');

            $arrayData = array();
            $arrayData[] = array('id','beneficiary_id','beneficiary_name','member_name');
            $total = 0;
        }

        public function importrazor()
        {
            $_SESSION['s_menu'] ='Razorpayimport';
            $this->load->view('import_razor');
        }

        public function readrazorimport()
        {
            $this->load->database();
            $this->load->helper('url');
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load("gen/".$this->input->post('txtexlRazorpay'));
            $reader->setReadDataOnly(true);
            //$reader->setSheetIndex(0);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            $cnt = 0;
            $rows[0]       = array_map('trim', $rows[0]);
            $rows[0]       = array_map('strtolower', $rows[0]);
            //	$rows          = array_slice($rows, 9);
            $batch_insert  = array();
            $error_entries = array();
            $cnt = 0;
            foreach ($rows as $fields) {
                echo $fields[4];
                $ben_data = json_decode($fields[14], true);
                print_r($ben_data);
                if ($cnt == 10000) {
                    exit();
                }
                $date = date_create_from_format("d-m-Y", $fields[11]);
                $date = date_format($date, "Y-m-d");
                $batch_insert = array(
                                'member_name' => $ben_data['name_of_the_member'],
                                'beneficiary_name' => $ben_data['name_of_the_student_beneficiary'],
                                'beneficiary_id' => $ben_data['beneficiary_id'],
                                'parish_name' => $ben_data['name_of_the_parish'],
                                'forum' => $ben_data['place_of_the_parish'],
                                'email' => $ben_data['email'],
                                'phone' => $ben_data['phone'],
                                'entity_id' => $fields[0],
                                'credit' => $fields[4],
                                'settled' => $fields[9],
                                'created_date' => $fields[10],
                                'settled_date' => $date,
                                'card_network' => $fields[21]
                                );
                if ($fields[9] !=0) {
                    if ($cnt !=1) {
                        $this->db->insert('razorpay', $batch_insert);
                        echo 'Success';
                    }
                }
                $cnt++;
            }
        }

        public function Editrazorpay($from='')
        {
            // $this->output->enable_profiler(true);
            $_SESSION['s_menu'] = "Editrazorpay";
            $from = $from ?: date('Y-m-d');
            $this->load->helper('date');
            $this->load->model('Razorpaymodal', 'razorpaym');
            $this->load->database();
            $data['razorpayDetails'] = $this->razorpaym->selectdata('*', $from);
            $this->load->view('editrazorpay', $data);
        }

        public function update()
        {
            $id = intval($this->input->post('id'));
            //$nesId = htmlspecialchars($this->input->post('nesId'));
            $beneficiaryId = htmlspecialchars($this->input->post('beneficiaryId'));
            //$memberName = htmlspecialchars($this->input->post('memberName'));
            $forumCurrect = htmlspecialchars($this->input->post('forumCurrect'));
            //$parishName = htmlspecialchars( $this->input->post('parishName') );
            //$forum = htmlspecialchars($this->input->post('forum'));
            $memeberName = htmlspecialchars($this->input->post('memeberName'));
            $beneficiaryName = htmlspecialchars($this->input->post('beneficiaryName'));
            //$date = htmlspecialchars($this->input->post('date'));
            //$date = date_create_from_format("d M Y", $date);
            //$date = date_format($date, "Y-m-d");
            $data = array(
                        //'beneficiary_id' => $nesId,
                        'nesidcorrect' => $beneficiaryId,
                        //'member_name' => $memberName,
                        'forumcurrect' => $forumCurrect,
                        //'parish_name' => $parishName,
                        //'forum' => $forum,
                        'memeberName' => $memeberName,
                        'beneficiaryName' => $beneficiaryName,
                        //'settled_date' => $date,
            );
            // $data = array(
            // 	'nes_id' => '$nesId',
            // 	'acnumber' => '$accNo',
            // 	'acname' => '$accName',
            // 	'ifsc' => '$ifsc',
            // 	'branchid' => '$branchCode',
            // 	'bank_name' => '$bankName',
            // 	'scheme_amt' => '$schemeAmt',
            // 	'nidhi_amt' => '$nidiAmt',
            // 	'date' => '',
            // );
            $this->load->database();
            $this->db->where('id', $id);
            $this->db->update('razorpay', $data);
            print_r($data);
            $response = array(
                'error' => false,
                'msg'	=> 'Success'
            );
            echo json_encode($response);
        }

        private function makedate($dt)
        {
            $newdt = explode('/', $dt);
            return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
        }

        public function getRazorDetailAjax()
        {
            $razorId = $this->input->post('razor_id');
            $this->load->model('Razorpaymodal', 'razorpaym');
            $this->load->database();
            $razorDetails = $this->razorpaym->find($razorId);
            $data = isset($razorDetails[0])
            ? array('error'=>'false','data'=>$razorDetails[0]) :
            array('error'=>'true','data'=>'');
            echo json_encode($data);
        }

        public function searchMembers()
        {
            // $oldId = '0';
            $oldId = $this->input->post('old_id');
            $column = $this->input->post('column');
            $this->load->model('Razorpaymodal', 'razorpaym');
            $this->load->database();
            $selects = 'id,old_id AS nes_id, NAME AS correct_name, education_forum, guardian_name';
            $memberDetails = $this->razorpaym->searchMembers($oldId, $column, $selects);
            // foreach ($memberDetails as $details) {
            // print_r($memberDetails);
            // }
            echo json_encode($memberDetails);


            // $data = isset($razorDetails[0])
    //         ? array('error'=>'false','data'=>$razorDetails[0]) :
    //         array('error'=>'true','data'=>'');
    // echo json_encode($data);
        }

        public function razorPayUpdate()
        {
            $id = intval($this->input->post('razorPayId')) ?: 1;
            $data = array(
        'nesidcorrect'      => $this->input->post('nesidcorrect') ?: '',
        'memeberName'       => $this->input->post('memeberName') ?: '',
        'beneficiaryName'   => $this->input->post('beneficiaryName') ?: '',
        'forumcurrect'      => $this->input->post('forumcurrect') ?: ''
    );
            $this->load->model('Razorpaymodal', 'razorpaym');
            $this->load->database();
            $this->db->where('id', $id);
            $this->db->update('razorpay', $data);
            echo json_encode(array('error'=>false,'message'=>'! Update sucessfully!'));
            exit();
        }
    }
