<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		Accounts Dashboard
	</h1>
		<ol class="breadcrumb">
		<li><a href="http://192.168.2.101/light/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Accounts</a></li>
		<li class="active">Dashboard</li>
	</ol></section>
<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-money"></i> <?php if(isset($_SESSION['user'])){echo $_SESSION['user'];}?>
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Item</th>
              <th>Serial #</th>
              <th>Description</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>Opening Balance</td>
              <td></td>
              <td></td>
              <td>&#8377; 64.50</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Last Day Collection</td>
              <td></td>
              <td></td>
              <td>&#8377; 50.00</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Bank Deposit</td>
              <td></td>
              <td></td>
              <td>&#8377; 10.70</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Cheque</td>
              <td></td>
              <td></td>
              <td>&#8377; 25.99</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Total Collection on 2/10/2019</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Credit:</th>
                <td>&#8377; 250.30</td>
              </tr>
              <tr>
                <th>Debit:</th>
                <td>&#8377; 5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>&#8377; 265.24</td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<?php include '_footer.php'; ?>
