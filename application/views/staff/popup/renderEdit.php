<?php
    $id = $staffInfo['id'] ? $staffInfo['id'] : '';
    $nes_id = $staffInfo['name'] ? $staffInfo['name'] : '';
    $acnumber = $staffInfo['email'] ? $staffInfo['email'] : '';
    $ifsc = $staffInfo['address'] ? $staffInfo['address'] : '';
    $branchid = $staffInfo['mobile'] ? $staffInfo['mobile'] : '';
    $bank_name = $staffInfo['salary'] ? $staffInfo['salary'] : '';
?>
<input type="hidden" name="neftaccountclosed_id" value="<?php print $id; ?>">
<div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="name" class="form-control input-staff-firstname" id="name" placeholder="Name" value="<?php print $nes_id; ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="email" class="form-control input-staff-email" id="email" placeholder="Email" value="<?php print $acnumber; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="address" class="form-control input-staff-address" id="address" placeholder="Address" value="<?php print $ifsc; ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="mobile" class="form-control input-staff-mobile" id="mobile" placeholder="mobile No" value="<?php print $branchid; ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="text" name="salary" class="form-control input-staff-salary" id="salary" placeholder="Salary" value="<?php print $bank_name; ?>">
            </div>
        </div>
    </div>
