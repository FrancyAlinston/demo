<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Collection Summary <?php echo $_SESSION['user']; ?> </h1>
	<div class="box box-info" style="margin-top: 5px; background-color: #aee4f1;">
		<div class="box-body w3-allerta" id="accSummary">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="tran_date">From Date</label>
						<input type="text" class="form-control" name="frm_date" id="frm_date" value="<?php echo date('d/m/Y'); ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="tran_date">To Date</label>
						<input type="text" class="form-control" name="to_date" id="to_date" value="<?php echo date('d/m/Y'); ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="tran_date">User</label>
						<select class="form-control" name="selUser" id="selUser">
							<option value="">- All Users -</option>
							<?php foreach($users as $user){ ?>
								<option value="<?php echo $user->full_name; ?>"><?php echo $user->full_name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<span onclick="accountsTransactionHistory()" style="margin-top:25px" class="btn btn-primary">Fetch</span>
					</div>
					<div style="cursor:pointer" onclick="accountsTallyExport()">
						<span id="btnTallyexport" class="btn btn-success ">Tally Export</span>
					</div><br>
					<div id="multiexport" style="display:none">
						<div style="cursor:pointer" onclick="setExport('Receipt')">
							<i title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="color: #00A65A; font-size: 20px; cursor: pointer;"></i>
							Reciept
						</div>
						<div style="cursor:pointer" onclick="setExport('Payment')">
							<i title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="color: #00A65A; font-size: 20px; cursor: pointer;"></i>
							Payment
						</div>
						<div style="cursor:pointer" onclick="setExport('Contra')">
							<i title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="color: #00A65A; font-size: 20px; cursor: pointer;"></i>
							Contra
						</div>
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
	</section>
	<div id="popAccess" style="display:none;position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
		<div style="width:300px;height:200px;background: #fff;margin:0px auto;margin-top: 10%;padding:30px; border-radius: 8px">
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
    // $('#txtFrom,#txtTo').change(function(){
    //   $('#selForane,#selEduFrm').val('');
    // });
		//
    // $('#selEduFrm').change(function(){
    // 	$('#txtFrom,#txtTo').val('');
    // });

	});


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
	$('#Balance').val(parseFloat($('.cashInHand').text()) - amt);

	if($('#Balance').val() < 0){
		$("#Balance").css({"border-color": "red", "color": "red"});
	}else{
		$("#Balance").css({"border-color": "#ccc", "color": "#000"});
	}
}
	</script>
