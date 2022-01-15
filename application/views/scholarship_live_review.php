<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Individual Scholarship History </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-3">
					<div>
					</div>
				</div>
			</div>
			<div class="box box-success" style="background-color: #d0fae3;">
				<div id="boxResult" class="box-body w3-allerta">
					<table class="table table-bordered table-hover dataTable table-condensed">
						<thead>
							<th>NES ID</th>
							<th>Batch ID</th>
							<th>Name</th>
							<th>Education Forum</th>
							<th>Entry Date</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php
                      $cnt = 0;
                      foreach ($scholarship as $ship) {
                          ?>
							<tr>
								<td><?php echo $ship->nes_id; ?>
								</td>
								<td><?php echo $ship->generated_id; ?>
								</td>
								<td><?php echo $ship->name; ?>
								</td>
								<td><?php echo $ship->edu_forum; ?>
								</td>
								<td><?php echo $ship->entry_date; ?>
								</td>
								<td>
									<?php echo $ship->status; ?>
								</td>

								<td><span
										class="btn btn-xs <?php echo $ship->btnColor; ?>"
										onclick="reviewLiveScholarship('<?php echo $ship->id; ?>')">Review</span>
								</td>
							</tr>
							<?php
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
<style>
	#scovelray {
		background: rgba(255, 255, 255, 0.8) none repeat scroll 0 0;
		height: 700px;
		overflow: hidden;
		padding-top: 105px;
		position: relative;
		text-align: center;
		width: 100%;
		text-align: center;
	}
</style>
<script>
	function verifyAccess() {
		if ($('#txtAccess').val() == 'nidhi2018') {
			$('#popAccess').css('display', 'none');
		} else {

		}
	}
	$(function() {
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