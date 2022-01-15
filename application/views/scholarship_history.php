<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Individual Scholarship History </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px">
		<div class="box-body">
			<div class="row">
				<div class="col-md-3">

				</div>
				<i onclick="exportScholarshipIndividualHistory()" title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="float: right;color: #00A65A; font-size: 20px; cursor: pointer; margin-right:20px;"></i>
			</div>
		</div>
	</div>
		<div class="box box-success">
			<div id="boxResult" class="box-body">
				<table class="table table-bordered table-hover dataTable table-condensed">
					<thead>
					<tr>
						<th>NES ID</th>
						<th>Name</th>
						<th>Forum</th>
						<?php
						$yearly = array();
						foreach (range(2018, date('Y')) as $number) {
							$yearly[$number] = '';
							?>
 							<th><?php echo $number; ?></th>
						<?php }?>
					</tr>
				</thead>
				<tbody>
					<?php

					  $cnt = 0;
					  foreach($scholarship as $ship){
							if(isset($scholarship[$cnt+1]) && $scholarship[$cnt+1]->nes_id == $ship->nes_id){
								$yearly[$ship->year] = $ship->amount_recived;
									$cnt++;
								continue;
							}else{
								$yearly[$ship->year] = $ship->amount_recived;
					?>
						<tr>
							<td><?php echo $ship->nes_id;?></td>
							<td><?php echo $ship->name;?></td>
							<td><?php echo $ship->edu_forum;?></td>
							<?php foreach (range(2018, date('Y')) as $number) {	?>
	 							<td><?php echo $yearly[$number]; ?></td>
							<?php }?>
						</tr>
					<?php
					$yearly = array_fill_keys(array_keys($yearly), null);
				       }
					 $cnt++;
				 } ?>
			   </tbody>
				</table>

			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<!-- <div id="popAccess" style="z-index: 100;position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
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
</div> -->
	<?php include '_footer.php'; ?>
<script>

	function verifyAccess(){
		if($('#txtAccess').val() == 'nidhi2018'){
			$('#popAccess').css('display','none');
		}else{

		}
	}
	$(function(){
		$('.dataTable').DataTable({
        'paging': false,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false
    });
	});
</script>
