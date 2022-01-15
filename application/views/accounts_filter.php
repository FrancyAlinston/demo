<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>

<section class="content-header">
	<h1>
		Accounts Transactions Filter
	</h1>
<?php include '_breadcrumbs.php'; ?>
</section>

<section class="content">
	<div class="box box-info" id="courseList" style="background-color: #aee4f1;">
		<div class="box-header with-border" style="text-align:right; color:green; width:100%">
			<i style="float: right;color: #00A65A; font-size: 20px; cursor: pointer;" class="fa fa-file-excel-o" aria-hidden="true" title="Export to excel" onclick="accountsFilterExport()"></i>
		</div>
		<div class="box-body w3-allerta">
	<form method="post" onsubmit="return accountsFilter()" id="frmAccountsFilter" name="frmAccountsFilter">

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtOlvoucher_numberdid">Ledger Head</label>
									<select onchange="autoNarrate()" id="leadger_head" name="leadger_head" class="form-control selectpicker" data-live-search="true">
										<option value=""> - select - </option>
										<?php foreach ($heads as $head) { ?>
										<option value="<?php echo $head->head; ?>"><?php echo $head->head; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Type</label>
									<select onchange="setVoucherType()" id="type" name="type" class="form-control selectpicker" data-live-search="true">
										<option value=""> - select - </option>
										<option value="Reciept">Receipt</option>
										<option value="Cheque">Cheque</option>
										<option value="Payment">Payment</option>
										<option value="Journal">Journal</option>
										<option value="Contra">Contra</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="frm_date">From Date</label>
									<input class="form-control" name="frm_date" id="frm_date" value="" type="text" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="to_date">To Date</label>
									<input class="form-control" name="to_date" id="to_date" value="" type="text" required>
								</div>
							</div>
							<div class="col-md-2">
								 <button class="btn btn-primary center-block" style="margin-top:25px" >Fetch Transactions</button>
							 </div>
						</div>

						<div class="row">
							<div class="col-md-3" id="selectForum" style="display:none">
								<div class="form-group">
									<label for="">Education Forum</label>
									<select onchange="autoNarrate()" id="eduforum" name="eduforum" class="form-control selectpicker" data-live-search="true">
										<option value=""> - select - </option>
										<?php foreach ($eduforum as $eduforum) { ?>
										<option value="<?php echo $eduforum->eduforum; ?>"><?php echo $eduforum->eduforum; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-3" id="selectBank" style="display:none">
								<div class="form-group">
									<label for="">Select Bank</label>
									<select onchange="autoNarrate()" id="bank" name="bank" class="form-control selectpicker" data-live-search="true" >
										<option value=""> - select - </option>
										<option value="Cash">Cash</option>
										<?php foreach ($account_banks as $bank) { ?>
										<option value="<?php echo $bank->bank; ?>"><?php echo $bank->bank; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">

						</form>
					</div>

				<!-- /.box-body -->
			</div>
			<div class="box box-success" style="background-color: #96eba6;">
				<div class="box-header with-border">
				</div>
				<div class="box-body w3-allerta" id="boxResult" style="overflow-x:auto;height:500px; overflow-y:scroll">
				</div>
			</div>
		</section>
	</div>
<?php include '_footer.php'; ?>
<script>
$(function(){
	var user = '<?php if(isset( $_SESSION['user'])){ echo $_SESSION['user']; } ?>';
	if(user == ''){
		location.href = site_url+'accounts';
	}
	$('#frm_date,#to_date').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#frm_date,#to_date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	$('.sidebar-toggle').trigger('click');
});

function autoNarrate(){
//	$('#rtFrom,#rtTo,#bookNo').val(0);
	$('#Amount').removeAttr('readonly');
	if( $('#leadger_head').val() == 'Collection Center Maint Exp'){
		$('#type').val('Payment');
    $('.selectpicker').selectpicker('refresh');
		$('#narration').val('Collection Center Maint Exp paid to '+$('#eduforum').val()+' forum for the month of ');
		$('#selectForum').show('fast');
		$('#receiptType').hide('fast');
		$('#selectBank').show('fast');
		$('#bank').val('Cash');
    $('.selectpicker').selectpicker('refresh');
	}else if( $('#type').val() == 'Reciept'){
		$('#narration').val('Rt No.'+$('#rtFrom').val()+' - '+$('#rtTo').val()+', Book No '+$('#bookNo').val()+' - '+$('#leadger_head').val());
	}else if ( $('#type').val() == 'Contra' ) {
		$('#narration').val('Cash Deposited at '+$('#bank').val());
	}else if( $('#leadger_head').val() == 'Members Share Application'){
		$('#selectForum').show('fast');
		$('#type').val('Reciept');
		$('.selectpicker').selectpicker('refresh');
		$('#selectBank').show('fast');
	}else{
		$('#selectForum').hide('fast');
	}
	if( $('#leadger_head').val() != 'Collection Center Maint Exp'){
			$('#eduforum').val('');
			$('#eduforum').selectpicker('refresh');
	}
}

function autocal(){
	var amt = ($('#d2000').val()*2000)+
	($('#d500').val()*500)+
	($('#d200').val()*200)+
	($('#d100').val()*100)+
	($('#d50').val()*50)+
	($('#d20').val()*20)+
	($('#d10').val()*10)+
	($('#d1').val()*1);
	$('#AmountD').val(amt);
	$('#Balance').val($('#Amount').val() - amt);

	if($('#Balance').val() < 0){
		$("#Balance").css({"border-color": "red", "color": "red"});
	}else{
		$("#Balance").css({"border-color": "#ccc", "color": "#000"});
	}
}

//function autoNarrate(){
//	$('#narration').val('Rt No.'+$('#rtFrom').val()+' - '+$('#rtTo').val()+', Book No '+$('#bookNo').val());
//}
function setVoucherType(){
	if($('#type').val() == 'Reciept'){
		$('#selectBank').show('fast');
	}else	if($('#type').val() == 'Contra'){
		$('#selectBank').show('fast');
	}else	if($('#type').val() == 'Payment'){
		$('#selectBank').show('fast');
		$('#bank').val('Cash');
    $('.selectpicker').selectpicker('refresh');
	}else{
		$('#selectBank').hide('fast');
	}
	autoNarrate();
}

function printAccountReciept(row){
	$('#makePrint').attr('href','<?php echo $site_url?>accounts/print/'+$(row).find('td:nth-child(1)').text());
	$('#makePrint')[0].click();
}
</script>
