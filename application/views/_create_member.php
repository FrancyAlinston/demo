<section class="content">
	<form method="post" onsubmit="return createNidhiMember()" id="frmCreateNidhiMember" name="frmCreateNidhiMember">
  <div class="text-red">There is no membership associated with this aadhaar, please create a mebership to proceed.</div>
  <br>
  <br>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtMemberName">Member Name</label>
									<input id="txtMemberName" name="txtMemberName" class="form-control" value="" type="text" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtMemberAaDhaar">Member Aadhaar</label>
									<input  id="txtMemberAaDhaar" name="txtMemberAaDhaar" class="form-control" value="" type="text" onkeyup="advancedSearch('beneficiary')">
								</div>
							</div>
						</div>

	</form>
</section>
<script>
	$('#txtMemberName').val($('#txtGuardian').val());
	$('#txtMemberAaDhaar').val($('#txtGuardianAadhaar').val());
</script>