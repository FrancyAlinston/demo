<table>
  <tr>
    <th nowrap="nowrap">Entry ID</th>
    <th>URL</th>
    <th nowrap="nowrap">Print Date</th>
  </tr>
<?php
//print_r($logs);
foreach($logs as $log){ ?>
  <tr>
    <td><?php echo $log->id; ?></td>
    <td><a href="<?php echo $log->url; ?>" target="_blank"><?php echo $log->url; ?></a></td>
    <td nowrap="nowrap"><?php echo $log->print_date; ?></td>
  </tr>
<?php } ?>
</table>
<style>
td,th{
  border: 1px solid #ccc;
  text-align: center;
}
table{
  border-collapse: collapse;
  font-family: arial;
  font-size: 12px;
}
</style>
