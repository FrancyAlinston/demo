<html>
<head>
  <title>Register OF Members</title>
  <style>
  body{
    font-size: 10px;
    font-family:arial;
    font-family: "Allerta Stencil", Sans-serif;
         box-shadow: 10px 10px 5px #ccc;
              -moz-box-shadow: 10px 10px 5px #ccc;
              -webkit-box-shadow: 10px 10px 5px #ccc;
              -khtml-box-shadow: 10px 10px 5px #ccc;
  }
  td{
    font-size: 10px;
  }
  .table-bordered{
    border-collapse: collapse;
    font-size: 11px;

  }
  .table-bordered td,.table-bordered th{
    border: 1px solid #ccc;
    padding:5px;

  }
  @media print {
    .page2{
    	-webkit-transform: rotate(-180deg);
     -moz-transform:rotate(-180deg);
     transform:rotate(-180deg);
    }
    footer {page-break-after: always;}
  }
  th.rotate {
    font-size:12px;
    font-weight:normal;
  }
  #conumnNUM td{
    text-align: center;
  }
  /* th.rotate {

    height: 140px;
    white-space: nowrap;
  }

  th.rotate > div {
    transform:

      translate(21px, 51px)

      rotate(315deg);
    width: 30px;
  }
  th.rotate > div > span {
    border-bottom: 1px solid #ccc;
    padding: 5px 10px;
    font-size: 10px;
    font-weight:normal;
  }
  th.rotate{
    border: none;
  } */
  #getrange{
    width:100%;
    height:2000px;
    background: #000;
    position: absolute;
    top:0px;
    left:0px;
    opacity: 0.5;
  }
  .modal{
    opacity:9;
    background: #fff;
    width: 70%;
    height: 100px;
    border-radius: 5px;
    margin: 0px auto;
    margin-top: 10%;
    text-align: center;
    padding: 1%;
    font-size: 12px;
  }
  .TBLentries{
    text-align: center;
  }
  </style>
  <?php include 'config.php'; ?>
  <script src="<?php echo $site_url; ?>bower_components/jquery/dist/jquery.min.js"></script>
  <script>
  function fetchRange(){
    location.href = window.location.href.split('?')[0]+'?range='+$('#start').val()+'-'+$('#to').val()+'&ts='+Date();
  }
  $(function(){
  <?php if(!isset($range)){ ?>
   $('#getrange').show();
  <?php } ?>
   });
  </script>
