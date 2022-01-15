<?php
 // Forum Select
if ($show == 'eduforum_select') {
    echo "<option value=''>";
    foreach ($eduforum->result() as $row) { ?>
<option value="<?php echo $row->eduforum; ?>"><?php echo ucwords($row->eduforum); ?>
</option>
<?php
}
}

// Search Suggest
if ($show == 'search_suggest') { ?>
<img style="cursor:pointer;position: fixed;margin-left: 465px;margin-top: -5px;"
	onclick="$('#searchSuggest').html('');$('#searchSuggest').css('display','none');"
	src="http://192.168.2.101/light/assets/images/close_button.png">
<table class="table table-bordered table-hover dataTable table-condensed w3-allerta" style="background: #c0e4ec">
	<tbody>
		<tr>
			<th style="width: 10px">ID</th>
			<th>Name</th>
			<th>Guardian

			</th>
		</tr>

		<?php foreach ($searchResult->result() as $row) { ?>
		<tr style="cursor: pointer;" <?php if ($opt != 'add') { ?>
			onclick="viewBeneficiary('<?php echo $row->id; ?>')"
			<?php } else { ?>
			onclick="addBenToForm('<?php echo $row->id; ?>')"
			<?php } ?> >
			<td><?php echo $row->old_id; ?>
			</td>
			<td><?php echo ucwords($row->name); ?>
			</td>
			<td><?php echo ucwords($row->guardian_name); ?>
			</td>
		</tr>

		<?php } ?>
	</tbody>
</table>
<?php
}
if ($show == 'search_suggest_elg') { ?>
<img style="cursor:pointer;position: fixed;margin-left: 465px;margin-top: -5px;"
	onclick="$('#searchSuggest').html('');$('#searchSuggest').css('display','none');"
	src="http://192.168.2.101/light/assets/images/close_button.png">
<table class="table table-bordered table-hover dataTable table-condensed w3-allerta" style="background: #c0e4ec">
	<tbody>
		<tr>
			<th style="width: 10px">ID</th>
			<th>Beneficary</th>
			<th>Guardian

			</th>
		</tr>

		<?php foreach ($searchResult->result() as $row) { ?>
		<tr style="cursor: pointer;"
			onclick="viewBeneficiaryPayments('<?php echo $row->old_id; ?>')">
			<td><?php echo $row->old_id; ?>
			</td>
			<td><?php echo ucwords($row->beneficary); ?>
			</td>
			<td><?php echo ucwords($row->guardian); ?>
			</td>
		</tr>

		<?php } ?>
	</tbody>
</table>
<?php
}
// Search Suggest
if ($show == 'adv_search_suggest') {
    ?>

<table class="table table-bordered table-hover dataTable table-condensed w3-allerta" style="background: #fc0e4ecff">
	<tbody>
		<thead>
			<tr>
				<th style="width: 10px">ID</th>
				<th>Name</th>
				<th>Guardian</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>

		<?php foreach ($searchResult->result() as $row) { ?>
		<tr id="close<?php echo $row->old_id; ?>">
			<td><?php echo $row->old_id; ?>
			</td>
			<td><?php echo ucwords($row->name); if ($row->status == 'closed') {
        echo ' <small class="pull-right label bg-red">Closed</label>';
    }?>
			</td>
			<td><?php echo ucwords($row->guardian_name); ?>
			</td>
			<td class="text-center">
				<?php if ($ref == 'nidhicloseaccount') { ?>
				<span class="btn btn-danger btn-xs"
					onclick="closeAccount('<?php echo $row->old_id; ?>')">Close
					Account</span>
				<?php } elseif (isset($nidhiBen)) { ?>
				<span class="btn btn-primary btn-xs"
					onclick="addToNidhiBen('<?php echo $row->old_id; ?>')">Add
					to Form</span>
				<?php } elseif (isset($nidhiGuard)) {
        if ($row->status != 'closed') { ?>
				<span class="btn btn-primary btn-xs"
					onclick="createNewGuardian('<?php echo $row->old_id; ?>')">Add
					to New Guardian</span>
				<?php }
    } else { ?>
				<span class="btn btn-primary btn-xs"
					onclick="viewProfile('<?php echo $row->id; ?>')">View
					Profile</span>
				<?php if ($row->share_member_id != '') { ?>
				<span class="btn btn-xs w3-allerta" style="background:#c0e4ec; color:#fff"
					onclick="editGuardian('<?php echo $row->share_member_id; ?>')">Edit
					Guardian</span>
				<?php } ?>
				<?php } ?>
			</td>
		</tr>

		<?php } ?>
	</tbody>
</table>
// Search Suggest
<?php
}
// Search Suggest Passbook Prining
if ($show == 'adv_search_suggest_passbook') { ?>
<table class="table table-bordered table-hover dataTable table-condensed w3-allerta" style="background: #c0e4ec">
	<tbody>
		<thead>
			<tr>
				<th style="width: 10px">ID</th>
				<th>Name</th>
				<th>Guardian</th>
				<th> </th>
			</tr>
		</thead>

		<?php foreach ($searchResult->result() as $row) { ?>
		<tr>
			<td><?php echo $row->old_id; ?>
			</td>
			<td><?php echo ucwords($row->name); ?>
			</td>
			<td><?php echo ucwords($row->guardian_name); ?>
			</td>
			<td><span class="btn btn-primary btn-xs"
					onclick="addToPassbookPrintQueue('<?php echo $row->old_id; ?>')">Add
					to Print Queue</span></td>
		</tr>

		<?php } ?>
	</tbody>
</table>
// Search Suggest
<?php }



