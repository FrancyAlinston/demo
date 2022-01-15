<?php
        defined('BASEPATH') or exit('No direct script access allowed');

        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        use PhpOffice\PhpSpreadsheet\Reader\Csv;

        class Tools extends CI_Controller
        {
            public function __construct()
            {
                parent::__construct();
                $this->load->library('session');
                $_SESSION['m_menu']='Mbeneficiary';
            }

            public function singlephotoupload()
            {
                $_file = reset($_FILES);
                if ($_file['error'] > 0) {
                    echo "Return Code: " . $_file['error']. "<br />";
                } else {
                    $fileDir = $this->input->post('dir')."/";
                    $fileName = $this->input->post('stamp').'.'.pathinfo($_file['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_file['tmp_name'], $fileDir.$fileName);
                    echo $fileName;
                }
            }

            public function singlefileupload()
            {
                $_file = reset($_FILES);
                if ($_file['error'] > 0) {
                    echo "Return Code: " . $_file['error']. "<br />";
                } else {
                    $fileDir = $this->input->post('dir')."/";
                    $fileName = $this->input->post('stamp').'.'.pathinfo($_file['name'], PATHINFO_EXTENSION);
                    if (move_uploaded_file($_file['tmp_name'], $fileDir.$fileName)) {
                        echo $fileName;
                    } else {
                        echo "false";
                    }
                }
            }

            public function prefixupload()
            {
                $_file = reset($_FILES);
                if ($_file['error'] > 0) {
                    echo "Return Code: " . $_file['error']. "<br />";
                } else {
                    $fileDir = "exam/";
                    $fileName = time().'.'.pathinfo($_file['name'], PATHINFO_EXTENSION);
                    if (move_uploaded_file($_file['tmp_name'], $fileDir.$fileName)) {
                        echo $fileName;
                    } else {
                        echo "false";
                    }
                }
            }

            public function readexamimport()
            {
                //print_r($_POST);
                //$this->output->enable_profiler(TRUE);
                $this->load->database();
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                $spreadsheet = $reader->load("exam/".$this->input->post('txtexammarks'));
                $reader->setSheetIndex(0);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                $cnt = 0;
                $rows[0] = array_map('trim', $rows[0]);
                $rows[0] = array_map('strtolower', $rows[0]);
                //print_r($rows[0]);

                $subArray = array();
                foreach ($rows[0] as $val) {
                    if ($val == 'candidate id') {
                        $cid = $cnt;
                    }

                    if (substr($val, 0, 4) == 'sub-') {
                        $subArray[$val] = $cnt;
                    }
                    if ($val == 'total') {
                        $total = $cnt;
                    }
                    if ($val == 'test rank') {
                        $rank = $cnt;
                    }
                    if ($val == 'percentage') {
                        $percentage = $cnt;
                    }

                    $cnt++;
                } // end of header identification

                $tcount = count($rows)-1;
                $counter = 1;
                $icount = 0;
                $dcount = 0;
                $ecount = 0;
                $errorLog = array();
                foreach (array_slice($rows, 1) as $fields) {
                    $counter++;
                    if (is_null($fields[$cid])) {
                        $ecount++;
                        $errorLog[] = 'Row No :'.$counter.' ['.implode(' | ', $fields).']';
                        continue;
                    }

                    $query = $this->db->get_where('exams', array('candidate_id' => $fields[$cid],'batch_id' => $this->input->post('txtBatch')));
                    if ($query->num_rows() > 0) {
                        $dcount++;
                        //$errorLog[] = 'Row No :'.$counter.' ['.implode(' | ', $fields).']';
                        continue;
                    }

                    $query = $this->db->get_where('application', array('id' => $fields[$cid]));
                    if ($query->num_rows() == 0) {
                        $ecount++;
                        $errorLog[] = 'Row No :'.$counter.' ['.implode(' | ', $fields).']';
                        continue;
                    }

                    $exam = array(
                        'candidate_id' => $fields[$cid],
                        'total' => $fields[$total],
                        'rank' => $fields[$rank],
                        'percentage' => $fields[$percentage],
                        'batch_id' => $this->input->post('txtBatch')
                    );

                    $marks = array();
                    foreach ($subArray as $key => $value) {
                        $marks[$key] = $fields[$value];
                    }

                    $exam['marks'] = json_encode($marks);

                    if ($this->db->insert('exams', $exam)) {
                        $icount++;
                    } else {
                        $ecount++;
                    }
                } // end of insert loop

                echo "Upload Complete<br><table style='width:30%;font-weight:bold' class='table table-bordered table-hover dataTable table-condensed'>".
                "<tr><td>Totel Rows</td><td style='text-align:right'>$tcount<tr>".
                "<tr><td>Error Entry</td><td style='text-align:right'>$ecount<tr>".
                "<tr><td>Duplicate Entry</td><td style='text-align:right'>$dcount<tr>".
                "<tr><td>Successful Entry</td><td style='text-align:right'>$icount<tr>".
                "</table>";

                if ($ecount > 0) {
                    echo "<b>Error Log:</b><br>";
                    echo implode('<br>', $errorLog);
                }
            }

            public function readprefiximport()
            {
                $this->load->database();
                $this->load->helper('url');
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                $spreadsheet = $reader->load("exam/".$this->input->post('txtprefix'));
                $reader->setSheetIndex(0);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                $cnt = 0;
                $rows[0] = array_map('trim', $rows[0]);
                $rows[0] = array_map('strtolower', $rows[0]);
                $fnameFixed = 'exam/fixed'.time().'.csv';
                $fs = fopen($fnameFixed, 'w');

                fwrite($fs, implode(",", $rows[0]).PHP_EOL);
                foreach (array_slice($rows, 1) as $fields) {
                    //echo implode(",", $fields).'<br>';

                    //echo $fields[0].' | '.substr($this->input->post('txtPrefix'), 0, (-1 * strlen($fields[0]))).$fields[0].'|'.strlen(substr($this->input->post('txtPrefix'), 0, (-1 * strlen($fields[0]))).$fields[0]).'<br>';
                    $fields[0] =substr($this->input->post('txtPrefix'), 0, (-1 * strlen($fields[0]))).$fields[0];
                    fwrite($fs, implode(",", $fields).PHP_EOL);
                }

                echo '<a href="'.base_url().$fnameFixed.'">Download Fixed File</a>';
            }


            public function readxmlimport()
            {
                $this->load->database();
                $xml_string = implode('', file('xml/'.$this->input->post('txtxmlImportAcClose')));
                $xml = simplexml_load_string($xml_string);
                $json = json_encode($xml);
                $txns = json_decode($json, true);
                $nes_ids = array();
                $nes_ids[] = '"xxxxxxxxxxxWWWWW"';

                foreach ($txns['BODY']['IMPORTDATA']['REQUESTDATA']['TALLYMESSAGE'] as $ben) {
                    if (isset($ben['VOUCHER'])) {
                        if (strpos(strtolower($ben['VOUCHER']['NARRATION']), 'closed') !== false) {
                            echo  $ben['VOUCHER']['NARRATION'].' | '.$ben['VOUCHER']['ALLLEDGERENTRIES.LIST'][0]['LEDGERNAME'].'<br>';


                            $tran = explode('-', $ben['VOUCHER']['ALLLEDGERENTRIES.LIST'][0]['LEDGERNAME']);
                            $date = $ben['VOUCHER']['DATE'];
                            $data = array( 'nes_id' => 'N'.trim(strtoupper($tran[0])),
                            'name' => $tran[1].' | '.$tran[2],
                            'reason' => $ben['VOUCHER']['NARRATION'],
                            'date' => substr($date, 0, 4).'-'.substr($date, 4, 2).'-'.substr($date, 6, 2),
                            'payout' => $ben['VOUCHER']['ALLLEDGERENTRIES.LIST'][0]['AMOUNT']
                        );
                            $this->db->insert('closed_accounts', $data);
                            $nes_ids[] = '"'.$data['nes_id'].'"';
                        }
                    }
                }

                if ($this->db->query('update member set status = "closed", is_nidhi = 0, share_count = 0,share_id = "0" where old_id in ('.implode(',', $nes_ids).')')) {
                    echo '<h3 style="color:green">Upload Success, '.$this->db->affected_rows().' Accounts Closed</h3>';
                    $this->db->query('delete from nidhi_share_pool where holder_id in (select id from member where old_id in ('.implode(',', $nes_ids).'))');
                }
            }

            public function readxmlcorpusimport()
            {
                $this->load->database();
                $xml_string = implode('', file('xml/corpusfund.xml'));
                $xml = simplexml_load_string($xml_string);
                $json = json_encode($xml);
                $txns = json_decode($json, true);
                foreach ($txns['BODY']['IMPORTDATA']['REQUESTDATA']['TALLYMESSAGE'] as $corp) {
                    if (isset($corp['VOUCHER'])) {
                        echo  $corp['VOUCHER']['NARRATION'].' | '.$corp['VOUCHER']['ALLLEDGERENTRIES.LIST'][0]['LEDGERNAME'].'<br>';

                        $date = $corp['VOUCHER']['DATE'];

                        $data = array('party_ledger_name' => $corp['VOUCHER']['PARTYLEDGERNAME'],
                    'voucher_type' => $corp['VOUCHER']['VOUCHERTYPENAME'],
                    'voucher_number' => $corp['VOUCHER']['VOUCHERNUMBER'],
                    'transaction_date' => substr($date, 0, 4).'-'.substr($date, 4, 2).'-'.substr($date, 6, 2),
                    'narration' => $corp['VOUCHER']['NARRATION'],
                    'ledger_name' => $corp['VOUCHER']['ALLLEDGERENTRIES.LIST'][0]['LEDGERNAME'],
                    'amount' => $corp['VOUCHER']['ALLLEDGERENTRIES.LIST'][0]['AMOUNT'],
                    'entered_by' => $corp['VOUCHER']['ENTEREDBY'],
                    'grade' => $corp['VOUCHER']['ALLLEDGERENTRIES.LIST'][0]['CATEGORYALLOCATIONS.LIST']['COSTCENTREALLOCATIONS.LIST']['NAME']
                );

                        $this->db->insert('corpus_transactions', $data);
                    }
                }
            }

            public function sharecal()
            {
                $this->load->database();
                //$this->output->enable_profiler(TRUE);
                $temp = $this->input->post('shareID');
                $tshare = explode(',', $temp);
                $shares = array();

                if (!isset($_POST['userID'])) {
                    $_POST['userID'] = 0000;
                }

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

                $shares = array_flip(array_flip($shares));//a faster approach to unique array


                $query = $this->db->query('select group_concat(share_id) locked_ids from nidhi_share_pool where share_id in ('.implode(',', $shares).') and status ="issued"');

                $locked_shares = $query->row();

                if (!is_null($locked_shares->locked_ids)) {
                    echo $locked_shares->locked_ids.' Already Issued';
                } else {
                    echo count($shares);
                }
            }
            public function upload()
            {
                $this->load->view('generic_upload');
            }

            public function getmissingshares()
            {
                $this->load->database();
                $query = $this->db->query('(select 1 as gap_starts_at,(select min(t4.share_id) -1 from nidhi_share_pool t4 where t4.share_id > 1) as gap_ends_at from nidhi_share_pool t5 where not exists (select t6.share_id from nidhi_share_pool t6 where t6.share_id = 1) having gap_ends_at is not null limit 1) union (select (t1.share_id + 1) as gap_starts_at, (select min(t3.share_id) -1 from nidhi_share_pool t3 where t3.share_id > t1.share_id) as gap_ends_at from nidhi_share_pool t1 where not exists (select t2.share_id from nidhi_share_pool t2 where t2.share_id = t1.share_id + 1) having gap_ends_at is not null)');
                $missing = $query->result();
                echo '<h4>Orphan Shares for re-issuing</h4><table class="table table-bordered table-striped table-condensed table-hover" role="grid" style="float:left;width:35%"><tr><th align="center">From</th><th align="center" >To</th><th align="center" >Action</th><tr>';
                foreach ($missing as $key) {
                    echo '<tr><td align="center">',$key->gap_starts_at.'</td><td align="center">'.$key->gap_ends_at.'</td><td align="center"><span class="btn btn-xs btn-primary" onclick="useShare('."'".$key->gap_starts_at.'-'.$key->gap_ends_at."'".')">use this</span></td></tr>';
                }
                echo '</table><style>table { border-collapse: collapse; width:40% } td{ border:1px solid} th{text-align:center}</style>';

                echo '<table class="table table-bordered table-striped table-condensed table-hover" role="grid" style="float:left;width:60%;margin-left:40px"><tr><th align="center">Certificate ID</th><th align="center" >Old Share Range</th><th align="center" >Closed Date </th><th align="center" >Action</th><tr>';
                $history = $this->db->query('select cert_id,share_id,close_date from share_history where cert_id not in (select id from share_certificates)')->result();
                foreach ($history as $certs) {
                    echo '<tr><td align="center">'.$certs->cert_id.'</td><td align="center">'.$certs->share_id.'</td><td align="center">'.$certs->close_date.'</td><td align="center"><span class="btn btn-xs btn-primary" onclick="useCert('."'".$certs->cert_id."','".$certs->share_id."'".')">use this</span></td></tr>';
                }
            }


            // public function readbendepositimport(){
            // 	$this->load->database();
            //   $this->db->truncate('daybook');
            // 	echo "Nidhi Transaction database cleared";
            // }

            public function readbendepositimport()
            {
                $this->load->database();
                $this->load->helper('url');
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load("gen/".$this->input->post('txtexlBenDeposit'));
                $reader->setReadDataOnly(true);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                $cnt = 0;
                $rows = array_slice($rows, 4);
                $batch_insert = array();
                $error_entries = array();
                foreach ($rows as $fields) {
                    if ($fields[0] != '') {
                        // Extract beneficiary details Logic
                        $ben = explode(' ', $fields[2]);
                        $old_id = explode('-', strtoupper(array_shift($ben)))[0];
                        if (isset($ben[1]) && $old_id{0} == 'N') {
                            $ben = explode('-', implode(' ', $ben));
                            $insertData = array(
                            'forum' => $fields[0],
                            'old_id' => $old_id,
                            'beneficary' => isset($ben[0]) ? trim($ben[0]):'',
                            'guardian' => isset($ben[1]) ? trim($ben[1]):'',
                            'voucher_type' => $fields[3],
                            'date' => $this->makedate($fields[1]),
                            'amount' => $fields[5],
                            'voucher_no' => $fields[4],
                            'narration' => $fields[6]
                        );
                            $batch_insert[] = $insertData;
                        } else {
                            $error_entries[] = array_map('trim', $fields);
                        }
                    }
                }

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet()->fromArray($error_entries, null, 'A1');
                $writer = new Xlsx($spreadsheet);
                $writer->save(FCPATH.'export/ErrorEntry.xlsx');
                $this->load->helper('url');

                $insertStatus = $this->db->insert_batch('daybook', $batch_insert);
                echo '<div style="color:#0EA106;font-weight:bold;"> Successful Entries : '.count($batch_insert).'</div>';
                echo '<br><div style="color:#FF0000"><div style="border-bottom:1px solid #000;font-weight:bold">Error Entries :'.
            '<a href="'.base_url().'export/ErrorEntry.xlsx" style="float:right">Export Error Entries</a></div>';
                $this->array_to_table($error_entries);
            }

            public function readbentrialbalanceimport()
            {
                $this->load->database();
                $this->load->helper('url');
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load("gen/".$this->input->post('txtexlBenTrial'));
                $reader->setReadDataOnly(true);
                //$reader->setSheetIndex(0);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                $cnt = 0;
                $rows[0]       = array_map('trim', $rows[0]);
                $rows[0]       = array_map('strtolower', $rows[0]);
                $rows          = array_slice($rows, 9);
                $batch_insert  = array();
                $error_entries = array();
                foreach ($rows as $fields) {
                    if ($fields[1] == '') {
                        $entry = explode('-', $fields[0]);
                        if (count($entry) < 3) {
                            $entry = explode(' ', $fields[0]);
                            $old_id = array_shift($entry);
                            $entry = implode(' ', $entry);
                            $entry = explode('-', $entry);
                            if (count($entry) > 1) {
                                $insertData = array(
                                'old_id' => 'N'.strtoupper($old_id),
                                'beneficary' => $entry[1],
                                'guardian' => $entry[0],
                                'balance' => $fields[2]
                            );
                            } else {
                                $error_entries[] = implode(' ', $fields);
                            }
                        } else {
                            $insertData = array(
                            'old_id' => 'N'.strtoupper($entry[0]),
                            'beneficary' => $entry[2],
                            'guardian' => $entry[1],
                            'balance' => $fields[2]
                        );
                        }

                        $batch_insert[] = $insertData;
                    }
                }
                $insertStatus = $this->db->insert_batch('ben_yearly_trialbalance', $batch_insert);
                echo '<div style="color:#0EA106"> Successful Entries : '.count($batch_insert).'</div>';
                if (count($error_entries) > 1) {
                    echo '<div style="color:#FF0000"><strong> Error Entries : '.count($error_entries).'</strong><br>';
                    echo implode('<br>', $error_entries);
                    echo '</div>';
                }
                $delete = $this->db->query('delete t1 from ben_yearly_trialbalance t1 inner join ben_yearly_trialbalance t2 where t1.id > t2.id and t1.old_id = t2.old_id');
                if ($this->db->affected_rows() > 0) {
                    echo '<br><div style="color:#FF0000"><strong> Duplicate Entries : '.$this->db->affected_rows().'</strong><br>';
                }
            }

            public function readbendepositschemeimport()
            {
                $this->load->database();
                $this->load->helper('url');
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load("gen/".$this->input->post('txtexlBenDepositScheme'));
                $reader->setReadDataOnly(true);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                $cnt = 0;
                $rows = array_slice($rows, 4);
                $batch_insert = array();
                $error_entries = array();
                foreach ($rows as $fields) {
                    if ($fields[0] != '') {
                        // Extract beneficiary details Logic
                        $ben = explode('-', $fields[2]);
                        if (isset($ben[1])) {
                            $old_id = explode('-', strtoupper(array_shift($ben)))[0];

                            $insertData = array(
                            'forum' => $fields[0],
                            'old_id' => 'N'.str_pad($old_id, 10, "0", STR_PAD_LEFT),
                            'beneficary' => isset($ben[0]) ? trim($ben[0]):'',
                            'guardian' => isset($ben[1]) ? trim($ben[1]):'',
                            'voucher_type' => $fields[3],
                            'date' => $this->makedate($fields[1]),
                            'amount' => $fields[5],
                            'voucher_no' => $fields[4],
                            'narration' => $fields[6]
                        );
                            $batch_insert[] = $insertData;
                        } else {
                            $error_entries[] = array_map('trim', $fields);
                        }
                    }
                }

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet()->fromArray($error_entries, null, 'A1');
                $writer = new Xlsx($spreadsheet);
                $writer->save(FCPATH.'export/ErrorEntry.xlsx');
                $this->load->helper('url');

                $insertStatus = $this->db->insert_batch('daybook_remaining', $batch_insert);
                echo '<div style="color:#0EA106;font-weight:bold;"> Successful Entries : '.count($batch_insert).'</div>';
                echo '<br><div style="color:#FF0000"><div style="border-bottom:1px solid #000;font-weight:bold">Error Entries :'.
            '<a href="'.base_url().'export/ErrorEntry.xlsx" style="float:right">Export Error Entries</a></div>';
                $this->array_to_table($error_entries);
            }

            public function printlog()
            {
                $this->load->database();
                $data['logs'] = $this->db->query('select * from print_log order by id desc limit 100')->result();
                $this->load->view('printlog', $data);
            }

            private function array_to_table($matriz)
            {
                echo "<table class='table table-bordered table-striped table-condensed table-hover dataTable'>";
                // Table body
                foreach ($matriz as $fila) {
                    echo "<tr>";
                    foreach ($fila as $elemento) {
                        echo "<td>".$elemento."</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }


            public function livetransfer()
            {
                $this->load->database();
                $live = $this->load->database('live', true);

                $live->empty_table('limited_members');
                $result = $this->db->query('select old_id,name,guardian_name,education_forum,bcc_number,bcc_name, is_nidhi from member where status != "closed" and is_nidhi = 1')->result_array();

                $live->insert_batch('limited_members', $result);
                echo 'Success';
            }

            public function importrazor()
            {
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
                                'credit' => $fields[3],
                                'settled' => $fields[9],
                                'created_date' => $fields[10],
                                'settled_date' => $date,
                                'card_network' => $fields[21],
                                'amount' => $fields[4]
                                );
                    if ($fields[9] !=0) {
                        if ($cnt !=1) {
                            $this->db->insert('razorpay', $batch_insert);
                            echo 'Success';
                        }
                    }
                    $cnt++;
                }

                //$batch_insert[] = $insertData;

            //$insertStatus = $this->db->insert_batch('ben_yearly_trialbalance', $batch_insert);
            }

            private function makedate($dt)
            {
                $newdt = explode('/', $dt);
                return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
            }
        }
