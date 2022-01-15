<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		Create Course
		<small>Courses By Navadarsan</small>
	</h1>
<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return createCourse()" id="frmCreateCourse">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="box box-info" style="background: #a0e0ed;">
					<div class="box-header with-border">
						<h3 class="box-title">Course Details</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="txtCourseName">Course Name</label>
									<input type="text" class="form-control" name="txtCourseName" id="txtCourseName" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtCourseAbbr">Course Abbreviation</label>
									<input type="text" class="form-control" name="txtCourseAbbr" id="txtCourseAbbr" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="txtCourseNotes">Notes</label>
									<textarea class="form-control" name="txtCourseNotes" id="txtCourseNotes"></textarea>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<center><button class="btn btn-md btn-primary" >Create Course</button><span id="testres"></span></center>
<br>
				<div class="box box-success" id="courseList" style="background-color: #96eba6;">
					<div class="box-header with-border">
						<h3 class="box-title">Course List</h3>
					</div>
					<div class="box-body w3-allerta" id="boxResult">

					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<!--/.col (left) -->
		</div>
		<!-- /.row -->
	</form>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php include '_footer.php'; ?>
<script type="text/javascript">
	$(function(){
		loadWithPage('courselist');
	});
</script>