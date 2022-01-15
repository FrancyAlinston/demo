<?php
include_once("db_connect.php");
$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
	$update_field='';
	if(isset($input['nes_id'])) {
		$update_field.= "nes_id='".$input['nes_id']."'";
	} else if(isset($input['acnumber'])) {
		$update_field.= "acnumber='".$input['acnumber']."'";
	} else if(isset($input['acname'])) {
		$update_field.= "acname='".$input['acname']."'";
	} else if(isset($input['ifsc'])) {
		$update_field.= "ifsc='".$input['ifsc']."'";
	} else if(isset($input['branchid'])) {
		$update_field.= "branchid='".$input['branchid']."'";
	}else if(isset($input['bank_name'])) {
		$update_field.= "bank_name='".$input['bank_name']."'";
	}else if(isset($input['scheme_amt'])) {
		$update_field.= "scheme_amt='".$input['scheme_amt']."'";
	}else if(isset($input['nidhi_amt'])) {
		$update_field.= "nidhi_amt='".$input['nidhi_amt']."'";
	}
	if($update_field && $input['id']) {
		$sql_query = "UPDATE neftaccountclosed SET $update_field WHERE id='" . $input['id'] . "'";
		mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
	}
}


