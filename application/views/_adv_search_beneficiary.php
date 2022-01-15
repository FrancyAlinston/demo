<section class="content">
	<form method="post" onsubmit="return advancedSearch('beneficiary')" id="frmBenAdvanceSearch" name="frmBenAdvanceSearch">
            <?php if(isset($type)){ if($type == 'nidhiBen'){ ?>
							<div class="row">
								<!-- <div class="col-md-8">&nbsp;</div> -->
								<div class="col-md-4">
									<span class="btn btn-md btn-primary" onclick="addNewNidhiBeneficiary()">Add New Beneficiary</span>
								</div>
							</div>
						</br>
						<?php }} ?>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtOldid">Beneficiary ID</label>
									<input id="txtOldid" name="txtOldid" class="form-control" value="" type="text" onkeyup="advancedSearch('beneficiary')">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBenNameS">Beneficiary Name</label>
									<input  id="txtBenNameS" name="txtBenNameS" class="form-control" value="" type="text" onkeyup="advancedSearch('beneficiary')">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtGuardianS">Guardian Name</label>
									<input placeholder="Enter Name" id="txtGuardianS" name="txtGuardianS" class="form-control" value="" type="text" onkeyup="advancedSearch('beneficiary')">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="SelForaneS">Select Forane</label>
									<select class="form-control" name="SelForaneS" id="SelForaneS" onchange="geteduforum(value,'selEduFrmS')">
										<option value=''></option>
										<?php foreach ($forane->result() as $row) { ?>
										<option value='<?php echo $row->id; ?>'><?php echo ucwords($row->forane); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="selEduFrmS">Select Education Forum</label>
									<select name="selEduFrmS" id="selEduFrmS" class="form-control" onchange="advancedSearch('beneficiary')">
										<option value=''></option>
									</select>
								</div>
							</div>
	            <div class="col-md-4">
								<div class="form-group">
									<label for="txtPhoneS">Phone</label>
									<input id="txtPhoneS" name="txtPhoneS" class="form-control" value="" type="text" onkeyup="advancedSearch('beneficiary')">
								</div>
							</div>
						</div>
						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtMembershipId">Membership ID</label>
								<input id="txtMembershipId" name="txtMembershipId" class="form-control" value="" type="text" onkeyup="advancedSearch('beneficiary')">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtMembershipId">Share Cerificate ID</label>
								<input id="txtShareCertificateId" name="txtShareCertificateId" class="form-control" value="" type="text" onkeyup="advancedSearch('beneficiary')">
							</div>
						</div>
					</div>
				<hr>
				<?php if(isset($type)){ ?>
					<input type="hidden" id="<?php echo $type;?>" name="<?php echo $type;?>" >
				<?php } ?>
				<div id="searchResults" style="overflow-y: scroll; height: 300px">

				</div>
	</form>
