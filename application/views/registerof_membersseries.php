<?php

    include 'config.php';

	function ordinal($number) {
	    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
	    if ((($number % 100) >= 11) && (($number%100) <= 13))
	        return $number. 'th';
	    else
	        return $number. $ends[$number % 10];
	}

$cnt =0;

foreach ($certs as $cert) {

$cnt++;
	$dt = explode('/', $cert->issue_date);
	$dtm = DateTime::createFromFormat('!m', $dt[1]);


?>
<link rel="stylesheet" href="<?php echo $site_url; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<div style="float: left;"> FORM NO. MGT.1</div>
<h1 style="text-align:center;margin: 10px">Register Of Members</h1>
<div style="text-align: center;font-size: 16px">[Pursuant to section 88 (1)(a) of the Companies Act, 2013 and rule 3(1) of the Companies (Management and Administration) Rules, 2014]</div>

<div style="text-align: center;font-size: 16px"> <strong>Name of the company :</strong> Verapoly Navadersan Education Nidhi Limited &nbsp;&nbsp;&nbsp;<strong>Registered office address:</strong> 67/2794, Navadarsan Bldng, I S Press Road, nr. St Albert's College, Ernakulam</div>
<br><br>
<div class="row">
	<div class="col-md-2">
		<table class="regTable">
			<tr><td>FOLIO NO</td><th><?php echo $cert->membership_id; ?></th></tr>
			<tr><td>Class of shares</td><th>Equity</th></tr>
			<tr><td>Nominal value per share (in Rs.)</td><th><?php echo $cert->share_count * 100; ?></th></tr>
			<tr><td style="white-space: nowrap;">Total shares held</td><th><?php echo $cert->share_count; ?></th></tr>
		</table>
	</div>
	<div class="col-md-4" style="border-left: 1px solid #000">
		<h4>Personal Details</h4>
		<table class="regTable">
			<tr><td>Name of the member:</td><th><?php echo $cert->member_name; ?></th></tr>
			<tr><td>Name of joint holders, if any:</td><th></th></tr>
			<tr><td>Address/ Registered address (in case of body corporate):</td><th><?php echo $cert->permanent_address; ?></th></tr>
			<tr><td>E-mail Id:</td><th></th></tr>
			<tr><td>CIN/ Registration No.:</td><th></th></tr>
			<tr><td>Unique Identification No:</td><th><?php echo $cert->guardian_aadhar; ?></th></tr>
			<tr><td>Father’s/ Mother’s/ Spouse’s name:</td><th><?php echo $cert->guardians_guardian; ?></th></tr>
			<tr><td colspan="2" style="width:100% !important">
				<table style="width:100%">
					<tr><td>Status:</td><th></th><td>Occupation:</td><th style="white-space: nowrap;"><?php echo $cert->guardian_occupation; ?></th></tr>
					<tr><td>PAN No.:</td><th><?php echo $cert->pan_card; ?></th><td>Nationality:</td><th>Indian</th></tr>
				</table>
			</td></tr>
			<tr><td style="width:100%" colspan="2">In Case member is a minor</td></tr>
			<tr><td>Name of Guardain</td><th></th></tr>
			<tr><td>Date of birth of minor</td><th></th></tr>
		</table>
	</div>
	<div class="col-md-4" style="border-right: 1px solid #000; min-height:878px ">
				<h4>Details of Membership</h4>
		<table class="regTable">
			<tr><td>Date of becoming member:</td><th><?php echo ordinal($dt[0]); ?> day of <b><?php echo $dtm->format('F').' '.$dt[2]; ?></th></tr>
			<tr><td>Date of declaration under section 89, if applicable:</td><th></th></tr>
			<tr><td>Name and address of beneficial owner:</td><th><?php echo $cert->permanent_address; ?></th></tr>
			<tr><td>Date of receipt of nomination, if applicable:</td><th><?php echo ordinal($dt[0]); ?> day of <b><?php echo $dtm->format('F').' '.$dt[2]; ?></th></tr>
			<tr><td>Name and address of nominee:</td><th><?php echo $cert->nominee_name.' - '.$cert->temporary_address; ?></th></tr>
			<tr><td>No. of shares kept in abeyance, if applicable:</td><th></th></tr>
			<tr><td>Record of lien on shares, if applicable:</td><th></th></tr>
			<tr><td>Date of cessation of membership:</td><th></th></tr>
		</table>
	</div>
	<div class="col-md-2">
		<h4>Instructions</h4>
Particulars of dividend mandates, power of attorney and other instructions, if any:
Instruction for sending notices etc., if any:
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
		<h4>Instructions</h4>
Instruction for sending notices etc., if any:
	</div>
</div>

<br clear="all">
<br clear="all">
<br clear="all">
<div style="margin-left: 320px; margin-right: 10px" class="page2">
<h3 style="text-align: center;">MEMORANDUM OF TRANSFERS OF SHARE(S) MENTIONED OVERLEAF</h3>
<table class="bcTable" bordercollapse="collapse">
	<tr>
		<td>Date</td>
		<td>Transfer No.</td>
		<td>Register Folio No.</td>
		<td>Name of Transferee(s)</td>
		<td>Initials</td>
		<td>Authorised Signatory</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
		<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
</div>
<?php } ?>
<style>
.bcTable{
	width: 99%;
	border-collapse: collapse;
}
.bcTable td, .bcTable th{
	border: 1px solid #000;
	height: 30px;
	text-align: left;
}
.regTable{
	width:100%;
}
.regTable td,.regTable th{
	min-height: 30px;
	text-align: left;
	font-size: 16px;
	border-bottom:1px #ccc dashed;
	padding-top: 20px;
	padding-bottom: 20px;

}
.regTable th{
	width:60%;
	vertical-align: middle;
	padding-left: 10px;
	text-align: left;
}
.regTable td{
	width:40%;
	height: 35px
}

