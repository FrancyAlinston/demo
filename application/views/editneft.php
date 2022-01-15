<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<style>
    #neftDataTable tbody tr:nth-child(odd) input {
        background-color: #f9f9f9;
    }

    #neftDataTable tbody tr:nth-child(even) input {
        background-color: #e6dcff;

    }
</style>
<?php //echo $neft;?>
<section class="content-header">
    <h1>
        Edit NEFT Account Clossing
        <small>[Account clossing NEFT]</small>
    </h1>
    <?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
    <form method="post" id="editneft"
        action="<?php echo $site_url;?>neft">

        <div class="row ">

            <!-- left column -->
            <div class="col-md-12 ">

                <!-- general form elements -->
                <!-- Input addon -->

                <div class="box box-danger w3-allerta" style="background: #e6dcff;">

                    <div style="border-left: 1px solid #ccc; overflow: hidden;" class="col-md-offset-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtFrom">From Date</label>
                                    <input type="text" class="form-control" name="txtFrom" id="txtFrom">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txtTo">To Date</label>
                                    <input type="text" class="form-control" name="txtTo" id="txtTo">
                                </div>
                            </div>
                            <div class="col-md-4" style="white-space: nowrap;">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button id="export-btn" type="button" style="display:block"
                                        class="btn btn-md btn-primary">Tally Export</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Bank Details</h3>
                    </div>
                    <!-- data table -->
                    <table id="neftDataTable" class="table table-striped table-bordered w3-allerta" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nes id</th>
                                <th>Acc no</th>
                                <th>Acc name</th>
                                <th>IFSC</th>
                                <th>Branch code</th>
                                <th>Bank name</th>
                                <th>Scheme amt</th>
                                <th>Nidhi amt</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
            // print_r($neftDetails);
            foreach ($neftDetails as $key => $value) {
                $rowId = intval(htmlspecialchars($value->id));
                $nesId = htmlspecialchars($value->nes_id);
                $accNo = htmlspecialchars($value->acnumber);
                $accName = htmlspecialchars($value->acname);
                $ifsc = htmlspecialchars($value->ifsc);
                $branchCode = htmlspecialchars($value->branchid);
                $bankName = htmlspecialchars($value->bank_name);
                $schemeAmt = htmlspecialchars($value->scheme_amt);
                $nidiAmt = htmlspecialchars($value->nidhi_amt);
                $date = htmlspecialchars($value->date);
                $date = explode(' ', $date);
                $date = (isset($date[0])) ? $date[0] : '';
                if ($date) {
                    $date = date_create_from_format("Y-m-d", $date);
                    $date = date_format($date, "d M Y");
                } ?>
                            <tr contenteditable="false">
                                <td class="nesId"><?php echo $nesId; ?>
                                </td>
                                <td class="accNo"><?php echo $accNo; ?>
                                </td>
                                <td class="accName"><?php echo $accName; ?>
                                </td>
                                <td class="ifsc"><?php echo $ifsc; ?>
                                </td>
                                <td class="branchCode"><?php echo $branchCode; ?>
                                </td>
                                <td class="bankName"><?php echo $bankName; ?>
                                </td>
                                <td class="schemeAmt"><?php echo $schemeAmt; ?>
                                </td>
                                <td class="nidiAmt"><?php echo $nidiAmt; ?>
                                </td>
                                <td class="date"><input type="text"
                                        value="<?php echo $date; ?>">
                                </td>

                                <td>
                                    <button type="button" class="btn btn-primary edit"
                                        data-neft-id="<?php echo $rowId; ?>">Edit</button>
                                    <!-- <button type="button" class="btn btn-danger delete" data-neft-id="<!?php echo $rowId;?>">Delete</button> -->
                                </td>
                            </tr>
                            <?php
            }
            ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nes id</th>
                                <th>Acc no</th>
                                <th>Acc name</th>
                                <th>IFSC</th>
                                <th>Branch code</th>
                                <th>Bank name</th>
                                <th>Scheme amt</th>
                                <th>Nidhi amt</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <input type="hidden" name="neftaccountclose" value="true" id="neftaccountclose">

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </form>
    <!--?php echo $site_url;?-->
</section>
<?php include '_footer.php'; ?>
<script>
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $(document).ready(function() {
        $('#neftDataTable').DataTable({
            // "ajax": 'http://192.168.0.12/light1/neft/'
        });


        $('.date input').attr('readonly', true);

        $(document).on('click', '#neftDataTable tbody td button.edit', function() {

            console.log('hai');

            var rowId = $(this).data('neft-id');


            // $(this).parent().parent().find('td').eq(0).click();
            if ($(this).parent().parent().hasClass('edit')) {
                $(this).parent().parent().attr('contenteditable', false);
                $(this).parent().parent().removeClass('edit');
                $(this).text('Edit');
                $(this).removeClass('btn-success');
                $(this).addClass('btn-primary');
                $('.date input').datepicker('remove');
                $('.date input').attr('readonly', true);


                var datas = {
                    id: rowId,
                    nesId: $(this).parent().parent().find('.nesId').text(),
                    accNo: $(this).parent().parent().find('.accNo').text(),
                    accName: $(this).parent().parent().find('.accName').text(),
                    ifsc: $(this).parent().parent().find('.ifsc').text(),
                    branchCode: $(this).parent().parent().find('.branchCode').text(),
                    bankName: $(this).parent().parent().find('.bankName').text(),
                    schemeAmt: $(this).parent().parent().find('.schemeAmt').text(),
                    nidiAmt: $(this).parent().parent().find('.nidiAmt').text(),
                    date: $(this).parent().parent().find('.date input').val(),


                };

                $.ajax({
                    url: '<?php echo $site_url;?>neft/update/',
                    // url : 'http://192.168.0.12/light1/neft/',
                    method: 'POST',
                    data: datas,
                    success: function(data) {
                        // console.log(data);
                        var msg = JSON.parse(data);
                        if (!msg.error) {
                            alert('Updated Sucessfully!');
                        }
                    }
                });

            } else {
                $(this).parent().parent().attr('contenteditable', true);
                $(this).parent().parent().addClass('edit');
                $(this).text('Save');
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-success');
                $('.date input').datepicker({
                    format: 'dd M yyyy'
                });
                $('.date input').attr('readonly', false);

            }




        });


    });


    // $('#txtFrom,#txtTo').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
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
            url: '<?php echo $site_url;?>Export/neftExport/',
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

    $("body").addClass('sidebar-collapse');
    console.log("without transition");
</script>