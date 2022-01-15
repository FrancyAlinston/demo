<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>

<section class="content-header">
	<h1>
		Daily UnPrinted Transactions
	</h1>
<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
			<div class="box box-success" style="background-color: #96eba6;">
				<div class="box-header with-border">
				</div>
				<div class="box-body w3-allerta" id="addFundResults" style="overflow-x:auto;">
					<?php echo $dailytrans; ?>
				</div>
			</div>
		</section>
	</div>
	<a id="makePrint" href="" target="_tab">makeprint</a>
<?php include '_footer.php'; ?>
<script>
$(function(){
	$('.sidebar-toggle').trigger('click');
});
function printAccountReciept(row){
	$('#makePrint').attr('href','<?php echo $site_url?>accounts/print/'+$(row).find('td:nth-child(1)').text());
	$('#makePrint')[0].click();
}
</script>
