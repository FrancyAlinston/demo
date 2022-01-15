<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Collection Summary <?php echo $_SESSION['user']; ?>
	</h1>
	<div class="box box-info" style="margin-top: 5px; background-color: #aee4f1;">
		<div class="box-body w3-allerta" id="accSummary">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="tran_date">Transaction Date</label>
						<input type="text" class="form-control" name="tran_date" id="tran_date"
							value="<?php echo date('d/m/Y'); ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php
                        $function = 'fetchAccountsTran()';
                        if ($_SESSION['user'] == 'Accounts Admin') {
                            $function = 'fetchAccountsTranBatch()';
                        }
                        ?>
						<span onclick="<?php echo $function;?>"
							style="margin-top:25px" class="btn btn-primary">Fetch</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-success" style="background-color: #96eba6;">
		<div id="boxResult" class="box-body w3-allerta">

		</div>
		<!-- /.box-body -->
	</div>

	<?php if ($_SESSION['user'] != 'Accounts Admin') { ?>
	<div class="box box-danger" style="background-color: #ffb8ba;">
		<div class="box-header with-border">
			<h3 class="box-title">Denomination Calcualtor</h3>
		</div>
		<div id="" class="box-body w3-allerta">

			<div class="row" style="text-align:center">
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">2000</label>
						<input onkeyup="autocal('2000')" id="d2000" name="d2000" class="form-control" value=""
							type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">500</label>
						<input onkeyup="autocal('500')" id="d500" name="d500" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">200</label>
						<input onkeyup="autocal('200')" id="d200" name="d200" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">100</label>
						<input onkeyup="autocal('100')" id="d100" name="d100" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">50</label>
						<input onkeyup="autocal('50')" id="d50" name="d50" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">20</label>
						<input onkeyup="autocal('20')" id="d20" name="d20" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">10</label>
						<input onkeyup="autocal('10')" id="d10" name="d10" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">Coin</label>
						<input onkeyup="autocal('1')" id="d1" name="d1" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtGuardianS">Amount[by Denom]</label>
						<input id="AmountD" name="AmountD" class="form-control" value="" type="text">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtGuardianS">Balance</label>
						<input id="Balance" name="Balance" class="form-control" value="" type="text">
					</div>
				</div>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<?php } ?>
</section>
<div id="popAccess" style="display:none;position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
	<div
		style="width:300px;height:200px;background: #fff;margin:0px auto;margin-top: 10%;padding:30px; border-radius: 8px">
		<div class="row">
			<div class="col-md-12">
				<p>Content is password protected</p>
				<div class="form-group">
					<label for="txtAccess">Pasword</label>
					<input type="password" class="form-control" name="txtAccess" id="txtAccess">
				</div>
				<span class="btn btn-danger" style="width: 100%" onclick="verifyAccess()">Submit</span>
			</div>
		</div>

	</div>
</div>
<?php include '_footer.php'; ?>
<script>
	$(function() {

		var user =
			'<?php if (isset($_SESSION['user'])) {
                            echo $_SESSION['user'];
                        } ?>';
		if (user == '') {
			location.href = site_url + 'accounts';
		}

		$('#tran_date').inputmask('dd/mm/yyyy', {
			'placeholder': 'dd/mm/yyyy'
		});
		$('#tran_date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
		// $('#txtFrom,#txtTo').change(function(){
		//   $('#selForane,#selEduFrm').val('');
		// });
		//
		// $('#selEduFrm').change(function(){
		// 	$('#txtFrom,#txtTo').val('');
		// });

	});


	function autocal() {
		var amt = ($('#d2000').val() * 2000) +
			($('#d500').val() * 500) +
			($('#d200').val() * 200) +
			($('#d100').val() * 100) +
			($('#d50').val() * 50) +
			($('#d20').val() * 20) +
			($('#d10').val() * 10) +
			($('#d1').val() * 1);
		$('#AmountD').val(amt);
		$('#Balance').val(parseFloat($('.cashInHand').text().replace(/,/g, "")) - amt);

		if ($('#Balance').val() < 0) {
			$("#Balance").css({
				"border-color": "red",
				"color": "red"
			});
		} else {
			$("#Balance").css({
				"border-color": "#ccc",
				"color": "#000"
			});
		}
	}
</script>