body{
	font-family: arial;
	margin-top: 20px;
	-webkit-print-color-adjust: exact;
	image-rendering: -webkit-optimize-contrast;
	font-size: 16px;
}
.authoriy{
	overflow: hidden;
	width:100%;
}
.authItem {
  display: inline-block;
  float: left;
  font-size: 13px;
  font-weight: 800;
  letter-spacing: 0.6px;
  padding-top: 83px;
  text-align: center;
  width: 33%;
}
.authItemSmall{
  display: inline-block;
  float: left;
  font-size: 9px;
  font-weight: normal;
  padding-top: 48px;
  text-align: center;
  width: 33%;
  white-space: nowrap;
}
	#certleft,#certficate{
		float: left;
		/*outline:1px #ccc solid;*/
		height: 590px;
	}
	#certleft{
		width: 280px;
		margin-left: 10px;
		margin-top: 50px;
	}

	#certficate{
		width: 760px;
		margin-left: 20px;
		/*background: url('<?php echo $site_url; ?>assets/images/sharecertificate.png') no-repeat;*/
		background-size: cover;
		background-position: left;
		padding-left: 30px;
		text-align:center;
		-webkit-print-color-adjust: exact;
		height: 750px
	}
	#certficate h2{
		font-size: 30px;
		text-shadow: 2px 2px 2px #999;
		font-family: Georgia;
		letter-spacing: 1px;
	}
	#leftShareHead{
		text-align: center;
	}
	#leftShareHead h2{
		margin-top: 0px;
	}
	small{
		font-size: 9px;
		font-style: italic;
	}

	.smallNormal {
	font-size: 12px;
	line-height: 1.3;
	}
	.shareTextLeft {
  font-size: 13px;
  font-style: italic;
  text-align: left;
}
	.leftHolderBox{
		height: 20px;
	}
	.acknowledge{
		clear: both;
		font-size: 12px;
		border-top:1px dashed #000;
		padding: 10px;
	}
	.certStart{
		margin-top: 62px;
	}
.certifyStatement {
  font-size: 13px;
  font-style: italic;
  line-height: 1.5;
  padding: 25px;
  text-align: left;
  text-indent: 50px;
  width: 700px;
}
	.equity{
		width: 690px;
		border: 1px solid #000;
		margin-left: 14px;
		border-radius: 5px;
		font-weight: bold;
		text-align: left;
		padding-left: 10px;
		padding-top: 1px;
		font-size: 14px;
		line-height: 25px;
		padding-left: 10px;
		margin-bottom:20px;
	}
	.certDetails{
		font-size: 10px !important;
		width: 690px;
		border: 1px solid #000;
		margin-left: 14px;
		border-radius: 5px;
		font-weight: bold;
		text-align: left;
		padding-left: 10px;
		padding-top: 1px;
		line-height: 25px;
		padding-left: 10px;
	}
	.certDetails td{
		font-size: 12px;
	}
.tblCert tr td:nth-child(2),.tblCert tr td:nth-child(4) {
  font-size: 12px;
  font-weight: bold;
  letter-spacing: 1px;
  text-align: left;
}
.tblCert {
  line-height: 1.2;
}
    .certR{
    	margin-top: 30px !important;
    }
    .img{image-rendering: crisp-edges;}
