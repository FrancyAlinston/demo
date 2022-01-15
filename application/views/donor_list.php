<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Donor List</h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-success" style="background-color: #96eba6;">
		<i style="float:right; margin-top:10px; margin-right:10px;color: #00A65A; font-size: 30px; cursor: pointer;"
			class="fa fa-file-excel-o" aria-hidden="true" title="Export to excel" onclick="exportCorpFund()"></i>
		<div id="boxResult" class="box-body w3-allerta">
			<table class="table table-bordered table-hover table-condensed" id="donorTable" style="background: #fff">
				<thead>
					<tr>
						<th style="width: 10px">ID</th>
						<th>Donor</th>
						<th>In Memory Of</th>
						<th>Eductaion Forum</th>
						<th>Directory Page</th>
						<th>Donor Photo</th>
						<th>InMemmory Photo</th>
						<th style="text-align: right;">Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php
    $sum = 0;
    foreach ($donor->result() as $row) {
        $sum=$row->amount; ?>
					<tr>
						<td><?php echo $row->id; ?>
						</td>
						<td><?php echo ucwords($row->donor); ?>
						</td>
						<td><?php echo ucwords($row->in_memory); ?>
						</td>
						<td><?php echo ucwords($row->edu_forum); ?>
						</td>
						<td><?php echo ucwords($row->directory_page); ?>
						</td>
						<td><?php if ($row->don_picture != '') {
            echo 'Available';
        } ?>
						</td>
						<td><?php if ($row->inmem_picture != '') {
            echo 'Available';
        } ?>
						</td>
						<td style="text-align: right;"><?php echo ucwords($row->amount); ?>
						</td>
					</tr>

					<?php
    } ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="7" style="text-align: right;">Total</th>
						<th><?php echo $sum; ?>
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
<?php include '_footer.php'; ?>
<script>
	$(function() {
		$('#donorTable').DataTable({
			'paging': false,
			'lengthChange': false,
			'searching': true,
			'ordering': true,
			'info': true,
			'autoWidth': false
		});
	});
</script>