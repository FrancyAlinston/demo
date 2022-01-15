<div class="col-l-8" id="scolYearlyTran"></div>
<table class="table table-bordered table-striped table-responsive">
  <tr>
    <th>Name</th>
    <td><?php echo $scholarship->name; ?>
    </td>
    <th>Application ID</th>
    <td><?php echo $scholarship->generated_id; ?>
    </td>
  </tr>
  <tr>
    <th>Education Forum</th>
    <td><?php echo $scholarship->edu_forum; ?>
    </td>
    <th>Gauardain</th>
    <td><?php echo $scholarship->gauardain; ?>
    </td>
  </tr>
  <tr>
    <th>phone</th>
    <td><?php echo $scholarship->phone; ?>
    </td>
    <th>Status</th>
    <td><span style="color:<?php if ($scholarship->status == 'Fresh') {
    echo 'green';
} else {
    echo 'blue';
}; ?>"><?php echo $scholarship->status; ?></span></td>
  </tr>
  <tr>
    <th>Course</th>
    <td><?php echo $scholarship->course_text; ?> [ <?php echo $scholarship->specialisation; ?> ]</td>
    <th>Entry Date</th>
    <td><?php echo $scholarship->entry_date; ?>
    </td>
  </tr>
  <tr>
    <th>Institution Name</th>
    <td><?php echo $scholarship->institution; ?> [ <?php echo $scholarship->institution; ?> ]</td>
    <th>Nes ID</th>
    <td><?php echo $scholarship->nes_id; ?>
    </td>
  </tr>
</table>
<hr>
<h2>Uploaded Documents</h2>
<table class="table table-bordered table-striped table-responsive">
  <tr>
    <th>PlusTwo Marklist</th>
    <th>Course Certificate</th>
    <th>Marklist</th>
    <th>Rec Form</th>
  </tr>
  <tr style="cursor:pointer">
    <td
      onclick="loadScDoc('<?php echo $scholarship->plustwo_file; ?>')">
      <?php echo $scholarship->plustwo_file; ?>
    </td>
    <td
      onclick="loadScDoc('<?php echo $scholarship->coursecert_file; ?>')">
      <?php echo $scholarship->coursecert_file; ?>
    </td>
    <td
      onclick="loadScDoc('<?php echo $scholarship->marklist_file; ?>')">
      <?php echo $scholarship->marklist_file; ?>
    </td>
    <td
      onclick="loadScDoc('<?php echo $scholarship->recform_file; ?>','http://navadarsan.com/')">
      <?php echo $scholarship->recform_file; ?>
    </td>
  </tr>
</table>
<div id="scDocLoader" style="padding:5px;border:1px solid #ccc"></div><br>
<center>
  <span
    onclick="approveScholarship('<?php echo $scholarship->id; ?>')"
    class="btn btn-success btn-xs" action="approveScholarship="
    window.location.reload()"><strong>Approve</strong></span>

</center>
<script>
  getYearlyTransaction('<?php echo $scholarship->nes_id; ?>');
  // header('location:reload();');
</script>