<table id="tblTranHistory" class="table table-primary table-bordered table-hover table-responsive" style="width:100%">
<thead>
	<tr>
		<th>ID#</th>
		<th>Voucher#</th>
		<th>User</th>
		<th>Entry Date</th>
		<th>Transaction Date</th>
		<th>Ledger</th>
		<th>Type</th>
		<th>Account</th>
		<th>Narration</th>
		<th>Amount</th>
		<th class='deleteEntry'>Action</th>
	</tr>
</thead>
<tbody>
	<?php
	$sum = 0;
	foreach ($transactions as $tran) { ?>
	<tr id="acc<?php echo $tran->id; ?>">
		<td class="hover" style="cursor:pointer" onclick="printvoucher(<?php echo $tran->id; ?>)"><?php echo $tran->id; ?></td>
		<td>
			<?php
			 if($tran->type == 'Reciept'){
				 echo 'R'.$tran->receipt_id;
			 }elseif($tran->type == 'Payment'){
				 echo 'P'.$tran->payment_id;
			 }elseif($tran->type == 'Contra'){
				 echo 'C'.$tran->contra_id;
			 }
			 ?>
		</td>
		<td style="white-space:nowrap"><?php echo $tran->accountant; ?></td>
		<td><?php echo date('d-m-Y',strtotime($tran->entry_date)); ?></td>
		<td><?php echo date('d-m-Y',strtotime($tran->tran_date)); ?></td>
		<td><?php echo $tran->ledger; ?></td>
		<td><?php echo $tran->type; ?></td>
		<td><?php echo $tran->account; ?></td>
		<td><?php echo $tran->narration; ?></td>
		<td style="text-align:right"><?php echo $tran->amount; ?></td>
		<td class='deleteEntry' style="color:red; cursor:pointer; text-align:center" onclick="deleteAccountEntry('<?php echo $tran->id; ?>')">X</td>
	</tr>
<?php
  $sum+=(double)$tran->amount;
 } ?>
</tbody>
<tfoot>
<tr>
	<th style="text-align:right" colspan="5"> </th>
	<th style="text-align:right" colspan="2">Calculated Incentive</th>
	<th ><?php echo number_format(($sum * 0.015),2); ?></th>
	<th style="text-align:right" >Collection Total</th>
	<th style="text-align: right" colspan="2"><?php echo number_format($sum,2); ?></th>
</tr>
<tfoot>
</table>
<?php
if(isset($viewOnly)){
	echo '<style>.deleteEntry{display:none}</style>';
}
?>
<style>
.hover:hover{
	color:blue;
	text-decoration: underline;
}
</style>
