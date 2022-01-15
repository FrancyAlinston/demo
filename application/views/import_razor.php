<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header ch" id="filterHead">
	<h1>Import Razor Pay File [Excel]</h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #b0e7fc;">
	<!-- <h2 style="margin: auto; text-align: center;color: red;">[!!! UNDER MAINTANENCE !!!]</h2> -->
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-6">
					<form autocomplete="off" enctype="multipart/form-data" action="" name="frmExel" id="frmExel" method="post">
						<div class="form-group">
							<label for="txtBatch">Import Excel File</label><br>
							<div class="btn btn-md btn-danger" onclick="$('#urlM').click()">Upload File</div>
							<input type="file" style="display: none;"  onchange="fileUploadBinary('exlRazorpay','frmExel')" name="urlM" id="urlM" class="form-control">
							<input type="hidden" name="txtexlRazorpay" id="txtexlRazorpay" value="">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-success" style="background: #d0d0d0;" >
		<div id="boxResult" class="box-body w3-allerta">
			</div>
				<!--table id="tableExam" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
					<thead>
						<tr>
							<th>Si No</th>
							<th>Batch ID</th>
							<th>NES ID</th>
							<th>Name</th>
							<th>Guardain</th>
							<th>Gender</th>
							<th>School</th>
							<th>Medium</th>
							<th>Syllabus</th>
							<th>Education Forun</th>
							<th>BCC Number</th>
							<th>BCC Name</th>
							<th>Phone</th>
							<th>Receipt Number</th>
							<th>Status</th>
						</tr>
					<thead>
					<tbody>
						<tr id="<?php echo $ben_data->id;?>">
							<td><?php echo $cnt;?></td>
							<td><?php echo $razorpay->member_name;?></td>
							<td><?php echo $razorpay->beneficiary_name;?></td>
							<td><?php echo $razorpay->beneficiary_id;?></td>
							<td><?php echo $razorpay->parish_name;?></td>
							<td><?php echo $razorpay->forum;?></td>
							<td><?php echo $razorpay->email;?></td>
							<td><?php echo $razorpay->phone;?></td>
							<td><?php echo $razorpay->entity_id;?></td>
							<td><?php echo $razorpay->credit;?></td>
							<td><?php echo $razorpay->settled;?></td>
							<td><?php echo $razorpay->created_date;?></td>
							<td><?php echo $razorpay->settled_date;?></td>
							<td><?php echo $razorpay->card_network;?></td>
						</tr>
					</tbody>
				</table-->
			</div>
		</div-->
		<!-- /.box-body -->
	</div>
</section>
<?php include '_footer.php'; ?>
<script>

</script>
