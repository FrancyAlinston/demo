<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Only ' : '') . $paise;
}

function makedateindian($dt){
	 $newdt = explode('-',$dt);
	 return $newdt[2].'-'. $newdt[1].'-'. $newdt[0];
}

?>
<html>
<head>
<style type="text/css">
table{
	font-family: arial;
	font-size: 14px
}
strong{
  font-size:12px;
}
#pricingtbl{
  border-collapse: collapse;
  margin: 0px auto;
}
#pricingtbl td{
  border:1px solid #ccc;
  padding: 5px
}
@media print {
    #pagebreak{
			page-break-after: always;
		 /* border-bottom:2px solid #000;/*
	  }
		@page
   {
    /* size:3.5in 3.5in;
    size: portrait;*/
  }
	}
</style>
</head>
<body>
<table style="width: 100%;">
  <?php
   if($print->type == 'Reciept'){
     $print_id = 'R'.$print->receipt_id;
   }elseif($print->type == 'Payment'){
     $print_id = 'P'.$print->payment_id;
   }elseif($print->type == 'Contra'){
     $print_id = 'C'.$print->contra_id;
   }
   ?>
  <tr style="font-size:11px">
    <td style="text-align:left; width:50%">No: <?php echo $print_id; ?></td>
    <td style="text-align:right"> Date : <?php echo makedateindian($print->tran_date); ?></td>
  </tr>
	<tr>
		<td colspan="2" style="text-align:center">
      <br>
			<h3>VERAPOLY NAVADARSAN EDUCATION NIDHI LTD</h3>
				<div style="font-size:10px">
					<strong>CIN: U74999KL2018PLC052143</strong><br>
					Regd. Office 67/2794, Navadarsan Bldg, IS Press Road,<br>
					Near St Alberts's College, Ernakulam, Kochi - 682 018<br>
					Phone : 2393735, E-mail: navadarsannidhi@gmail.com<br>
				</div><br>
			</td>
		</tr>
    <tr>
      <td style="text-align:center; font-weight:bold; letter-spacing:1px; font-size:14px" colspan="2">
<?php

  if($print->ledger == 'Members Share Application'){
    echo 'Membership Fee Acknowledgement Slip';
  }elseif($print->type == 'Reciept' && $print->account != 'Cash'){
    echo 'Bank Receipt Verification Slip';
  }elseif($print->type == 'Reciept' && $print->account == 'Cash'){
    echo 'Collection Acknowledgement Slip';
  }elseif($print->type == 'Payment'){
      echo 'Voucher';
  }
?>

        <br><br></td>
    </tr>
		<tr>
			<td colspan="2">
				<table id="pricingtbl">
					<tr>
						<td><?php if($print->type == 'Payment'){ echo "Paid"; }else{ echo "Receive"; } ?> Rs</td>
						<td <?php if($print->type == 'Reciept' && $print->account != 'Cash'){ echo 'colspan="2"'; }?> >
              <strong style="text-transform:capitalize"><?php echo $print->amount; ?> [ <?php echo getIndianCurrency(abs($print->amount)); ?> ]</strong></td>
					</tr>
          <?php if($print->type == 'Reciept' && $print->account != 'Cash'){ ?>
          <tr>
						<td>Deposoited at</td>
						<td><strong style="text-transform:capitalize"><?php echo $print->account; ?></strong></td>
            <td>on <strong><?php echo makedateindian($print->tran_date); ?></strong></td>
					</tr>
          <?php } ?>
					<tr>
						<td style="white-space:nowrap"><?php if($print->type == 'Payment'){ echo "Payment"; }else{ echo "Collection"; } ?> Details </td>
						<td <?php if($print->type == 'Reciept' && $print->account != 'Cash'){ echo 'colspan="2"'; }?><strong> <?php echo $print->narration;
              if($print->ledger == 'Members Share Application'){ echo '<br> [ '.ucwords($print->forum).' ]'; } ?>
            </strong></td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td style="text-align:left"> <br><br>Payee / Recipient <br><br></td>
      <td style="text-align:right"> <br><br>Cashier <br><br></td>
		</tr>
	</table>

<div id="pagebreak"> </div>
</body>
	<script type="text/javascript">
	window.print();
</script>