if ($show == 'adv_search_suggest_donor') { ?>
<table class="table table-bordered table-hover dataTable table-condensed w3-allerta" style="background: #fff">
	<tbody>
		<thead>
			<tr>
				<th style="width: 10px">ID</th>
				<th>Donor</th>
				<th>Education Forum</th>
				<th>Amount</th>
				<th></th>
			</tr>
		</thead>

		<?php foreach ($searchResult->result() as $row) { ?>
		<tr>
			<td><?php echo $row->id; ?>
			</td>
			<td><?php echo ucwords($row->donor); ?>
			</td>
			<td><?php echo ucwords($row->edu_forum); ?>
			</td>
			<td><?php echo ucwords($row->amount); ?>
			</td>
			<td><span class="btn btn-primary btn-xs"
					onclick="viewDonorProfile('<?php echo $row->id; ?>')">View
					Profile</span></td>
		</tr>

		<?php } ?>
	</tbody>
</table>
<?php
}
// Qualification Suggest
if ($show == 'qualification_suggest') { ?>
<table class="table table-bordered table-hover dataTable table-condensed" style="background: #fff">
	<tbody>
		<tr>
			<th>Course</th>
			<th>Abbr</th>
		</tr>

		<?php foreach ($searchResult->result() as $row) { ?>
		<tr style="cursor: pointer;"
			onclick="addQualification('<?php echo $row->abbr; ?>')">
			<td><?php echo $row->course; ?>
			</td>
			<td><?php echo $row->abbr; ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php
}

if ($show == 'course_list') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th>Course Name</th>
		<th>Course Abbreviation</th>
		<th>Notes</th>
		<th style="text-align: center;">Action</th>
	</tr>
	<?php foreach ($courses->result() as $course) { ?>
	<tr id="row<?php echo $course->id;?>">
		<td data-fieldname="course"><?php echo $course->course;?>
		</td>
		<td data-fieldname="abbr"><?php echo $course->abbr;?>
		</td>
		<td data-fieldname="notes"><?php echo $course->notes;?>
		</td>
		<td style="text-align: center;" data-exclude="exclude" class="btn-action">
			<i class="fa fa-edit"
				onclick="editRow('<?php echo $course->id;?>')"
				title="Edit Course"
				id="editR<?php echo $course->id;?>"></i>
			<i class="fa fa-check"
				onclick="saveRow('<?php echo $course->id;?>','course')"
				title="Save Course"
				id="saveR<?php echo $course->id;?>"
				style="display: none;"></i>
			<i class="fa fa-close" title="Delete Course"></i>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } if ($show == 'course_list_scholar') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th>Course Name</th>
		<th>Course Abbreviation</th>
		<th style="text-align: center;">Action</th>
	</tr>
	<tr id="newCourseEntry">
		<td data-fieldname="newCourse"><input class="form-control" value="" id="newCourse" name="newCourse" type="text">
		</td>
		<td data-fieldname="newPoint"><input class="form-control" value="" id="newPoint" name="newPoint" type="text">
		</td>
		<td style="text-align: center;" data-exclude="exclude" class="btn-action">
			<i class="fa fa-check" onclick="addRowCourse()" title="Add Course" style=""></i>
		</td>
	</tr>
	<?php foreach ($courses->result() as $course) { ?>
	<tr id="row<?php echo $course->id;?>">
		<td data-fieldname="course"><?php echo $course->course;?>
		</td>
		<td data-fieldname="abbr"><?php echo $course->points;?>
		</td>
		<td style="text-align: center;" data-exclude="exclude" class="btn-action">
			<i class="fa fa-edit"
				onclick="editRow('<?php echo $course->id;?>')"
				title="Edit Course"
				id="editR<?php echo $course->id;?>"></i>
			<i class="fa fa-check"
				onclick="saveRow('<?php echo $course->id;?>','scholarship')"
				title="Save Course"
				id="saveR<?php echo $course->id;?>"
				style="display: none;"></i>
			<i class="fa fa-close"
				onclick="deleteRow('<?php echo $course->id;?>','scholarship')"
				title="Delete Course"></i>
		</td>
	</tr>
	<?php } ?>
</table>
<?php }

