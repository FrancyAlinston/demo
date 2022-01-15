<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Share Member List, Filter &amp; Export </h1>
	<?php include '_breadcrumbs.php'; ?>
  <div style="margin-top: 5px; background: #a0e0ed;" class="box box-info">
    <div class="box-body w3-allerta">
      <div class="row">
        <div class="col-md-4" style="overflow: hidden;">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="txtFrom">From Date</label>
                <input type="text" id="txtFrom" name="txtFrom" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="txtTo">To Date</label>
                <input type="text" id="txtTo" name="txtTo" class="form-control">
              </div>
            </div>
          </div>
      </div>
			<div class="col-md-4" style="border-right:2px dashed #00C0EF;">
				<div class="info-box" style="cursor: pointer; padding-right:10px">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">List Of</span>
              <span class="info-box-number">ALLOTEES</span>
              <span class="btn btn-primary" onclick="exportAllotees()"> Export </span>
            </div>

          </div>
			</div>
			  <div class="col-md-4 text-right" style="overflow: hidden;">
					<span class="btn btn-default" onclick="showModal('orphanCertificates')">Get Orphan Certificates</span>
				</div>
      </div>
    </div>
  </div>

      <div style="margin-top: 5px; background: #85b6f7;" class="box box-primary">
    <div class="box-body w3-allerta">
      <h4>Batch Print Share Certificates</h4>
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
                <label for="txtCertificateFrm">Certificate From</label>
                <input type="text" id="txtCertificateFrm" name="txtCertificateFrm" class="form-control">
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label for="txtCertificateTo">Certificate To</label>
            <input type="text" id="txtCertificateTo" name="txtCertificateTo" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label>Issue Shares</label>
            <span style="display: block" onclick="printSeries()"  class="btn btn-primary">Print Certificates</span>
            </div>
        </div>
      </div>
    </div>
  </div>
    <div id="popAccess" style="display:none;position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
    <div style="width:300px;height:200px;background: #fff;margin:0px auto;margin-top: 10%;padding:30px; border-radius: 8px">
      <div class="row">
            <div class="col-md-12">
              <p>Content is password protected</p>
              <div class="form-group">
                <label for="txtAccess">Pasword</label>
                <input type="password" class="form-control" name="txtAccess" id="txtAccess">
              </div>
              <span class="btn btn-danger" style="width: 100%" onclick="verifyAccess()">Submit</span>
            </div>
          </div>

    </div>
  </div>
	<?php include '_footer.php'; ?>
	<script>
function printSeries(){
  window.open("http://192.168.2.101/light/share/sharecertificateseries/"+$('#txtCertificateFrm').val()+'-'+$('#txtCertificateTo').val(),"_blank");
}

$(function(){
		$('#txtFrom,#txtTo').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtFrom,#txtTo').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});

	});
function exportAllotees(){
  notice('Loading please wait a few seconds while we prepare the export file...','info');
  $.post(site_url+'export/sharecertificatealloteeslist',$('#filterHead').find("select, textarea, input").serialize()).done( function( data ) {
  $('#exportFrame').attr('src',data);});
}
function verifyAccess(){
  if($('#txtAccess').val() == 'nidhi2018'){
    $('#popAccess').css('display','none');
  }else{

  }
}
	</script>