@media print {
    .acknowledge,.bcTable {page-break-after: always;}
    .page2{
    	-webkit-transform: rotate(-180deg);
     -moz-transform:rotate(-180deg);
     margin-top: 380px;
   /*  page-break-after: always;*/
    }
  .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
  }
  .col-md-12 {
    width: 100%;
  }
  .col-md-11 {
    width: 91.66666667%;
  }
  .col-md-10 {
    width: 83.33333333%;
  }
  .col-md-9 {
    width: 75%;
  }
  .col-md-8 {
    width: 66.66666667%;
  }
  .col-md-7 {
    width: 58.33333333%;
  }
  .col-md-6 {
    width: 50%;
  }
  .col-md-5 {
    width: 41.66666667%;
  }
  .col-md-4 {
    width: 33.33333333%;
  }
  .col-md-3 {
    width: 25%;
  }
  .col-md-2 {
    width: 16.66666667%;
  }
  .col-md-1 {
    width: 8.33333333%;
  }
  .col-md-pull-12 {
    right: 100%;
  }
  .col-md-pull-11 {
    right: 91.66666667%;
  }
  .col-md-pull-10 {
    right: 83.33333333%;
  }
  .col-md-pull-9 {
    right: 75%;
  }
  .col-md-pull-8 {
    right: 66.66666667%;
  }
  .col-md-pull-7 {
    right: 58.33333333%;
  }
  .col-md-pull-6 {
    right: 50%;
  }
  .col-md-pull-5 {
    right: 41.66666667%;
  }
  .col-md-pull-4 {
    right: 33.33333333%;
  }
  .col-md-pull-3 {
    right: 25%;
  }
  .col-md-pull-2 {
    right: 16.66666667%;
  }
  .col-md-pull-1 {
    right: 8.33333333%;
  }
  .col-md-pull-0 {
    right: auto;
  }
  .col-md-push-12 {
    left: 100%;
  }
  .col-md-push-11 {
    left: 91.66666667%;
  }
  .col-md-push-10 {
    left: 83.33333333%;
  }
  .col-md-push-9 {
    left: 75%;
  }
  .col-md-push-8 {
    left: 66.66666667%;
  }
  .col-md-push-7 {
    left: 58.33333333%;
  }
  .col-md-push-6 {
    left: 50%;
  }
  .col-md-push-5 {
    left: 41.66666667%;
  }
  .col-md-push-4 {
    left: 33.33333333%;
  }
  .col-md-push-3 {
    left: 25%;
  }
  .col-md-push-2 {
    left: 16.66666667%;
  }
  .col-md-push-1 {
    left: 8.33333333%;
  }
  .col-md-push-0 {
    left: auto;
  }
  .col-md-offset-12 {
    margin-left: 100%;
  }
  .col-md-offset-11 {
    margin-left: 91.66666667%;
  }
  .col-md-offset-10 {
    margin-left: 83.33333333%;
  }
  .col-md-offset-9 {
    margin-left: 75%;
  }
  .col-md-offset-8 {
    margin-left: 66.66666667%;
  }
  .col-md-offset-7 {
    margin-left: 58.33333333%;
  }
  .col-md-offset-6 {
    margin-left: 50%;
  }
  .col-md-offset-5 {
    margin-left: 41.66666667%;
  }
  .col-md-offset-4 {
    margin-left: 33.33333333%;
  }
  .col-md-offset-3 {
    margin-left: 25%;
  }
  .col-md-offset-2 {
    margin-left: 16.66666667%;
  }
  .col-md-offset-1 {
    margin-left: 8.33333333%;
  }
  .col-md-offset-0 {
    margin-left: 0%;
  }
  .visible-xs {
    display: none !important;
  }
  .hidden-xs {
    display: block !important;
  }
  table.hidden-xs {
    display: table;
  }
  tr.hidden-xs {
    display: table-row !important;
  }
  th.hidden-xs,
  td.hidden-xs {
    display: table-cell !important;
  }
  .hidden-xs.hidden-print {
    display: none !important;
  }
  .hidden-sm {
    display: none !important;
  }
  .visible-sm {
    display: block !important;
  }
  table.visible-sm {
    display: table;
  }
  tr.visible-sm {
    display: table-row !important;
  }
  th.visible-sm,
  td.visible-sm {
    display: table-cell !important;
  }
}
</style>