if ($show == 'batch_list') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th>Course Name</th>
		<th>Batch</th>
		<th>Notes</th>
		<th style="text-align: center;">Action</th>
	</tr>
	<?php foreach ($Batches->result() as $batch) { ?>
	<tr id="row<?php echo $batch->id;?>">
		<td data-fieldname="course" data-exclude="exclude"><?php echo $batch->course;?>
		</td>
		<td data-fieldname="year_span"><?php echo $batch->year_span;?>
		</td>
		<td data-fieldname="notes"><?php echo $batch->notes;?>
		</td>
		<td style="text-align: center;" data-exclude="exclude" class="btn-action">
			<i class="fa fa-edit"
				onclick="editRow('<?php echo $batch->id;?>')"
				title="Edit Course"
				id="editR<?php echo $batch->id;?>"></i>
			<i class="fa fa-check"
				onclick="saveRow('<?php echo $batch->id;?>','batch')"
				title="Save Course"
				id="saveR<?php echo $batch->id;?>"
				style="display: none;"></i>
			<i class="fa fa-close" title="Delete Batch"
				onclick="deleteRow('<?php echo $batch->id;?>','batch')"></i>
		</td>
	</tr>
	<?php } ?>
</table>
<?php }

if ($show == 'candidatelist') { ?>
<table id="tableExam" class="table table-bordered table-striped table-condensed table-hover dataTable w3-allerta"
	role="grid">
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
			<?php
        $cnt = 0;
        foreach ($candidates->result() as $candidate) {
            $cnt++; ?>
			<tr id="<?php echo $candidate->id; ?>">
				<td><?php echo $cnt; ?>
				</td>
				<td><?php echo $candidate->generated_id; ?>
				</td>
				<td><?php echo $candidate->nes_id; ?>
				</td>
				<td><?php echo $candidate->student_name; ?>
				</td>
				<td><?php echo $candidate->guardian; ?>
				</td>
				<td><?php echo $candidate->gender; ?>
				</td>
				<td><?php echo $candidate->school; ?>
				</td>
				<td><?php echo $candidate->medium; ?>
				</td>
				<td><?php echo $candidate->syllabus; ?>
				</td>
				<td><?php echo $candidate->education_forum; ?>
				</td>
				<td><?php echo $candidate->bcc_number; ?>
				</td>
				<td><?php echo $candidate->bcc_name; ?>
				</td>
				<td><?php echo $candidate->phone; ?>
				</td>
				<td><?php echo $candidate->receipt; ?>
				</td>
				<td><?php echo $candidate->status; ?>
				</td>
			</tr>
			<?php
        } ?>
		</tbody>
</table>
<?php
}


if ($show == 'scholarshiplist') { ?>
<table id="tableExam" class="table table-bordered table-striped table-condensed table-hover dataTable w3-allerta"
	role="grid">
	<thead>
		<tr>
			<th>Si No</th>
			<th>Appl No</th>
			<th>Batch ID</th>
			<th>NES ID</th>
			<th>Name</th>
			<!-- <th>Guardain</th> -->
			<!-- <th>Gender</th> -->
			<th>Course</th>
			<th>Education Forun</th>
			<!-- <th>Phone</th> -->
			<!-- <th>Phone Secondry</th> -->
			<th>Status</th>
			<th>Special Points</th>
			<th>TotalPoints</th>
			<th>Amount</th>
			<th>Edit Amt</th>

		</tr>
		<thead>
		<tbody>
			<?php
        $cnt = 0;
        foreach ($scholarship->result() as $ship) {
            $cnt++; ?>
			<tr id="<?php echo $ship->id; ?>">
				<td><?php echo $cnt; ?>
				</td>
				<td><?php echo $ship->app_num; ?>
				</td>
				<td><?php echo $ship->generated_id; ?>
				</td>
				<td><?php echo $ship->nes_id; ?>
				</td>
				<td><?php echo $ship->name; ?>
				</td>
				<!-- <td><?php echo $ship->gauardain; ?>
				</td> -->
				<!-- <td><?php  if ($ship->gender == 1) {
                echo 'Male';
            } else {
                echo 'Female';
            } ?>
				</td> -->
				<td><?php echo $ship->course_text; ?>
				</td>
				<td><?php echo ucwords($ship->edu_forum); ?>
				</td>
				<!-- <td><?php echo $ship->phone; ?>
				</td> -->
				<!-- <td><?php echo $ship->phone_sec; ?>
				</td> -->
				<td><?php echo $ship->status; ?>
				</td>
				<td style="white-space: nowrap;">
					<?php if ($ship->special_points == 0) { ?>
					<input style="width: 30px" type="text"
						name="txtSplPt<?php echo $ship->id;?>"
						id="txtSplPt<?php echo $ship->id;?>"> <span
						class="btn btn-xs btn-primary"
						onclick="updateSpecialPoints('txtSplPt<?php echo $ship->id;?>')"
						id="btntxtSplPt<?php echo $ship->id;?>">update</span>
					<?php } else {
                echo $ship->special_points;
            } ?>
				</td>
				<td id="tpoints<?php echo $ship->id; ?>"><?php echo $ship->points; ?>
				</td>
				<td id="tpoints<?php echo $ship->id; ?>"><?php echo $ship->amount_recived; ?>
				</td>
				<td class="text-right">
					<input style="width: 70px" type="text"
						name="txtAmt<?php echo $ship->id; ?>"
						id="txtAmt<?php echo $ship->id; ?>"
						value="<?php echo $ship->amount_recived; ?>">
					<span class="btn btn-xs btn-primary"
						onclick="updateScolAmt('txtAmt<?php echo $ship->id; ?>')"
						id="btnAmt<?php echo $ship->id; ?>">update</span>
				</td>
			</tr>
			<?php
        } ?>
		</tbody>
</table>
<?php
}

