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
<div id="certleft" <?php if($cnt > 1){ echo 'class="certsL"';} ?> >
	<div id="leftShareHead">
		<small><i>Form No. SH-1</i></small>
		<h2>Share Certificate</h2>
		<small>[ Pursuant to sub section (3) of section 46 of the Companies Act 2013 and rule 5(2) of the Companies (Share Capital &amp; Debentures) Rules, 2014 ]</small>
		<div><strong>VERAPOLY NAVADARSAN EDUCATION NIDHI LIMITED</strong></div>
		<br>
		<div class="smallNormal">Reg. Office 67/2794, Navadarsan Bldng,<br>I S Press Road, nr. St Albert's College, Ernakulam, Kerala, India,682018 </div>
		<div><strong>CIN:U74999KL2018PLCO52143</strong></div>
		<div><small>(Incorporated under the Companies Act, 2013)</small></div>
		<br>
		<div class="shareTextLeft">
			Certicicate No: <?php echo $cert->certificate_number; ?> / Class of Shares: Equity<br>
			Share Ledger Folio No: <?php echo $cert->membership_id; ?> <br>
			No of shares <?php echo $cert->share_count; ?> <br>Numbered	<?php $shares = explode('-', $cert->share_id); ?>
			form <?php echo $shares[0]; ?> to <?php echo $shares[1]; ?><br>(both nos. inclusive)<br>
			Name(s) of Holder(s): 
			<div class="leftHolderBox">
				<b><?php echo $cert->member_name; ?></b>
			</div>
			<br>
			Husband's/Fathers Name: <?php echo $cert->guardians_guardian; ?><br>
			Occupation: <?php echo $cert->guardian_occupation; ?><br>
			Address: <?php echo $cert->permanent_address; ?><br>
			Unit No &amp; Name : <?php echo $cert->bcc_number; ?> - <?php echo $cert->bcc_name; ?><br>Phone : <?php echo $cert->guardian_phone; ?><br>
			Collection Centre : <?php echo ucwords($cert->education_forum); ?>
			<br><br>
			Given under the Signature of the undersigned on 
			<b><?php echo ordinal($dt[0]); ?></b> day of <b><?php echo $dtm->format('F').' '.$dt[2]; ?></b>

	<div class="authoriy" style="margin-top: 15px; margin-bottom: 20px">
		<div class="authItemSmall" style="background-image: url('http://192.168.2.101/light/assets/images/bibu.png'); background-repeat: no-repeat; background-size: 77px auto; background-position: 11px 11px;">Mg. Director</div>
		<div class="authItemSmall" style="background-repeat: no-repeat; background-size: 99px auto; background-image: url('http://192.168.2.101/light/assets/images/dir.jpg'); background-position: -2px 11px;">Director</div>
		<div class="authItemSmall" style="background-image: url('http://192.168.2.101/light/assets/images/authsig.jpg'); background-repeat: no-repeat; background-size: 92px auto; background-position: 11px 11px;">Authorized Signatory</div>
	</div>
	<div class="acknowledge">
		<h4 style="text-align: center; margin: 0px 0px 10px;">Acknowledgement</h4>
		I hereby acknowledge receipt of share certificate detailed above.
		<div style="margin-top: 15px; text-align: left;">Name<br><br>Signature</div>
	</div>

		</div>
	</div>
