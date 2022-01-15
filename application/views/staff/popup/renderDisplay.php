<?php
    $nes_id = $staffInfo['nes_id'] ? $staffInfo['nes_id'] : '';
    $acnumber = $staffInfo['acnumber'] ? $staffInfo['acnumber'] : '';
    $ifsc = $staffInfo['ifsc'] ? $staffInfo['ifsc'] : '';
    $branchid = $staffInfo['branchid'] ? $staffInfo['branchid'] : '';
    $bank_name = $staffInfo['bank_name'] ? $staffInfo['bank_name'] : '';
?>
<div class="row">
    <div class="col-lg-12">
        <p><strong>Name: </strong><?php print $nes_id?></p>
        <p><strong>Email: </strong><?php print $acnumber?></p>
        <p><strong>Address: </strong><?php print $ifsc?></p>
        <p><strong>Phone: </strong><?php print $branchid?></p>
        <p><strong>Salary: </strong><?php print $bank_name?></p>
    </div>
</div><!-- /.row -->
