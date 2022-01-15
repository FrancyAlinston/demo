  <?php foreach ($columns->result() as $column) { ?>
  <div style="width: 250px; float: left;"><input type="checkbox" name="chk_<?php echo $column->Field; ?>" id="chk_<?php echo $column->Field; ?>" value="<?php echo $column->Field; ?>"> <?php echo $column->Field; ?></div>
  <?php } ?>
<br clear="all">