if ($show == 'scholarshiplistcoursewise') { ?>
<table style="font-size:18px" id="tableExam"
	class="table table-bordered table-striped table-condensed table-hover dataTable w3-allerta" role="grid">
	<thead>
		<tr>
			<th>Course</th>
			<th>Count</th>
		</tr>
		<thead>
		<tbody>
			<?php
        $cnt = 0;
        $total = 0;
        foreach ($scholarship->result() as $ship) {
            $cnt++;
            $total = $total + $ship->count; ?>
			<tr>
				<td><?php echo $ship->course_text; ?>
				</td>
				<td><?php echo $ship->count; ?>
				</td>
			</tr>
			<?php
        } ?>
			<tr>
				<th>Total</th>
				<th><?php echo $total; ?>
				</th>
			</tr>
		</tbody>
</table>
<?php
}
if ($show == 'scholarshipfilterforumwise') { ?>
<table style="font-size:18px" id="tableExam"
	class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<thead>
		<tr>
			<th>Forane</th>
			<th>Education Forum</th>
			<th>Count</th>
		</tr>
		<thead>
		<tbody>
			<?php
        $cnt = 0;
        $total = 0;
        foreach ($scholarship->result() as $ship) {
            $cnt++;
            $total = $total + $ship->count; ?>
			<tr>
				<td><?php echo $ship->forane; ?>
				</td>
				<td><?php echo $ship->edu_forum; ?>
				</td>
				<td><?php echo $ship->count; ?>
				</td>
			</tr>
			<?php
        } ?>
		</tbody>
</table>
<table class="table table-bordered table-striped table-condensed table-hover dataTable">
	<tbody>
		<tr>
			<th style="text-align:center">Total</th>
			<th style="text-align:center"><?php echo $total; ?>
			</th>
		</tr>
	</tbody>
</table>
<?php
}
if ($show == 'beneficarylist') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th>Si No</th>
		<th>NES ID</th>
		<th>Name</th>
		<th>Date Of Birth</th>
		<th>Gender</th>
		<th>School</th>
		<th>Medium</th>
		<th>Syllabus</th>
		<th>Guardain</th>
		<th>Education Forun</th>
		<th>BCC Number</th>
		<th>BCC Name</th>
		<th>Phone</th>
		<th>Receipt Number</th>
	</tr>
	<?php
        $cnt = 0;
        foreach ($candidates->result() as $candidate) {
            $cnt++; ?>
	<tr id="<?php echo $candidate->id; ?>">
		<td><?php echo $cnt; ?>
		</td>
		<td><?php echo $candidate->old_id; ?>
		</td>
		<td><?php echo $candidate->name; ?>
		</td>
		<td><?php echo $candidate->dob; ?>
		</td>
		<td><?php echo $candidate->gender; ?>
		</td>
		<td><?php echo $candidate->school; ?>
		</td>
		<td><?php echo $candidate->medium; ?>
		</td>
		<td><?php echo $candidate->syllabus; ?>
		</td>
		<td><?php echo $candidate->guardian_name; ?>
		</td>
		<td><?php echo $candidate->education_forum; ?>
		</td>
		<td><?php echo $candidate->bcc_number; ?>
		</td>
		<td><?php echo $candidate->bcc_name; ?>
		</td>
		<td><?php echo $candidate->phone; ?>
		</td>
		<td><?php echo $candidate->receipt_number; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php
}

if ($show == 'forumwiseAggregate') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th>Si No</th>
		<th>Education Forun</th>
		<th style="text-align: center;" align="center">Count</th>
		<th style="text-align: center;" align="center">Forane ID</th>
		<th>Forane</th>
	</tr>
	<?php
        $cnt = 0;
        $total = 0;
        foreach ($list->result() as $candidate) {
            $cnt++;
            $total += $candidate->count; ?>
	<tr>
		<td><?php echo $cnt; ?>
		</td>
		<td><?php echo ucwords($candidate->education_forum); ?>
		</td>
		<td align="center"><?php echo $candidate->count; ?>
		</td>
		<td align="center"><?php echo $candidate->fid; ?>
		</td>
		<td><?php echo ucwords($candidate->forane); ?>
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
<?php
}

if ($show == 'search_suggestappl') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable w3-allerta"
	role="grid" style="background: #fff">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Education Forum</th>
		<th>Course ID</th>
	</tr>
	<?php
        foreach ($candidates->result() as $candidate) {
            ?>
	<tr id="<?php echo $candidate->id; ?>"
		onclick="addApplToForm('<?php echo $candidate->id; ?>')"
		style="cursor: pointer;">
		<td><?php echo $candidate->id; ?>
		</td>
		<td><?php echo $candidate->student_name; ?>
		</td>
		<td><?php echo $candidate->education_forum; ?>
		</td>
		<td><?php echo $candidate->generated_id; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php }

 if ($show == 'search_suggestfilter') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid"
	style="background: #fff">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Education Forum</th>
		<th>Course ID</th>
	</tr>
	<?php
        foreach ($candidates->result() as $candidate) {
            ?>
	<tr id="<?php echo $candidate->id; ?>"
		onclick="addEditToForm('<?php echo $candidate->id; ?>')"
		style="cursor: pointer;">
		<td><?php echo $candidate->id; ?>
		</td>
		<td><?php echo $candidate->student_name; ?>
		</td>
		<td><?php echo $candidate->education_forum; ?>
		</td>
		<td><?php echo $candidate->generated_id; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>

<?php }

  if ($show == 'search_suggest_cert_ack') { ?>
<style>
	#searchSuggest {
		width: 650px !important
	}
