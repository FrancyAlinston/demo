<section class="content">
	<form method="post" onsubmit="return add_fund_corpus()" id="frmaddFund" name="frmaddFund">

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtOlvoucher_numberdid">Voucher Number</label>
									<input id="voucher_number" name="voucher_number" class="form-control" value="" type="text" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="narration">Narration</label>
									<input  id="narration" name="narration" class="form-control" value="" type="text" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtGuardianS">Transaction Date</label>
									<input id="transaction_date" name="transaction_date" class="form-control" value="" type="text" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtGuardianS">Amount</label>
									<input id="Amount" name="Amount" class="form-control" value="" type="text" required>
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
						<input type="hidden" name="corp_id" value="<?php echo $doner; ?>">
						<div id="addFundResults"></div>
	</form>
	<script>
	$(function(){
		$('#transaction_date').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#transaction_date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	});
	</script>
