<section class="content">
	<form method="post" onsubmit="return advancedSearch('beneficiary')" id="frmCorpAdvanceSearch" name="frmCorpAdvanceSearch">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDId">Donor ID</label>
									<input id="txtDId" name="txtDId" class="form-control" value="" type="text" onkeyup="advancedSearch('corpusfund')">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDonorName">Donor Name</label>
									<input  id="txtDonorName" name="txtDonorName" class="form-control" value="" type="text" onkeyup="advancedSearch('corpusfund')">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDonorName">Education Forum</label>
									<input  id="txtEduForum" name="txtEduForum" class="form-control" value="" type="text" onkeyup="advancedSearch('corpusfund')">
								</div>
							</div>
						</div>
				<hr>
				<div id="searchResults" style="overflow-y: scroll; height: 300px">

				</div>
	</form>