</style>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid"
	style="background: #fff">
	<tr>
		<th>ID</th>
		<th>Beneficary ID</th>
		<th>Beneficary</th>
		<th>Guardain</th>
		<th>Education Forum</th>
		<th>Action</th>
	</tr>
	<?php
        foreach ($searchResult as $sharecert) {
            ?>
	<tr>
		<td><?php echo $sharecert->id; ?>
		</td>
		<td><?php echo $sharecert->holder_id; ?>
		</td>
		<td><?php echo $sharecert->name; ?>
		</td>
		<td><b><?php echo $sharecert->guardian_name; ?></b></td>
		<td><?php echo $sharecert->education_forum; ?>
		</td>
		<td><button
				onclick="addToCertAck('<?php echo $sharecert->id; ?>')"
				type="button" class="btn btn-primary btn-xs">Acknowledge</button></td>
	</tr>
	<?php
        } ?>
</table>
<?php }

     if ($show == 'certack_export') { ?>
<style>
	#searchSuggest {
		width: 650px !important
	}
</style>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid"
	style="background: #fff">
	<tr>
		<th>Si No</th>
		<th>ID</th>
		<th>Ack Date</th>
		<th>Beneficary ID</th>
		<th>Member ID</th>
		<th>Beneficary</th>
		<th>Guardain</th>
		<th>Education Forum</th>
		<th class="text-center">x</th>
	</tr>
	<?php
            $cnt = 1;
        foreach ($searchResult as $sharecert) {
            ?>
	<tr id="<?php echo $sharecert->holder_id; ?>">
		<td><?php echo $cnt++; ?>
		</td>
		<td><?php echo $sharecert->id; ?>
		</td>
		<td><?php echo $sharecert->ack_date; ?>
		</td>
		<td><?php echo $sharecert->holder_id; ?>
		</td>
		<td><?php echo $sharecert->share_member_id; ?>
		</td>
		<td><?php echo $sharecert->name; ?>
		</td>
		<td><?php echo $sharecert->guardian_name; ?>
		</td>
		<td><?php echo $sharecert->education_forum; ?>
		</td>
		<td class="text-center"><span
				onclick="removeFromAck('<?php echo $sharecert->holder_id; ?>')"
				class="btn btn-danger btn-xs" title="Remove this entry from Acknowledgement Lsit">X</span></td>
	</tr>
	<?php
        } ?>
