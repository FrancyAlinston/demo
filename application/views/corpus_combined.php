<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Forumwise Combined Filter &amp; Export </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-success" style="background-color: #96eba6;">
		<div id="boxResult" class="box-body w3-allerta">
			<i onclick="exportCorpusForumwiseAgrigate()" title="Export to excel" aria-hidden="true"
				class="fa fa-file-excel-o" style="float: right;color: #00A65A; font-size: 34px; cursor: pointer;"></i>
			<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable"
				role="grid">
				<tr>
					<th>Si No</th>
					<th>Education Forun</th>
					<th style="text-align: center;" align="center">Count</th>
				</tr>
				<?php
                        $cnt = 0;
                        $total = 0;
                        foreach ($funds->result() as $fund) {
                            $cnt++;
                            $total += $fund->amount; ?>
				<tr>
					<td><?php echo $cnt; ?>
					</td>
					<td><?php echo ucwords($fund->edu_forum); ?>
					</td>
					<td align="center"><?php echo $fund->amount; ?>
					</td>
				</tr>
				<?php
                        } ?>
				<tr>
					<th></th>
					<th>Total</th>
					<th style="text-align: center;" align="center"><?php echo $total;?>
					</th>
					<th></th>
					<th></th>
				</tr>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</section>
<?php include '_footer.php'; ?>
<script>

</script>