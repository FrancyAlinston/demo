<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tally extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $_SESSION['m_menu']='Mbatch';
    }


    public function test()
    {
        $requestXML = '<ENVELOPE>'.
                           '<HEADER>'.
                           '<TALLYREQUEST>Export Data</TALLYREQUEST>'.
                                                     '<TYPE>OBJECT</TYPE>'.
                                                     '<SUBTYPE>Ledger</SUBTYPE>'.
                           '</HEADER>'.
                           '<BODY>'.
                           '<EXPORTDATA>'.
                           '<REQUESTDESC>'.
                           '<REPORTNAME>Balance Sheet</REPORTNAME>'.
                           '<STATICVARIABLES>'.
                                                     '<SVCURRENTCOMPANY>$nidhi</SVCURRENTCOMPANY>'.
                           '<SVEXPORTFORMAT>$$SysName:XML</SVEXPORTFORMAT>'.
                           '</STATICVARIABLES>'.
                           '</REQUESTDESC>'.
                           '</EXPORTDATA>'.
                           '</BODY>'.
                           '</ENVELOPE>';

        //$server = 'http://192.168.2.205:9000';
        $server = 'http://192.168.2.200:9000/tally/Tally.ERP9 4.7';

        $headers = array( "Content-type: application/json","Content-length:".strlen($requestXML) ,"Connection: close");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);



        if (curl_errno($ch)) {
            print curl_error($ch);
            echo "  something went wrong..... try later";
        } else {
            echo " request accepted";
            $object = simplexml_load_string($data);
            print_r($data);
            curl_close($ch);
        }
    }
}
