<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
      <h1>
        Navadarsan Light Dashbaord
        <small>Version 2.1</small>
      </h1>
    </section>
    <section class="content ">
<div class="row ">
        <div class="col-md-3">
          <div class="info-box w3-allerta">
            <span class="info-box-icon bg-aqua w3-allerta"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content ">
              <span class="info-box-text">Active Members</span>
              <span class="info-box-number"><?php echo $active; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3">
          <div class="info-box w3-allerta">
            <span class="info-box-icon bg-green w3-allerta"><i class="fa ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Closed Members</span>
              <span class="info-box-number"><?php echo $closed; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
           <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-yellow w3-allerta"><i class="fa ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Nidhi Members</span>
              <span class="info-box-number"><?php echo $nidhi; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-red w3-allerta"><i class="fa ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Scheme Members</span>
              <span class="info-box-number"><?php echo $notnidhi; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>


      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid box-success" style="background: #a0e0ed;">
            <div class="box-header with-border">
              <i class="fa fa-text-width"></i>

              <h3 class="box-title">Golden Rules</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body w3-allerta">
              <ul>
                <li>Take time to make an entry, double check before you save. Remember "Slower is Faster".</li>
                <li>If a field is incomplete / unclear? do not enter it. No data is better than wrong data.</li>
                <li><b>Beneficiary</b>
                  <ul>
                    <li>Aadhar Number is a must fill field for new members</li>
                    <li>Remember to upload the "Tally Account Close List" at the end of every month. This helps to keep the accurate record of shares and accounts.</li>
                    <li>Check for orphan shares and issue existing orphan shares before issuing new shares </li>
                  </ul>

                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

  </section>
<?php include '_footer.php'; ?>
