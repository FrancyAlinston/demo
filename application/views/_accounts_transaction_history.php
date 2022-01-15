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
		<th>Forum</th>
		<th>Account</th>
		<th>Narration</th>
		<th>Amount</th>
		<th class='deleteEntry'>Action</th>
	</tr>
</thead>
<tbody>
	<?php foreach ($transactions as $tran) { ?>
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
		<td><?php echo $tran->forum; ?></td>
		<td><?php echo $tran->account; ?></td>
		<td><?php echo $tran->narration; ?></td>
		<td title="Click to see the denominations" onclick="$('#DDDinom<?php echo $tran->id; ?>').toggle(300);" style="cursor:pointer; color:blue; text-align:right"><?php echo $tran->amount; ?></td>
		<td class='deleteEntry' style="color:red; cursor:pointer; text-align:center" onclick="deleteAccountEntry('<?php echo $tran->id; ?>')">X</td>
	</tr>
	<tr id="DDDinom<?php echo $tran->id; ?>" style="display:none">
		<td colspan="11">
			<table class="table table-primary table-bordered table-hover table-responsive">
				<tr>
					<th>2000</th>
					<th>500</th>
					<th>200</th>
					<th>100</th>
					<th>50</th>
					<th>20</th>
					<th>10</th>
					<th>1</th>
				</tr>
				<tr>
					<td><?php echo $tran->d2000; ?></td>
					<td><?php echo $tran->d500;  ?></td>
					<td><?php echo $tran->d200;  ?></td>
					<td><?php echo $tran->d100;  ?></td>
					<td><?php echo $tran->d50;   ?></td>
					<td><?php echo $tran->d20;   ?></td>
					<td><?php echo $tran->d10;   ?></td>
					<td><?php echo $tran->d1;    ?></td>
				</tr>
			</table>
		</td>
	</tr>
<?php } ?>
</tbody>
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