</table>
<?php }


 if ($show == 'examResults') {
     $res = $exresults->result();

     if (count($res) == 0) {
         exit('No exams available for this batch');
     }

     $markhead = json_decode($res{0}->marks, true);
     $temp = '';
     foreach ($markhead as $key => $value) {
         $temp.= '<th>'.ucwords(str_replace('sub-', '', $key)).'</th>';
     } ?>
<span id="btnEditMarks" style="float: right; cursor: pointer;color: #00A65A" onclick="editIntervewmarks()"><i
		class="fa fa-edit"></i> Edit Marks</span>
<table id="tableExam" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid"
	style="background: #fff">
	<thead>
		<tr>
			<th>Si.No</th>
			<th>ID</th>
			<th>Student Name</th>
			<th>Phone</th>
			<?php echo $temp; ?>
			<th>Total</th>
			<th>Rank</th>
			<th>Percentage</th>
		</tr>
	</thead>
	<tbody>
		<?php
        $rcnt = 0;
     $ids = array();
     foreach ($res as $result) {
         $temp = '';
         $markhead = json_decode($result->marks, true);
         $rcnt++;
         $ids[] = $result->candidate_id;
         foreach ($markhead as $key => $value) {
             $temp.= '<td>'.ucwords($value).'</td>';
         } ?>
		<tr>
			<td><?php echo $rcnt; ?>
			</td>
			<td><?php echo $result->candidate_id; ?>
			</td>
			<td><?php echo $result->student_name; ?>
			</td>
			<td><?php echo $result->phone; ?>
			</td>
			<?php echo $temp; ?>
			<td><?php echo $result->total; ?>
			</td>
			<td><?php echo $result->rank; ?>
			</td>
			<td id="sp<?php echo $result->candidate_id; ?>"><?php echo $result->percentage; ?>
			</td>
		</tr>
		<?php
     } ?>
	</tbody>
</table>
<?php
 }

 if ($show == 'interviewCandidates' || $show == 'students') {
     $res = $exresults->result();

     if (count($res) == 0) {
         exit('No exams available for this batch');
     }

     $markhead = json_decode($res{0}->marks, true);
     $temp = '';
     foreach ($markhead as $key => $value) {
         $temp.= '<th>'.ucwords(str_replace('sub-', '', $key)).'</th>';
     }

     if ($show !='students') {
         ?>

<span id="btnEditMarks" style="float: right; cursor: pointer;color: #00A65A" onclick="editIntervewmarks()"><i
		class="fa fa-edit"></i> Edit Marks</span>
<?php
     } ?>
<table id="tableExam" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid"
	style="background: #fff">
	<thead>
		<tr>
			<th>Si.No</th>
			<th>ID</th>
			<th>Student Name</th>
			<th>Phone</th>
			<?php echo $temp; ?>
			<th>Total</th>
			<th>Rank</th>
			<th>Percentage</th>
			<th>Interview Marks</th>
			<th>Total Marks</th>
		</tr>
	</thead>
	<tbody>
		<?php
        $rcnt = 0;
     $ids = array();
     foreach ($res as $result) {
         $temp = '';
         $markhead = json_decode($result->marks, true);
         $rcnt++;
         $ids[] = $result->candidate_id;
         foreach ($markhead as $key => $value) {
             $temp.= '<td>'.ucwords($value).'</td>';
         } ?>
		<tr>
			<td><?php echo $rcnt; ?>
			</td>
			<td><?php echo $result->candidate_id; ?>
			</td>
			<td><?php echo $result->student_name; ?>
			</td>
			<td><?php echo $result->phone; ?>
			</td>
			<?php echo $temp; ?>
			<td><?php echo $result->total; ?>
			</td>
			<td><?php echo $result->rank; ?>
			</td>
			<td id="sp<?php echo $result->candidate_id; ?>"><?php echo $result->percentage; ?>
			</td>
			<td align="center">
				<?php if ($show !='students') { ?>
				<input type="text"
					id="txtInt<?php echo $result->candidate_id; ?>"
					name="txtInt<?php echo $result->candidate_id; ?>"
					style="width:100px"
					value="<?php echo $result->interview; ?>"
					onkeyup="calulateTotalMarks('<?php echo $result->candidate_id; ?>')"
					readonly>
				<?php } else {
             echo $result->interview;
         } ?>
			</td>
			<td align="center">
				<?php if ($show !='students') { ?>
				<input type="text"
					id="txtTot<?php echo $result->candidate_id; ?>"
					name="txtTot<?php echo $result->candidate_id; ?>"
					style="width:100px"
					value="<?php echo $result->grand_total; ?>"
					readonly>
				<?php } else {
             echo $result->grand_total;
         } ?>
			</td>
		</tr>
		<?php
     } ?>
	</tbody>
</table>
<br>
<input type="hidden"
	value="<?php echo implode(',', $ids); ?>"
	name="ids" id="ids">
<?php if ($show !='students') { ?>
<center><button class="btn btn-primary" onclick="updateInterviewMarks()"> Update Marks</button></center>
<?php }
 }

if ($show == 'donations') {
    ?>
<table class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid"
	style="background: #fff">
	<thead>
		<tr>
			<th></th>
			<th>Voucher Number</th>
			<th>Narration</th>
			<th>Ledger Name</th>
			<th>Transaction Date</th>
			<th>amount</th>
		</tr>
	</thead>
	<tbody>
		<?php
     $total = 0;
    foreach ($donations as $donation) {
        $total += abs($donation->amount); ?>
		<tr
			id="<?php echo $donation->voucher_number.$donation->transaction_date; ?>">
			<td class="text-center"
				onclick="removeCorpTrans('<?php echo $donation->voucher_number; ?>','<?php echo $donation->transaction_date; ?>','<?php echo $donation->corp_id; ?>')">
				<div class="deleteBox">x</div>
			</td>
			<td class="text-center"><?php echo $donation->voucher_number; ?>
			</td>
			<td><?php echo $donation->narration; ?>
			</td>
			<td class="text-center"><?php echo $donation->ledger_name; ?>
			</td>
			<td class="text-center"><?php echo $donation->transaction_date; ?>
			</td>
			<td class="text-right"><?php echo $donation->amount; ?>
			</td>
		</tr>
		<?php
    } ?>
	<tfoot>
		<tr>
			<th colspan="5" class="text-right">Total </th>
			<th class="text-right"><?php echo number_format($total, 2, '.', ''); ?>
			</th>
		</tr>
	</tfoot>
	</tbody>
</table>
<?php
}

if ($show == 'campEdit') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th>Si No</th>
		<th>Batch ID</th>
		<th>NES ID</th>
		<th>Name</th>
		<th>Gender</th>
		<th>Phone</th>
		<th>Camp</th>
	</tr>
	<?php
        $cnt = 0;
        foreach ($candidates->result() as $candidate) {
            $cnt++; ?>
	<tr id="<?php echo $candidate->id; ?>">
		<td><?php echo $cnt; ?>
		</td>
		<td><?php echo $candidate->generated_id; ?>
		</td>
		<td><?php echo $candidate->nes_id; ?>
		</td>
		<td><?php echo $candidate->student_name; ?>
		</td>
		<td><?php echo $candidate->gender; ?>
		</td>
		<td><?php echo $candidate->phone; ?>
		</td>
		<td align="center" width="1%"><input type="text"
				id="txtCamp<?php echo $candidate->id; ?>"
				name="txtCamp<?php echo $candidate->id; ?>"
				style="width:20px;text-transform: capitalize;"
				value="<?php echo $candidate->camp; ?>"></td>
	</tr>
	<?php
        } ?>
