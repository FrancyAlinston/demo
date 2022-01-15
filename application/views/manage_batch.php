<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>Batch List</h1>
<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="box box-success" id="courseList" style="background-color: #96eba6;">
					<div class="box-header with-border">
						<i style="float: right;color: #00A65A; cursor: pointer;" class="fa fa-file-excel-o" aria-hidden="true" title="Export to excel" onclick="exportEX('batchlist')"></i>
					</div>
					<div class="box-body w3-allerta" id="boxResult">

					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<!--/.col (left) -->
		</div>
		<!-- /.row -->

	<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php include '_footer.php'; ?>
<script type="text/javascript">
	$(function(){
		loadWithPage('batchlist');
	});
</script>