</div>
<iframe src="" id="exportFrame" style="margin-left:-1000px; height: 10px"></iframe>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.1
    </div>
    <strong>Copyright &copy; 2017-2018 Navadarsan Light.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li id="accountsTab"><a href="#control-sidebar-home-tab" data-toggle="tab"><?php if(isset( $_SESSION['user'])){ echo $_SESSION['user']; } ?></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <ul class="control-sidebar-menu">
        <?php if(isset( $_SESSION['user']) && $_SESSION['user'] !='Accounts Admin'){ ?>
          <li>
            <a href="<?php echo $site_url; ?>accounts/addvoucher">
              <i class="menu-icon fa fa-user bg-red"></i>

              <div class="menu-info" >
                <h4 class="control-sidebar-subheading">Add Voucher</h4>

                <p>Account Manager Login</p>
              </div>
            </a>
          </li>
        <?php }else{ ?>
          <li>
            <a href="<?php echo $site_url; ?>accounts/">
              <i class="menu-icon fa fa-user bg-red"></i>

              <div class="menu-info" >
                <h4 class="control-sidebar-subheading">Accounts Login</h4>
              </div>
            </a>
          </li>
        <?php } ?>
        <?php if(isset( $_SESSION['user'])){ ?>
          <li>
            <a href="<?php echo $site_url; ?>accounts/summary">
              <i class="menu-icon fa fa-user bg-yellow"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Daily Summary</h4>
              </div>
            </a>
          </li>
          <li>
            <a href="<?php echo $site_url; ?>accounts/dailyunprinted">
              <i class="menu-icon fa fa-print bg-green"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Daily UnPrinted</h4>
              </div>
            </a>
          </li>
          <li>
            <a href="<?php echo $site_url; ?>accounts/filter">
              <i class="menu-icon fa fa-list bg-green"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Transaction Filter</h4>
              </div>
            </a>
          </li>
          <li>
            <a href="<?php echo $site_url; ?>accounts/incentivecalculator">
              <i class="menu-icon fa fa-list bg-green"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Incentive Calculator</h4>
              </div>
            </a>
          </li>

          <?php } ?>
          <?php if(isset( $_SESSION['user']) && $_SESSION['user'] =='Accounts Admin'){ ?>
          <li>
            <a href="<?php echo $site_url; ?>accounts/transactionshistory">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Transactions History</h4>
              </div>
            </a>
          </li>
          <?php } ?>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Search suggest -->

<div id="searchSuggest" style="display: none">
</div>

<!-- Modal Window -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade " id="scapeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="scapeModalTitle">Modal title</h4>
      </div>
      <div class="modal-body" id="scapeModalBody">
        ...
      </div>
      <div class="modal-footer" id="scapeModalFooter" >
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Alert Message -->
<!-- Hidden Fileds -->
<input type="hidden" name="mainMenu" id="mainMenu" value="<?php if(isset($_SESSION['m_menu'])){echo $_SESSION['m_menu'];}?>">
<input type="hidden" name="subMenu" id="subMenu" value="<?php if(isset($_SESSION['s_menu'])){echo $_SESSION['s_menu'];}?>">
<!-- jQuery 3 -->
<script src="<?php echo $site_url; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $site_url; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $site_url; ?>assets/scripts/jquery.easy-autocomplete.min.js"></script>
<!-- DataTables -->
<script src="<?php echo $site_url; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $site_url; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $site_url; ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $site_url; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $site_url; ?>dist/js/demo.js"></script>

<!-- InputMask -->
<script src="<?php echo $site_url; ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $site_url; ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $site_url; ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $site_url; ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo $site_url; ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo $site_url; ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $site_url; ?>assets/scripts/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo $site_url; ?>assets/scripts/bootstrap-notify.min.js"></script>
<script src="<?php echo $site_url; ?>assets/scripts/bootstrap-select.min.js"></script>
<script src="<?php echo $site_url; ?>assets/scripts/jquery.webui-popover.min.js"></script>
<script src="<?php echo $site_url; ?>assets/scripts/jquery.doubleScroll.js"></script>
<script src="<?php echo $site_url; ?>assets/scripts/engine.js"></script>
</body>
</html>
