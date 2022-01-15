<style>
	#w3-allerta {
		font-family: "Allerta Stencil", Sans-serif;
	}
</style>
<div id="printBody">
	<?php
include 'config.php';
foreach ($scholarship->result() as $ship) {
    ?>
	<div class="">
		<div class="item ">
			<!-- <div style="font-size:24px">NAVADARSAN SCHOLARSHIP</div> -->
			<strong style="font-size:24px"><?php echo ucwords($ship->payee); ?></strong><br>
			<?php echo ucwords($ship->edu_forum); ?><br>
		</div>
		<?php
} ?>
	</div>
</div>
<style>
	#printBody {
		width: 100%;
	}

	.item {
		text-align: center;
		width: 40%;
		float: left;
		margin: 20px;
		padding: 15px;
		border-radius: 5px;
		border: 1px dashed #ccc;
		height: auto;
	}

	.item strong {
		white-space: nowrap;
	}

	@media print {
		@page {
			size: 8.5in 14in portrait;
		}
	}
</style>