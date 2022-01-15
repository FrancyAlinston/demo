<html>
<head>
  <title>Register Of Share Transfer</title>
  <style>
  body{
    font-size: 10px;
    font-family:arial;
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
  th{
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
  height: 400px;
  border-radius: 5px;
  margin: 0px auto;
  margin-top: 10%;
  text-align: center;
  padding: 1%;
  font-size: 12px;
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
    <h2>Please enter the certificate range</h2>
    <label>Certificate Starting From</label>
      <input name="start" id="start" style="margin-right:10px">
      <label>  To <label>
        <input name="to" id="to">
        <button onclick="fetchRange()">Submit</button>
   </div>
 </div>
<?php
if(isset($range)){
$cnt = 0;
$printOrientation = 'page2';
foreach ($members as $member) {
  $cnt++;
if(max(($cnt-1),0) % 8 == 0){
    if ($printOrientation == 'page2'){
      $printOrientation = 'page1';
    }else{
      $printOrientation = 'page2';
    }
?>
<?php if($cnt > 8){?>
</table>

<footer></footer>
</div>
<?php } ?>

<div class="<?php echo $printOrientation; ?> w3-allerta">
  <div style="position:absolute; top:10px ; left 0px; z-index:1">Appl-Allot</div>
<table width="100%" style="border-bottom:2px solid #000">
  <tr>
    <td width="100%" style="text-align:center" colspan="2">
      <h1 style="margin:0px; text-transform:uppercase">Register Of Share Transfer</h2>
    </td>
  </tr>
</table>
<table class="table-bordered">
  <tr>
    <th rowspan="3" class="rotate"><div><span>S.No.</span></div></th>
    <th rowspan="3" class="rotate"><div><span>Date of Registration</span></div></th>
    <th rowspan="3" class="rotate"><div><span>Date of Board / Committee Meeting which Approved the Transfer</span></div></th>
    <th rowspan="1" colspan="2"  class="rotate"><div><span>Transferor</span></div></th>
    <th rowspan="1" colspan="3"  class="rotate"><div><span>Share Transferred</span></div></th>
    <th rowspan="3" class="rotate"><div><span>No. of Old Certificate</span></div></th>
    <th rowspan="3" class="rotate"><div><span>Amount</span></div></th>
    <th rowspan="1" colspan="3" class="rotate"><div><span>Transferee</span></div></th>
    <th rowspan="3" class="rotate"><div><span>New Certificate No.</span></div></th>
    <th rowspan="3" class="rotate"><div><span>Class</span></div></th>
    <th rowspan="3" class="rotate"><div><span>Consideration Involved</span></div></th>
    <th rowspan="3" class="rotate"><div><span>Remarks</span></div></th>
  </tr>
  <tr>
      <th rowspan="2" class="rotate"><div><span>Name and Address</span></div></th>
      <th rowspan="2" class="rotate"><div><span>Folio No.</span></div></th>
      <th rowspan="2" class="rotate"><div><span>No. of Shares.</span></div></th>
      <th rowspan="1" colspan="2" class="rotate"><div><span>Distinctive No.</span></div></th>
      <th rowspan="2" class="rotate"><div><span>Name and Address</span></div></th>
      <th rowspan="2" class="rotate"><div><span>Occupation</span></div></th>
      <th rowspan="2" class="rotate"><div><span>Folio No.</span></div></th>
  </tr>
  <tr>
      <th rowspan="1" class="rotate"><div><span>From</span></div></th>
      <th rowspan="1" class="rotate"><div><span>To</span></div></th>
  </tr>
  <tr id="conumnNUM">
    <td> (1) </td>
    <td> (2) </td>
    <td> (3) </td>
    <td> (4) </td>
    <td> (5) </td>
    <td> (6) </td>
    <td> (7) </td>
    <td> (8) </td>
    <td> (9) </td>
    <td> (10) </td>
    <td> (11) </td>
    <td> (12) </td>
    <td> (13) </td>
    <td> (14) </td>
    <td> (15) </td>
    <td> (16) </td>
    <td> (17) </td>
  </tr>
  <?php } ?>
  <tr>
    <td><?php echo $member->certid; ?></td>
    <td><?php echo $member->receipt_date; ?></td>
    <td><?php echo $member->guardian_name.'<br>'.$member->permanent_address; ?></td>
    <td><?php echo $member->guardians_guardian; ?></td>
    <td><?php echo $member->guardian_occupation; ?></td>
    <td align="center"><?php $shares = explode('-',$member->share_id); $totalShare = (abs($shares[1])-abs($shares[0]))+1; echo $totalShare; ?></td>
    <td align="center"><?php echo ($totalShare*10); ?></td>
    <td align="center"><?php echo "[ ".$member->allotment_num." ] ".$member->issue_date; ?></td>
    <td align="center"><?php echo $totalShare; ?></td>
    <td><?php echo $shares[0]; ?></td>
    <td><?php echo $shares[1]; ?></td>
    <td align="center"><?php echo ($totalShare*10); ?></td>
    <td align="center"><?php echo ($totalShare*10); ?></td>
    <td align="center"> 00 </td>
    <td align="center">Nill</td>
    <td><?php echo $member->receipt_date; ?></td>
    <td><?php echo $member->issue_date; ?></td>
  </tr>
<?php } ?>
</table>

<footer></footer>
</div>
<?php
}
?>

</body>
</html>