</div>
<div id="certficate" <?php if($cnt > 1){ echo 'style="margin-top: 20px !important;"';} ?> >
	<div class="certStart">Form No. SH-1</div>
	<h2 style="margin: 0px; padding:0px">SHARE CERTIFICATE</h2>
	<h4 style="margin: 0px; padding:0px;font-size: 22px">VERAPOLY NAVADARSAN EDUCATION NIDHI LIMITED</h4>
	<small>[ Pursuant to sub section (3) of section 46 of the Companies Act 2013 and rule 5(2) of the Companies (Share Capital &amp; Debentures) Rules, 2014 ]</small>
	<br>
	<div class="smallNormal">Reg. Office 67/2794, Navadarsan Bldng, I S Press Road, nr. St Albert's College, Ernakulam<br>Incorporated under the Companies Act, 2013 (18 of 2013) Ernakulam, Kerala, India,682018</div><br>
	<h5 style="margin: 0px; padding:0px">CIN:U74999KL2018PLC052143</h5>
	<div class="smallNormal">(Incorporated under the Companies Act, 2013)</div>
	<div class="certifyStatement">THIS IS TO CERTIFY that the person(s) named in this certificate is / are the Registered Holder(s) of the within mentioned Share(s) bearing the distinctive number(s) herein specified in the above Company subject to the Memorandum and the Articles of Association of the Company and that the amount endrosed hereon has been paid up on each such share.</div>
	<div class="equity">
		<table width="100%">
			<tr><td width="40%">Equity shares Each of Rupees</td><td>10</td></tr>
			<tr><td>Amount Paid up per share Rupees</td><td>10</td></tr>
		</table>
	</div>
	<div class="certDetails">
	<table style="width: 100%" class="tblCert">
		<tr>
			<td style="width:20%">Register Folio No</td>
			<td style="text-align: left;width: 20%"><?php echo $cert->membership_id; ?></td>
			<td style="width:20%">Certificate No</td>
			<td style="text-align: left;"><?php echo $cert->certificate_number; ?></td>
		</tr>
		<tr>
			<td>Name(s) of Holders(s)</td>
			<td colspan="3"><?php echo $cert->member_name; ?></td>
		</tr>
		<tr>
			<td>No. of Shares(s) Held<br>(in figures) (in words)</td>
			<td colspan="3"><?php 
			$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
             echo $cert->share_count.' | '.ucwords($f->format($cert->share_count)); ?></td>
		</tr>
		<tr>
			<td>Distinctive No. (s)</td><td colspan="3"> From  <?php echo $shares[0]; ?> to <?php echo $shares[1]; ?> (Both inclusive)</td>
		</tr>
	</table>

</div>
	<div style="text-align: left;font-size: 12px; margin-left: 20px; margin-top: 20px">
		Given under the Signature of the undersigned on <b><?php echo ordinal($dt[0]); ?></b> day of <b><?php echo $dtm->format('F').' '.$dt[2]; ?></b>
	</div>
	<div class="authoriy">
		<div class="authItem" style="background-image: url('http://192.168.2.101/light/assets/images/bibu.png'); background-repeat: no-repeat; background-size: 141px auto; background-position: 58px 20px;">Mg. Director</div>
		<div class="authItem" style="background-repeat: no-repeat; background-image: url('http://192.168.2.101/light/assets/images/dir.jpg'); background-size: 175px auto; background-position: 28px 27px;">Director</div>
		<div class="authItem" style="background-image: url('http://192.168.2.101/light/assets/images/authsig.jpg'); background-repeat: no-repeat; background-size: 160px auto; background-position: 44px 28px;">Authorized Signatory</div>
	</div>
	<div style="margin-top: 10px; letter-spacing: 1px; text-align: left; margin-left: 20px; font-size: 11px;"> Note: No transfer of the share(s) comprised in this certificate can be registered unless accompanied by this certificate.</div>

</div>
<!-- <div style="clear: both;font-size: 10px; text-align: right; margin-right: 10px;"><?php echo ucwords($cert->education_forum.' / '.$cert->bcc_name.' / '.$cert->bcc_number); ?></div> -->
<div class="acknowledge" style="display: none;">
	<h5 style="text-align: center; font-size: 16px; margin-top: 10px; margin-bottom: 10px;">Acknowledgement</h5>
	I <b><?php echo $cert->member_name; ?></b> hereby acknowledges receipt of share certificate with Certicicate No: <?php echo $cert->certificate_number; ?> / Class of Shares: Share Ledger Folio No. <?php echo $cert->membership_id; ?> No of shares <?php echo $cert->share_count; ?> numbered form <?php echo $shares[0]; ?> to <?php echo $shares[1]; ?> (both nos. inclusive) from VERAPOLY NAVADARSAN EDUCATION NIDHI LIMITED.
	<div style="text-align: right; margin-right: 50px; margin-top: 10px"><span style="float: left;">Date</span>Name &amp; Signature</div>
	<br><br><br>

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
.bcTable td{
	border: 1px solid #000;
	height: 30px;
	text-align: center;
}

body{
	font-family: arial;
	margin-top: 20px;
	-webkit-print-color-adjust: exact;
	image-rendering: -webkit-optimize-contrast;
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
	strong{
		font-size: 9px;
		white-space: nowrap;
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
    .acknowledge {page-break-after: always;}
    .page2{
    	-webkit-transform: rotate(-180deg); 
     -moz-transform:rotate(-180deg);
     margin-top: 380px;
   /*  page-break-after: always;*/
    }

}
</style>