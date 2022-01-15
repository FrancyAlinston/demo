<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>New Nidhi Entries List &amp; Export </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-2">
							<label for="selForanee">Forane</label>
									<select class="form-control" name="selForane" id="selForane" onchange="geteduforum(value,'selEduFrm')">
										<option value=""></option>
									<?php foreach ($forane->result() as $row) { ?>
									<option value="<?php echo $row->id.'|'.$row->forane; ?>"><?php echo ucwords($row->forane); ?></option>
									<?php } ?>
								    </select>
						</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="selEduFrm">Education Forum</label>
						<select id="selEduFrm" name="selEduFrm" class="form-control">
							<option value="">All</option>
						</select>
						</div
					</div>
				</div>

				<div style="border-left: 1px solid #ccc; overflow: hidden;" class="col-md-offset-1 col-md-6">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtFrom">From Date</label>
								<input type="text" class="form-control" name="txtFrom" id="txtFrom">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtTo">To Date</label>
								<input type="text" class="form-control" name="txtTo" id="txtTo">
							</div>
						</div>
					<div class="col-md-4" style="white-space: nowrap;">
						<div class="form-group">
							 <label>&nbsp;</label>
							<button onclick="newNidhiEntryList()" style="display:block;margin-bottom:10px" class="btn btn-md btn-primary">Show Entries</button>
							<span class="btn btn-success btn-xs" style="cursor:pointer" onclick="exportNewNidhiEntry()"> <i class="fa fa-file-excel-o"></i>Export to Excel </span>
						</div>
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
		$('#txtFrom,#txtTo').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtFrom,#txtTo').datepicker({
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

function verifyAccess(){
	if($('#txtAccess').val() == 'nidhi2018'){
		$('#popAccess').css('display','none');
	}else{

	}
}
	</script>