</table>
<?php
}

if ($show == 'shareMemberList') { ?>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th class="text-center">Si No</th>
		<th class="text-center">Membership ID</th>
		<th class="text-left">Member Name</th>
		<th class="text-center">Beneficiary ID</th>
		<th class="text-center">Beneficiary Name</th>
		<th class="text-center">Share Allotted</th>
		<th class="text-center">No of Shares</th>
		<th class="text-center">Certificate No</th>
		<th class="text-center">Issue Date</th>
		<th class="text-center">Forane</th>
		<th class="text-center">Education Forum</th>
		<th class="text-center">Print</th>
	</tr>
	<?php
        $cnt = 0;
        foreach ($shares as $share) {
            $cnt++; ?>
	<tr id="<?php echo $share->membership_id; ?>">
		<td class="text-center"><?php echo $cnt; ?>
		</td>
		<td class="text-center"><?php echo $share->membership_id; ?>
		</td>
		<td class="text-left"><?php echo $share->member_name; ?>
		</td>
		<td class="text-center"><?php echo $share->holder_id; ?>
		</td>
		<td class="text-center"><?php echo $share->name; ?>
		</td>
		<td class="text-center"><?php echo $share->share_id; ?>
		</td>
		<td class="text-center"><?php echo $share->share_count; ?>
		</td>
		<td class="text-center"><?php echo $share->certificate_number; ?>
		</td>
		<td class="text-center"><?php echo $share->issue_date; ?>
		</td>
		<td class="text-center"><?php echo $share->forane; ?>
		</td>
		<td class="text-center"><?php echo $share->education_forum; ?>
		</td>
		<td class="text-center"><a class="btn btn-primary btn-xs"
				href="<?php echo base_url(); ?>share/sharecertificate/<?php echo $share->certificate_number; ?>"
				target="_blank">Print Cerificate</a></td>
	</tr>
	<?php
        } ?>
</table>
<?php }

