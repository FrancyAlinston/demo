<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>

<section class="content-header">
	<h1>
		Create Voucher
	</h1>
<?php include '_breadcrumbs.php'; ?>
</section>

<section class="content">
	<div class="box box-success" id="courseList" style="background-color: #96eba6;">
		<div class="box-header with-border" style="text-align:right; color:green; width:100%">
			<?php echo 'Balance : &#8377; '.$balance; ?>
		</div>
		<div class="box-body w3-allerta" id="boxResult" >
	<form method="post" onsubmit="return add_voucher()" id="frmaddFund" name="frmaddFund">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtOlvoucher_numberdid">Ledger Head</label>
									<select required onchange="autoNarrate()" id="leadger_head" name="leadger_head" class="form-control selectpicker" data-live-search="true">
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
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardianS">Transaction Date</label>
									<input id="transaction_date" name="transaction_date" class="form-control" value="<?php echo date('d/m/Y'); ?>" type="text" required>
								</div>
							</div>
							<div class="col-md-6" id="selectBank" style="display:none">
								<div class="form-group">
									<label for="">Select Bank</label>
									<select onchange="autoNarrate()" id="bank" name="bank" class="form-control selectpicker" data-live-search="true" required>
										<option value=""> - select - </option>
										<option value="Cash">Cash</option>
										<?php foreach ($account_banks as $bank) { ?>
										<option value="<?php echo $bank->bank; ?>"><?php echo $bank->bank; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardianS">Book No</label>
									<input onkeyup="autoNarrate()" id="bookNo" name="bookNo" class="form-control" value="" type="text" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardianS">Reciept From</label>
									<input onkeyup="autoNarrate()" id="rtFrom" name="rtFrom" class="form-control" value="" type="text" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardianS">Reciept To</label>
									<input onkeyup="autoNarrate()" id="rtTo" name="rtTo" class="form-control" value="" type="text" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardianS">Amount</label>
									<input id="Amount" name="Amount" class="form-control" value="" type="text" required>
								</div>
							</div>
						</div>
						<div class="row" style="text-align:center">
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">2000</label>
								<input onkeyup="autocal('2000')" id="d2000" name="d2000" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">500</label>
								<input onkeyup="autocal('500')" id="d500" name="d500" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">200</label>
								<input onkeyup="autocal('200')" id="d200" name="d200" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">100</label>
								<input onkeyup="autocal('100')" id="d100" name="d100" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">50</label>
								<input onkeyup="autocal('50')" id="d50" name="d50" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">20</label>
								<input onkeyup="autocal('20')" id="d20" name="d20" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">10</label>
								<input onkeyup="autocal('10')" id="d10" name="d10" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">Coin</label>
								<input onkeyup="autocal('1')" id="d1" name="d1" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtGuardianS">Amount[by Denom]</label>
								<input id="AmountD" name="AmountD" class="form-control" value="" type="text" >
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="txtGuardianS">Balance</label>
								<input id="Balance" name="Balance" class="form-control" value="" type="text" >
							</div>
						</div>
					</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="narration">Narration</label>
									<input  id="narration" name="narration" class="form-control" value="" type="text" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"></div>
							 <div class="col-md-4">
						    	<button class="btn btn-primary center-block" >Submit</button>
						    </div>
							<div class="col-md-4"></div>
						</div>
						<input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>">

						</form>
					</div>

				<!-- /.box-body -->
			</div>
			<div class="box box-success" style="background-color: #96eba6;">
				<div class="box-header with-border">
				</div>
				<div class="box-body w3-allerta" id="addFundResults" style="overflow-x:auto;">
				</div>
			</div>
		</section>
	</div>
	<a id="makePrint" href="" target="_tab">makeprint</a>
<?php include '_footer.php'; ?>
<script type="text/javascript">
	$(function(){
		loadWithPage('accounts');
	});
</script>
<script>
$(function(){
	var user = '<?php if(isset( $_SESSION['user'])){ echo $_SESSION['user']; } ?>';
	if(user == ''){
		location.href = site_url+'accounts';
	}
	$('#transaction_date').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
	$('#transaction_date').datepicker({
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
