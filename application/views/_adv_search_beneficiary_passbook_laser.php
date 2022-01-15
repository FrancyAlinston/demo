<section class="content">
	<a class="btn btn-xs btn-success left-block" style="float:right" target="_blank" href="<?php echo $site_url.'/tools/printlog';?>" >View Print History</a>
	<form method="post" onsubmit="return advancedSearch('beneficiary_passbook_laser')" id="frmBenAdvanceSearch" name="frmBenAdvanceSearch">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtMemberFrm">Membership ID From</label>
									<input id="txtMemberFrm" name="txtMemberFrm" class="form-control" value="" type="text">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtMemberTo">Membership ID From</label>
									<input  id="txtMemberTo" name="txtMemberTo" class="form-control" value="" type="text">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtMemberFrm"> &nbsp; </label>
								<span class="btn-primary btn center-block" onclick="$('#frmBenAdvanceSearch').submit()">Fetch Beneficiary</span>
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
									<select name="selEduFrmS" id="selEduFrmS" class="form-control" onchange="">
										<option value=''></option>
									</select>
								</div>
							</div>
	                        <div class="col-md-4">
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
						      <div class="form-group"><textarea disabled class="form-control" id="passbookPrintQueue"></textarea></div>
						    </div>
						    <div class="col-md-4">
						    	<span class="btn btn-primary center-block" onclick="printPassbookSeriesLegal()" >Print Passbook</span>
						    </div>
					    </div>
				<hr>
				<div id="searchResults" style="overflow-y: scroll; height: 300px">

				</div>
	</form>