if ($show == 'share_list') { ?>
<h4>Existing Shares associated with this Beneficiary</h4>
<table id="tableCourses" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th class="text-center">Si No</th>
		<th class="text-center">Certificate ID</th>
		<th class="text-center">Member ID</th>
		<th class="text-center">Benificiary ID</th>
		<th class="text-center">Share ID</th>
		<th class="text-center">Share Count</th>
		<th class="text-center">Issue Date</th>
	</tr>
	<?php
        $cnt = 0;
        foreach ($shares as $share) {
            $cnt++; ?>
	<tr class="memberShareExists" id="<?php echo $share->id; ?>">
		<td class="text-center"><?php echo $cnt; ?>
		</td>
		<td class="text-center"><?php echo $share->id; ?>
		</td>
		<td class="text-center"><?php echo $share->member_id; ?>
		</td>
		<td class="text-center"><?php echo $share->holder_id; ?>
		</td>
		<td class="text-center"><?php echo $share->share_id; ?>
		</td>
		<td class="text-center"><?php echo $share->share_count; ?>
		</td>
		<td class="text-center"><?php echo $share->issue_date; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php }

if ($show == 'scholarships') { ?>
<h4>Scholarships availed by this Beneficiary</h4>
<table id="tableScholarships"
	class="table table-bordered table-striped table-condensed table-hover dataTable w3-allerta" role="grid">
	<tr>
		<th class="text-center">12th Mark</th>
		<th class="text-center">Course</th>
		<th class="text-center">Perfomance</th>
		<th class="text-center">Regularity in Navadrasan</th>
		<th class="text-center">Membership Period</th>
		<th class="text-center">Enty Date</th>
	</tr>
	<?php
        $cnt = 0;
        foreach ($scholarships as $ship) {
            $cnt++; ?>
	<tr class="ScholarshipExists"
		id="SC<?php echo $ship->nes_id; ?>">
		<td class="text-center">
			<?php if ($cnt == 1) {?>
			<table class="table table-bordered table-striped table-condensed table-hover dataTable">
				<tr>
					<th>A+</th>
					<th>A</th>
					<th>B+</th>
					<th>B</th>
					<th>C+</th>
					<th>C</th>
					<th>D+</th>
					<th>D</th>
				</tr>
				<tr>
					<td><?php echo $ship->a1;?>
					</td>
					<td><?php echo $ship->a2;?>
					</td>
					<td><?php echo $ship->b1;?>
					</td>
					<td><?php echo $ship->b2;?>
					</td>
					<td><?php echo $ship->c1;?>
					</td>
					<td><?php echo $ship->c2;?>
					</td>
					<td><?php echo $ship->d1;?>
					</td>
					<td><?php echo $ship->d2;?>
					</td>
				</tr>
			</table>
			<input type="hidden" id="storedGender" name="storedGender"
				value="<?php echo $ship->gender;?>">
			<?php } ?>
		</td>
		<td class="text-center"><?php echo $ship->course_text; ?>
		</td>
		<td class="text-center"><?php echo $ship->performance; ?>
		</td>
		<td class="text-center"><?php echo $ship->nav_regularity; ?>
		</td>
		<td class="text-center"><?php echo $ship->membership_period; ?>
		</td>
		<td class="text-center"><?php echo $ship->entry_date; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php }

if ($show == 'scholarship_update') { ?>
<h4>Scholarships availed by this Beneficiary</h4>
<table id="tableScholarships" class="table table-bordered table-striped table-condensed table-hover dataTable"
	role="grid">
	<tr>
		<th class="text-left">Nes ID</th>
		<th class="text-left">Name</th>
		<th class="text-left">Education Forum</th>
		<th class="text-left">Course</th>
		<th class="text-right">Points</th>
		<th class="text-right">Amount Recived</th>
	</tr>
	<?php
        $cnt = 0;
        foreach ($scholarship as $ship) {
            $cnt++; ?>
	<tr class="ScholarshipExists"
		id="SC<?php echo $ship->nes_id; ?>">
		<td class="text-left"><?php echo $ship->nes_id; ?>
		</td>
		<td class="text-left"><?php echo $ship->name; ?>
		</td>
		<td class="text-left"><?php echo $ship->edu_forum; ?>
		</td>
		<td class="text-left"><?php echo $ship->course_text; ?>
		</td>
		<td class="text-right"><?php echo $ship->points; ?>
		</td>
		<td class="text-right"><?php echo $ship->amount_recived; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php }  ?>


<?php if ($show == 'scholarship_applicant') { ?>
<h4></h4>
<?php //print_r($payments);?>
<table id="tableScholarships" class="table table-bordered table-striped table-condensed table-hover dataTable"
	role="grid">
	<thead>
		<tr>
			<th class="text-left">Nes ID</th>
			<th class="text-left">Beneficary</th>
			<th class="text-left">guardian</th>
			<th class="text-left">Payment Type</th>
			<th class="text-right">Date</th>
			<th class="text-right">Voucher ID</th>
			<th class="text-right">Amount</th>
		</tr>
	</thead>
	<?php
        $cnt = 0;
        foreach ($payments as $item) {
            $cnt++; ?>
	<tr>
		<td class="text-left"><?php  echo $item->old_id; ?>
		</td>
		<td class="text-left"><?php  echo $item->beneficary; ?>
		</td>
		<td class="text-left"><?php  echo $item->guardian; ?>
		</td>
		<td class="text-left"><?php  echo $item->voucher_type; ?>
		</td>
		<td class="text-right"><?php echo $item->date; ?>
		</td>
		<td class="text-right"><?php echo $item->voucher_no; ?>
		</td>
		<td class="text-right"><?php echo $item->amount; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php }  ?>

<?php if ($show == 'new_nidhi_entry') { ?>
<table id="newNidhiEntry" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	<tr>
		<th class="text-left">Entry ID</th>
		<th class="text-left">Nes ID</th>
		<th class="text-left">Entry Date</th>
		<th class="text-left">Beneficary</th>
		<th class="text-left">Member guardian</th>
		<th class="text-left">Parent guardian</th>
		<th class="text-left">Education Forum</th>
		<th class="text-right">Nomnee</th>
		<th class="text-right">Member ID</th>
		<th class="text-right">Guardian Aadhar</th>
		<th class="text-right">Guardian PAN</th>
	</tr>
	<?php
        $cnt = 0;
        foreach ($results as $item) {
            $cnt++; ?>
	<tr>
		<td class="text-left"><?php  echo $item->id; ?>
		</td>
		<td class="text-left"><?php  echo $item->old_id; ?>
		</td>
		<td class="text-right"><?php echo $item->entry_date; ?>
		</td>
		<td class="text-left"><?php  echo $item->name; ?>
		</td>
		<td class="text-left"><?php  echo $item->guardian_name; ?>
		</td>
		<td class="text-left"><?php  echo $item->pguardain; ?>
		</td>
		<td class="text-right"><?php echo $item->education_forum; ?>
		</td>
		<td class="text-right"><?php echo $item->nominee_name; ?>
		</td>
		<td class="text-right"><?php echo $item->share_member_id; ?>
		</td>
		<td class="text-right"><?php echo $item->guardian_aadhar; ?>
		</td>
		<td class="text-right"><?php echo $item->pan_card; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php }  ?>

<?php if ($show == 'orphanCert') { ?>
<table id="tblOrphanCert" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid"
	style="width:50%">
	<tr>
		<th class="text-left">Missing from</th>
		<th class="text-left">Missing To</th>
	</tr>
	<?php

        $cnt = 0;
        foreach ($certs as $item) {
            $cnt++; ?>
	<tr>
		<td class="text-left"><?php  echo $item->gap_starts_at; ?>
		</td>
		<td class="text-left"><?php  echo $item->gap_ends_at; ?>
		</td>
	</tr>
	<?php
        } ?>
</table>
<?php }
