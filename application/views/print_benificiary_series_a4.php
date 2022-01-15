<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
	table{
		font-family: arial;
		font-size: 11px
	}
</style>

<?php
 $cnt = 0;
 foreach ($beneficiaries as $beneficiary) {
 	$cnt++;
 ?>
<table style=" border-radius:3px;width: 340px;margin-top:72px;margin-left:23px;<?php if( ($cnt % 2) !=0 ){echo 'margin-right: 50px;';} ?> float:left;height: 350px; max-height: 350px">
	<tr>
		<td>ID Number</td>
		<td>: <span style="font-weight: bold; font-size: 16px"><?php echo $beneficiary->old_id; ?></span></td>
	</tr>
	<tr>
		<td>Member Name</td>
		<td>: <?php echo $beneficiary->guardian_name; ?></td>
	</tr>
	<tr>
		<td>Member ID</td>
		<td>: <?php echo $beneficiary->share_member_id; ?></td>
	</tr>
	<tr>
		<td valign="top">Address</td>
		<td valign="top"><div style="float:left;margin-left: 5px"><?php echo $beneficiary->permanent_address; ?></div></td>
	</tr>
	<tr>
		<td>Education Forum</td>
		<td>: <?php echo ucwords($beneficiary->education_forum); ?></td>
	</tr>
	<tr>
		<td>Family Unit Number </td>
		<td>: <?php echo $beneficiary->bcc_number; ?> | Family Unit Name : <?php echo $beneficiary->bcc_name; ?></td>
	</tr>
	<tr><td colspan="2"><hr></td></tr>
	<tr>
		<td>Beneficiary Name</td>
		<td>: <?php echo $beneficiary->name; ?></td>
	</tr>
<!-- 	<tr>
		<td>Date Of Birth</td>
		<td>: <?php echo $beneficiary->dob; ?></td>
	</tr> -->
	<tr>
		<td valign="top">Address</td>
		<td valign="top"><div style="float:left;margin-left: 5px"><?php echo ucwords($beneficiary->permanent_address); ?></span></td>
	</tr>
	<tr>
		<td>Relationship with the Member </td>
		<td>: <?php echo $beneficiary->guardian_relation; ?></td>
	</tr>
	<tr><td colspan="2"><hr></td></tr>
	<tr>
		<td>Nominee Name</td>
		<td>: <?php echo $beneficiary->nominee_name; ?></td>
	</tr>
	<tr>
		<td valign="top">Address</td>
		<td valign="top"><div style="float:left;margin-left: 5px"><?php echo $beneficiary->temporary_address; ?></div></td>
	</tr>
	<tr>
		<td>Relationship with the Member </td>
		<td>: <?php echo $beneficiary->nominee_relation; ?></td>
	</tr>
	<tr><td colspan="2"><hr>
		For Office Use:<br><br>
		Approved by : Director / Office Manager
	</td></tr>
</table>
<?php if (($cnt % 2) == 0){ ?>
<br clear="all">
<?php
}
if (($cnt % 6) == 0){ ?>
<p style="page-break-after: always;">&nbsp;</p>
<?php
 }}
?>

<script type="text/javascript">
  //window.print();
</script>
