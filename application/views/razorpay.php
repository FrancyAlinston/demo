<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
    <div>
        <h1 class="st">RazerPay Export</h1>
    </div>
    <!-- <h2 style="margin: auto; text-align: center;color: red;">[!!! UNDER MAINTANENCE !!!]</h2> -->
    <?php include '_breadcrumbs.php'; ?>
    <div class="box box-info w3-allerta" style="margin-top: 10px; background: #a0e0ed;">
        <div style="overflow: hidden; margin-top: 20px;" class="col-md-offset-1 w3-allerta">
            <div class="row" style="margin-right:auto; margin-left:auto;">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label for="txtFrom">From Date</label>
                        <input type="text" class="form-control" name="txtFrom" id="txtFrom"
                            style="background: #c2c0ba;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group w">
                        <label for="txtTo">To Date</label>
                        <input type="text" class="form-control" name="txtTo" id="txtTo" style="background: #c2c0ba;">
                    </div>
                </div>
                <div class="col-md-4" style="white-space: nowrap; ">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button id="export-btn" type="button" style="display:block"
                            class="btn btn-md btn-success fixed-right">Tally Export</button>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include '_footer.php'; ?>
<script>
    $('#txtFrom,#txtTo').datepicker({
        autoclose: true,
        format: 'dd M yyyy',
        endDate: '0d',
        todayHighlight: true
    });


    $('#export-btn').on('click', function() {

        var from = $('#txtFrom').val();
        var to = $('#txtTo').val();

        if (!to) {
            var date = new Date();
            var day = date.getDate();
            if (day < 10) {
                day = '0' + day;
            }

            var month = date.getMonth();


            month = months[month];
            var year = date.getFullYear();
            to = day + ' ' + month + ' ' + year;
        }

        // console.log(from);
        // console.log(to);

        $.ajax({
            url: '<?php echo $site_url;?>Export/razorExport/',
            method: 'POST',
            data: {
                dateFrom: from,
                dateTo: to
            },
            success: function(data) {
                console.log(data);
                var msg = JSON.parse(data);
                if (!msg.error) {
                    window.location.assign(msg.msg);
                }
            }
        });


    });

    function verifyAccess() {
        if ($('#txtAccess').val() == 'nidhi2018') {
            $('#popAccess').css('display', 'none');
        } else {

        }
    }
</script>