</head>
<body>
  <div id="getrange" style="display:none">
     <div class="modal">
      <h2>Please enter the Membership range</h2>
      <label>Membership Starting From</label>
        <input name="start" id="start" style="margin-right:10px">
        <label>  To <label>
          <input name="to" id="to">
          <button onclick="fetchRange()">Submit</button>
     </div>
   </div>
  <?php
  if(isset($range)){
  $nom = array();
  $cnt = 0;

  $printOrientation = 'page2';
  foreach ($members as $member) {

    if($cnt != 0 && $members[$cnt-1]->memid != $member->memid){
      $nom = array();
      $nom[]= $member->nominee_name;
    }else{
      $nom[] = $member->nominee_name;
    }

    if(isset($members[$cnt+1]) && $members[$cnt+1]->memid == $member->memid){
      $cnt++;
      continue;
    }

    $cnt++;
    if($printOrientation == 'page2'){ // Roate the page orintation on every even page for duplex printing
      $printOrientation = 'page1';
    }else if($printOrientation == 'page1'){
      $printOrientation = 'page2';
    }

    $folio = $member->memid;
  ?>

<div class="<?php echo $printOrientation; ?>">
  <div style="position:absolute; top:10px ; left 0px; z-index:1">FORM NO. MGT.1</div>
<table width="100%" style="border-bottom:2px solid #000">
  <tr>
    <td width="100%" style="text-align:center" colspan="2">
      <h1 style="margin:0px">REGISTER OF MEMBERS</h2>
        <strong style="font-size:12px">[Pursuant to section 88 (1)(a) of the Companies Act, 2013 and rule 3(1) of the Companies (Management and Administration) Rules, 2014]</strong>
        <div style="width:40%;border-top:2px solid #000; margin:0px auto;margin-top:5px">&nbsp;</div>
    </td>
  </tr>
  <tr>
    <td style="text-align:left">Name Of Company : </td>
    <td style="text-align:left">Registered Ofice address : </td>
  </tr>
</table>
</body>
<h4 style="text-align:center">(TO BE MAINTAINED SEPARATELY FOR EACH CLASS OF SHARES)</h4>
<table width="100%">
  <tr>
    <td width="15%" style="border-right:1px solid #888;vertical-align:top">
      <table style="width:100%">
        <tr><td style="width:70%"><strong>FOLIO NO </strong></td><td>: <strong><?php echo $member->memid; ?></strong></td></tr>
        <tr><td>Class of Shares</td><td>: Equity</td></tr>
        <tr><td>Nominal value per share</td><td>: 10</td></tr>
        <tr><td>Total shares held</td><td>: <?php echo $member->shares; ?></td></tr>
      </table>
    </td>
    <td width="35%" style="padding:10px">
      <h4 style="text-decoration:underline;">Personal Details</h4>
      <table>
        <tr><td>Name Of the Member</td><td>: <?php echo $member->guardian_name; ?></td></tr>
        <tr><td>Address</td><td>: <?php echo str_replace(',','<br> &nbsp;',$member->permanent_address); ?></td></tr>
        <tr><td>E-mail Id</td><td>: <?php echo $member->email; ?></td></tr>
        <tr><td>Aadhaar</td><td>: <?php echo $member->guardian_aadhar; ?></td></tr>
        <tr><td>Father's / Mother's / Spouses's Name</td><td>: <?php echo $member->guardians_guardian; ?></td></tr>
      </table>
      <table style="width:100%" class="table-bordered">
        <tr><td>Status</td><th></th><td>Occupation</td><th><?php echo $member->guardian_occupation; ?></th></tr>
        <tr><td>PAN No</td><th> <?php echo $member->pan_card; ?></th><td>Nationality</td><th> Indian</th></tr>
      </table>

    </td>
    <td width="35%">
      <h4 style="text-decoration:underline;">Details of Membership</h4>
      <table>
        <tr><td>Date Of becoming Member</td><td>: <?php echo $member->membership_date; ?></td></tr>
        <tr><td>Date Of receipt of Nomination, if applicable </td><td>: <?php echo $member->membership_date; ?></td></tr>
        <tr><td style="vertical-align:top">Name and address of nominee</td><td>: <div style="margin-left:10px; margin-top:-10px" ><?php echo implode('<br>',$nom); ?><br><br><?php echo str_replace(',','<br> &nbsp;',$member->temporary_address); ?></div></td></tr>
        <tr><td>Date of cessation of membership</td><td>: </td></tr>
      </table>
    </td>
    <td width="15%">
      <h4>Instructions:</h4>
      <p>Particulars of dividend mandates, Power of attorney and other instructions, if any :</p>
      <p>Instruction for sending notices etc., if any :</p>
    </td>
  </tr>
</table>
<br>
<hr>
<h2 style="margin:0px auto;text-align:center;font-style:italic">DETAILS OF SHARE HOLDINGS</h2>
<table class="table-bordered">
  <tr>
    <th class="rotate"><div><span>Allotment No./ Transfer No</span></div></th>
    <th class="rotate"><div><span>Date Of Allotment / transfer</span></div></th>
    <th class="rotate"><div><span>No. of shares alloted / transfered</span></div></th>
    <th class="rotate" colspan="2"><div><span>Distinctive Numbers (both inclusive)</span></div></th>
    <th class="rotate"><div><span>Folio of transferor, if applicable</span></div></th>
    <th class="rotate"><div><span>Name of the transferor, if applicable</span></div></th>
    <th class="rotate"><div><span>Date of issue or endorsement of share certificate</span></div></th>
    <th class="rotate"><div><span>Certificate No.</span></div></th>
    <th class="rotate"><div><span>Lock in period if any</span></div></th>
    <th class="rotate"><div><span>Payable Amount</span></div></th>
    <th class="rotate"><div><span>Paid / Deemed to be paid</span></div></th>
    <th class="rotate"><div><span>Due Amount</span></div></th>
    <th class="rotate"><div><span>If shares are issued for consideration other than cash, brief particulars thereof</span></div></th>
    <th class="rotate"><div><span>Date of transfer/ transmissinon/ forfiture/ redemption etc</span></div></th>
    <th class="rotate"><div><span>No of shares transferred /transmitted /forfeited /redeemed etc</span></div></th>
    <th class="rotate" colspan="2"><div><span>Distinctive numbers (both Inclusive)</span></div></th>
    <th class="rotate"><div><span>Folio of transferee</span></div></th>
    <th class="rotate"><div><span>Name of transferee</span></div></th>
    <th class="rotate"><div><span>Balance shares (after transfer /transmission /forfeiture /redemption etc.)</span></div></th>
    <th class="rotate"><div><span>Remarks</span></div></th>
    <th class="rotate"><div><span>Authentication / Signature</span></div></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>From</td>
    <td>To</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>From</td>
    <td>To</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr id="conumnNUM">
    <td> (1) </td>
    <td> (2) </td>
    <td> (3) </td>
    <td colspan="2"> (4) </td>
    <td> (5) </td>
    <td> (6) </td>
    <td> (7) </td>
    <td> (8) </td>
    <td> (9) </td>
    <td colspan="3"> (10) </td>
    <td> (11) </td>
    <td> (12) </td>
    <td> (13) </td>
    <td colspan="2"> (14) </td>
    <td> (15) </td>
    <td> (16) </td>
    <td> (17) </td>
    <td> (18) </td>
    <td> (19) </td>
  </tr>
<?php $crtRows = 0;
foreach($shares as $share){
  if($share['member_id'] == $folio){
    $crtRows++; // print less empty rows to page fill
   ?>
  <tr class="TBLentries">
    <td style="max-height:15px;"> <?php echo $share['allotment_num']; ?> </td>
    <td><?php echo $share['issue_date']; ?></td>
    <td><?php echo $share['share_count']; ?></td>
    <td><?php $shareRange = explode('-',$share['share_id']); echo $shareRange[0]; ?></td>
    <td><?php echo $shareRange[1]; ?></td>
    <td><?php echo $folio; ?></td>
    <td> &nbsp; </td>
    <td><?php echo $share['issue_date']; ?></td>
    <td><?php echo $share['id']; ?></td>
    <td> &nbsp; </td>
    <td><?php echo $share['share_count']*10; ?></td>
    <td><?php echo $share['share_count']*10; ?></td>
    <td>0</td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
  </tr>
<?php }} ?>
  <?php for($i = 1; $i < (15-$crtRows); $i++){ ?>
  <tr>
    <td style="max-height:15px;"> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
    <td> &nbsp; </td>
  </tr>
<?php } ?>
</table>

<footer></footer>
</div>
<?php
   }
}
?>
</body>
</html>
