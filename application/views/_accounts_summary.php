<table id="tblAccSummary" class="table table-primary table-striped table-bordered" style="width:50%">
  <tr>
    <th style="width:400px;">Opening Balance</th>
    <td><?php echo $openingbalance; ?></td>
  </tr>
  <tr>
    <th onclick="getAccountSummaryDetails('<?php echo $user; ?>','<?php echo $tran_date; ?>','Collection')">Collection</th>
    <td><?php echo $collection; ?></td>
  </tr>
  <tr>
    <th onclick="getAccountSummaryDetails('<?php echo $user; ?>','<?php echo $tran_date; ?>','ShareApp')">Member Share Application</th>
    <td><?php echo $shareapp; ?></td>
  </tr>

  <tr>
    <th onclick="getAccountSummaryDetails('<?php echo $user; ?>','<?php echo $tran_date; ?>','CollectionMaintenece')">Collection Center Maintenece Charges</th>
    <td><?php echo $maintenece; ?></td>
  </tr>
  <tr>
    <th onclick="getAccountSummaryDetails('<?php echo $user; ?>','<?php echo $tran_date; ?>','Payments')">Payments</th>
    <td><?php echo $payments; ?></td>
  </tr>
  <tr>
    <th onclick="getAccountSummaryDetails('<?php echo $user; ?>','<?php echo $tran_date; ?>','Contra')">Contra</th>
    <td><?php echo $contra; ?></td>
  </tr>

  <tr>
    <th style="background-color:green">Cash In Hand</th>
    <td class="cashInHand"><strong><?php  echo number_format(abs($balance),2,'.',''); ?></strong></td>
  </tr>
</table>
<style>
#tblAccSummary tr td:nth-child(2){
text-align: right
}
#tblAccSummary th:hover{
  cursor:pointer;
  background-color:#dd4b39;
}
#tblTranSummary th{
  text-transform: capitalize;
  text-align: center;
}
#tblTranSummary tr td:nth-child(6){
  text-align: right;
}
.GrandTotal{
  text-align: right;
}
</style>
