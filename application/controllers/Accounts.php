<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$_SESSION['m_menu']='Mbatch';
	}


	public function index(){
		$this->load->database();
		$this->load->view('login');
	}

	public function check_validate(){
		$this->load->database();
		$ids = explode("\n", trim($this->input->post('emp_no')));
		$result = $this->db->query('select group_concat(phone) phone from attendance where emp_code in ('.implode(',', $ids).')')->row();

		echo '<h4>Phone Numbers</h4><br>'.$result->phone;
	}

	public function dash(){
		$this->load->view('account_dash');
	}
	public function addvoucher(){
		//$this->output->enable_profiler(TRUE);
		$this->load->database();
		$data['heads'] = $this->db->get('acc_ledger_head')->result();
		$data['account_banks'] = $this->db->get('account_banks')->result();
		$data['eduforum'] = $this->db->get('eduforum_master')->result();
		$data['balance'] = $this->db->query('select sum(a.amount) amount from (select * from accounts where (type = "Reciept" and account = "Cash") or (type = "contra") or ( type="Payment")) a where a.accountant ="'.$_SESSION['user'].'"')->row()->amount;
		$this->load->view('accounts_voucher',$data);
	}

	public function addvoucherentry(){
		$this->load->database();
		if(in_array($this->input->post('type'), array('Payment','Journal','Contra'))){
			$_POST['Amount'] = $_POST['Amount'] * -1;
		}
		$insert_data = array(
			'ledger' => $this->input->post('leadger_head'),
			'type' => $this->input->post('type'),
			'tran_date' => $this->makedate($this->input->post('transaction_date')),
			'd2000' => $this->input->post('d2000'),
			'd500'  => $this->input->post('d500'),
			'd200'  => $this->input->post('d200'),
			'd100'  => $this->input->post('d100'),
			'd50'   => $this->input->post('d50'),
			'd20'   => $this->input->post('d20'),
			'd10'   => $this->input->post('d10'),
			'd1'    => $this->input->post('d1'),
			'amount' => $this->input->post('Amount'),
			'narration' => $this->input->post('narration'),
			'accountant' => $_SESSION['user'],
			'entry_date' => date("Y-m-d H:i:s")
		);

		if($this->input->post('type') == 'Reciept'){
			$insert_data['account'] = $this->input->post('bank');
			$insert_data['receipt_id'] = $this->db->query('select max(receipt_id)+1 rid from accounts')->row()->rid;
			$insert_data['narration'] = $insert_data['narration'].' [Receipt No :'.$insert_data['receipt_id'].']';
		}elseif($this->input->post('type') == 'Contra'){
			$insert_data['account'] = $this->input->post('bank');
			$insert_data['contra_id'] = $this->db->query('select max(contra_id)+1 cid from accounts')->row()->cid;
			$insert_data['narration'] = $insert_data['narration'].' [Contra No :'.$insert_data['contra_id'].']';
		}elseif($this->input->post('type') == 'Payment'){
			$insert_data['account'] = $this->input->post('bank');
			$insert_data['payment_id'] = $this->db->query('select max(payment_id)+1 pid from accounts')->row()->pid;
			$insert_data['narration'] = $insert_data['narration'].' [Payment No :'.$insert_data['payment_id'].']';
		}

		if($this->input->post('leadger_head') == 'Collection Center Maint Exp' || $this->input->post('leadger_head') == 'Members Share Application'){
			$insert_data['forum'] = $this->input->post('eduforum');
		}



		$query = $this->db->insert('accounts',$insert_data);
		echo 'Success | '. $this->db->insert_id();
	}

	public function minitransaction(){
		//$this->output->enable_profiler(TRUE);
		$this->load->database();
		$this->db->order_by("id", "desc");
		//$this->db->limit(5);
		$this->db->select('id,ledger,type,CONCAT(UCASE(LEFT(forum,1)),LCASE(SUBSTRING(forum,2))) forum,account,DATE_FORMAT(tran_date,"%d-%m-%Y")tran_date,amount,narration,accountant,payment_id,receipt_id,contra_id');
		$this->db->where(array('accountant' => $_SESSION['user'],'tran_date' => date('Y-m-d')));
		$tran = $this->db->get('accounts');
		$this->load->library('table');
		$template = array(
			'table_open'  => '<table id="tblDailyTran" style="width:100%;text-align:center;" class="table table-primary table-striped table-bordered pull-left">',
			'row_start'             => '<tr title="Click to Print" style="cursor:pointer" onclick="printAccountReciept(this)">',
			'row_alt_start'         => '<tr title="Click to Print" style="cursor:pointer" onclick="printAccountReciept(this)">'
		);
		$this->table->set_template($template);
		echo $this->table->generate($tran);

	}
	public function dailyunprinted(){
		$this->load->database();
		$this->db->order_by("id", "desc");
		//$this->db->limit(5);
		$tran = $this->db->query('select * from accounts where entry_date = curdate() and is_print is null');
		$this->load->library('table');
		$template = array(
			'table_open'  => '<table id="tblDailyTran" style="width:100%;text-align:center;" class="table table-primary table-striped table-bordered pull-left">',
			'row_start'             => '<tr title="Click to Print" style="cursor:pointer" onclick="printAccountReciept(this)">',
			'row_alt_start'         => '<tr title="Click to Print" style="cursor:pointer" onclick="printAccountReciept(this)">'
		);
		$this->table->set_template($template);
		$data['dailytrans'] = $this->table->generate($tran);
		$this->load->view('daily_transaction',$data);
	}

	public function summary(){
		$this->load->view('accounts_summary_accounts_wise');
	}

	public function transactionshistory(){
		$this->load->database();
		$data['users'] = $this->db->query('select full_name from users where full_name like "%Account Manager%"')->result();
		$this->load->view('accounts_transaction_history',$data);
	}

	public function transactionshistory_(){
		//$this->output->enable_profiler(TRUE);
		$this->load->database();
		if(isset($_POST['frm_date'])){
			$frm_date = $this->makedate($_POST['frm_date']);
		}else{
			$frm_date = date('Y-m-d');
		}
		if(isset($_POST['to_date'])){
			$to_date = $this->makedate($_POST['to_date']);
		}else{
			$to_date = date('Y-m-d');
		}
		//$condition = array('tran_date' => $tran_date);

		if($this->input->post('selUser') != ''){
			$condition['accountant'] =$this->input->post('selUser');
		}

		$condition['date(entry_date) >='] = $frm_date;
		$condition['date(entry_date) <='] = $to_date;

		$this->db->order_by("id", "asc");
		$data['transactions'] =$tran = $this->db->get_where('accounts',$condition)->result();
		$this->load->view('_accounts_transaction_history',$data);
	}

	public function summaryxhr(){
		//$this->output->enable_profiler(TRUE);
		if(isset($_POST['tran_date'])){
			$tran_date = $this->makedate($_POST['tran_date']);
		}else{
			$tran_date = date('Y-m-d');
		}
		$data['tran_date'] = $tran_date;
		$this->load->database();

		if(isset($_POST['user'])){
			$user = $_POST['user'];
		}else{
			$user = $_SESSION['user'];
		}
		$data['user'] = $user;

		$query = $this->db->query("select sum(amount) collection from accounts where type = 'Reciept' and account = 'Cash' and ledger != 'Members Share Application' and tran_date ='".$tran_date."' and accountant = '".$user."' group by type");
		if($query->num_rows() > 0 ){
			$data['collection'] = $query->row()->collection;
		}else{
			$data['collection'] = 0;
		}

		$query = $this->db->query("select sum(amount) shareapp from accounts where type = 'Reciept' and account = 'Cash' and ledger = 'Members Share Application' and tran_date ='".$tran_date."' and accountant = '".$user."' group by type");
		if($query->num_rows() > 0 ){
			$data['shareapp'] = $query->row()->shareapp;
		}else{
			$data['shareapp'] = 0;
		}


		$query = $this->db->query("select sum(amount) maintenece from accounts where type='Payment' and account='Cash' and ledger='Collection Center Maint Exp' and tran_date ='".$tran_date."' and accountant = '".$user."' group by type");
		if($query->num_rows() > 0 ){
			$data['maintenece'] = $query->row()->maintenece;
		}else{
			$data['maintenece'] = 0;
		}

		$query = $this->db->query("select sum(amount) payments from accounts where type='Payment' and account='Cash' and ledger!='Collection Center Maint Exp' and tran_date ='".$tran_date."' and accountant = '".$user."' group by type");
		if($query->num_rows() > 0 ){
			$data['payments'] = $query->row()->payments;
		}else{
			$data['payments'] = 0;
		}

		$query = $this->db->query("select sum(amount) contra from accounts where type='Contra' and tran_date ='".$tran_date."' and accountant = '".$user."' group by type");
		if($query->num_rows() > 0 ){
			$data['contra'] = $query->row()->contra;
		}else{
			$data['contra'] = 0;
		}

		$data['balance'] = $this->db->query('select sum(a.amount) amount from (select * from accounts where (type = "Reciept" and account = "Cash") or (type = "contra") or ( type="Payment")) a where a.accountant = "'.$user.'" and a.tran_date <= "'.$tran_date.'"')->row()->amount;
		$data['openingbalance'] = $this->db->query('select sum(a.amount) amount from (select * from accounts where (type = "Reciept" and account = "Cash") or (type = "contra") or ( type="Payment")) a  where accountant = "'.$user.'" and a.tran_date <= DATE_SUB("'.$tran_date.'", INTERVAL 1 DAY)')->row()->amount;

		$this->load->view('_accounts_summary',$data);
	}

	function typesummaryxhr(){
		//$this->output->enable_profiler(TRUE);
		if(isset($_POST['tran_date'])){
			$tran_date = $_POST['tran_date'];
		}else{
			$tran_date = date('Y-m-d');
		}

		if(isset($_POST['user'])){
			$user = $_POST['user'];
		}else{
			$user = $_SESSION['user'];
		}

		$data['tran_date'] = $tran_date;
		$this->load->database();

		if($this->input->post('type') == 'Collection'){
			$condition = "type = 'Reciept' and account = 'Cash' and ledger != 'Members Share Application' and tran_date ='".$tran_date."' and accountant = '".$user."'";
		}elseif($this->input->post('type') == 'ShareApp'){
			$condition = "type = 'Reciept' and account = 'Cash' and ledger = 'Members Share Application' and tran_date ='".$tran_date."' and accountant = '".$user."'";
		}elseif($this->input->post('type') == 'CollectionMaintenece'){
			$condition = "type='Payment' and account='Cash' and ledger='Collection Center Maint Exp' and tran_date ='".$tran_date."' and accountant = '".$user."'";
		}elseif($this->input->post('type') == 'Payments'){
			$condition = "type='Payment' and account='Cash' and ledger!='Collection Center Maint Exp' and tran_date ='".$tran_date."' and accountant = '".$user."'";
		}elseif($this->input->post('type') == 'Contra'){
			$condition = "type='Contra' and tran_date ='".$tran_date."' and accountant = '".$user."'";
		}

		$query = $this->db->query("select id,DATE_FORMAT(tran_date,'%d-%m-%Y') Date,ledger,type,forum,account,amount from accounts where ".$condition);
		if($query->num_rows() > 0 ){
			$this->load->library('table');
			$template = array(
				'table_open'  => '<table id="tblTranSummary" style="width:100%;text-align:center;" class="table table-primary table-striped table-bordered">'
			);
			$this->table->set_template($template);
			echo $this->table->generate($query);
		}else{
			echo 'No Transactions of type "'.$this->input->post('type').'" found for the date '.$this->makedateindian($tran_date);
		}
	}

	public function deletetransaction(){
		$this->load->database();
		if(isset($_POST['id'])){
			$this->db->query('insert into accounts_deleted select * from accounts where id ='.$this->input->post('id'));
			if($this->db->delete('accounts', array('id' => $this->input->post('id')))){
				echo 'deleted';
			}
		}
	}

	public function sister(){
		$this->load->database();
		$tran = $this->db->get('temps')->result();
		echo  '<table><tr>';
		$cnt = 0;
		foreach($tran as $add){
			$cnt++;
			echo '<td style="border:1px solid #000;">'.str_replace("\n",'<br>',$add->data).'</td>';
			if($cnt == 3){
				$cnt = 0;
				echo '</tr><tr>';
			}
		}
		echo '</table>';
	}

	public function print(){
		$this->load->database();
		$this->load->helper('url');
		$last = $this->uri->total_segments();
		$id = $this->uri->segment($last);
		$data['print'] = $this->db->get_where('accounts',array('id' => $id))->row();
		$this->db->query('update accounts set is_print = 1 where id = '.$id);
		$this->load->view('accounts_print',$data);
	}

	public function seq(){ // function to generate manual sequance for transactin type
		$this->load->database();
		$items = $this->db->query('select * from accounts where type = "Contra" order by id')->result_array();
		$cnt = 1;
		foreach($items as $item){
			$this->db->where('id', $item['id']);
			$this->db->update('accounts', array('contra_id' => $cnt));
			$cnt++;
		}
		echo "Sequence Updated";
	}

	public function filter(){
		//$this->output->enable_profiler(TRUE);
		$this->load->database();
		$data['heads'] = $this->db->get('acc_ledger_head')->result();
		$data['account_banks'] = $this->db->get('account_banks')->result();
		$data['eduforum'] = $this->db->get('eduforum_master')->result();
		$this->load->view('accounts_filter',$data);
	}

	public function filter_(){
		//$this->output->enable_profiler(TRUE);
		$this->load->database();
		$condition = array();
		if($this->input->post('type') != ''){
			$condition['type'] = $this->input->post('type');
		}
		if($this->input->post('leadger_head') != ''){
			$condition['ledger'] = $this->input->post('leadger_head');
		}

		if($this->input->post('bank') != ''){
			$condition['account'] = $this->input->post('bank');
		}

		if($this->input->post('eduforum') != ''){
			$condition['forum'] = $this->input->post('eduforum');
		}

			$condition['date(entry_date) >='] = $this->makedate($_POST['frm_date']);
			$condition['date(entry_date) <='] = $this->makedate($_POST['to_date']);

		//$this->db->select('id,ledger,type,forum,account,tran_date,amount,narration,accountant,entry_date,payment_id,receipt_id,contra_id');
		$this->db->where($condition);
		$data['transactions'] = $this->db->get('accounts')->result();
		$data['viewOnly'] = 'true';
		$this->load->view('_accounts_transaction_history',$data);
	}

	public function incentivecalculator(){
		$this->load->database();
		$this->db->like('head', 'Forum', 'before');
		$data['heads'] = $this->db->get('acc_ledger_head')->result();
		$this->load->view('accounts_incentive',$data);
	}

	public function incentive_(){
		$this->load->database();
		$condition = array();

		if($this->input->post('leadger_head') != ''){
			$condition['ledger'] = $this->input->post('leadger_head');
		}
		$condition['type'] = 'Reciept';
		$condition['tran_date >='] = $this->makedate($_POST['frm_date']);
		$condition['tran_date <='] = $this->makedate($_POST['to_date']);
		$this->db->select('id,ledger,type,forum,account,tran_date,amount,narration,accountant,entry_date,payment_id,receipt_id,contra_id');
		$this->db->where($condition);
		$data['transactions'] = $this->db->get('accounts')->result();
		$data['viewOnly'] = 'true';
		$this->load->view('_accounts_incentive',$data);
	}

	private function makedate($dt){
		$newdt = explode('/',$dt);
		return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
	}

	private function makedateindian($dt){
		$newdt = explode('-',$dt);
		return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
	}
}
