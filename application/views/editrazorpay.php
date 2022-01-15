<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
    <h1>
        Edit Razorpay
        <small>[Razorpay]</small>
    </h1>
    <?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
    <form method="post" id="editrazorpayForm"
        action="<?php echo $site_url;?>editrazorpay">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12 w3-allerta">
                <!-- general form elements -->
                <!-- Input addon -->
                <div class="box box-danger form-group" style="background: #a4a4a4;">
                    <!-- <div class="box-header with-border">
                        <h3 class="box-title">Razorpay</h3>
                    </div> -->
                    <div class="">
                        <div class="col-md-2 ">
                            <div class="form-group">
                                <label for="txtFrom">From Date</label>
                                <input type="text" class="form-control" name="txtFrom" id="txtFrom">
                            </div>
                        </div>
                        <div class="col-md-2" style="white-space: nowrap;">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button id="fetch-btn" type="button" style="display:block"
                                    class="btn btn-md btn-primary">Fetch</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="input-group input-daterange">
                            <input type="text" class="form-control" name="txtFrom" id="txtFrom" value="2012-04-05">
                            <div class="input-group-addon">to</div>
                            <input type="text" class="form-control" name="txtFrom" id="txtTo" value="2012-04-19">
                        </div>
                    </div> -->
                    <!-- data table -->
                    <div class="container-fluid ">
                        <table id="razorpayDataTable" class="table table-hover table-bordered w3-allerta "
                            style="table-layout: auto; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nes Id</th>
                                    <th>Beneficiary Id</th>
                                    <th>Member name</th>
                                    <th>Corret Memeber Name</th>
                                    <th>Forum</th>
                                    <th>forum Currect</th>
                                    <th>BeneficiaryName</th>
                                    <th>Date</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            foreach ($razorpayDetails as $key => $value) {
                $rowId = intval(htmlspecialchars($value->id));
                $nesID = htmlspecialchars($value->beneficiary_id);
                $beneficiaryId = htmlspecialchars($value->nesidcorrect);
                $memberName = htmlspecialchars($value->member_name);
                $forumCurrect = htmlspecialchars($value->forumcurrect);
                $forum = htmlspecialchars($value->forum);
                $correctmemeberName = htmlspecialchars($value->memeberName);
                $beneficiaryName = htmlspecialchars($value->beneficiaryName);
                $date = htmlspecialchars($value->settled_date);
                $date = explode(' ', $date);
                $date = (isset($date[0])) ? $date[0] : '';
                $phone = htmlspecialchars($value->phone);
                if ($date) {
                    $date = date_create_from_format("Y-m-d", $date);
                    $date = date_format($date, "d M Y");
                } ?>
                                <tr
                                    data-razor-rowid="<?php echo $rowId; ?>">
                                    <td><?php echo $nesID; ?>
                                    </td>
                                    <td class="ben-id"><?php echo $beneficiaryId; ?>
                                    </td>
                                    <td><?php echo $memberName; ?>
                                    </td>
                                    <td class="corret-member-name"><?php echo $correctmemeberName; ?>
                                    </td>
                                    <td><?php echo $forum; ?>
                                    </td>
                                    <td class="forum-correct"><?php echo $forumCurrect; ?>
                                    </td>
                                    <td class="ben-name"><?php echo $beneficiaryName; ?>
                                    </td>
                                    <td><?php echo $date; ?>
                                    </td>
                                    </td>
                                    <td><?php echo $phone; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit edit-data" data-toggle="modal"
                                            data-target="#myModal"
                                            data-razorpay-id="<?php echo $rowId; ?>">Edit</button>
                                    </td>
                                </tr>
                                <?php
            }
                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nes Id</th>
                                    <th>Beneficiary Id</th>
                                    <th>Member name</th>
                                    <th>Corret Memeber Name</th>
                                    <th>Forum</th>
                                    <th>forum Currect</th>
                                    <th>BeneficiaryName</th>
                                    <th>Date</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <input type="hidden" name="editrazorpay" value="true" id="editrazorpay">

            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </form>
    <!--?php echo $site_url;?-->
</section>
<!-- Modal -->
<div class="modal fade " id="myModal" role="dialog">
    <div class="container-fluid modal-dialog modal-lg ">

        <!-- Modal content-->
        <form class="modal-content st bg-black">
            <input type="hidden" value="" id="razorPayId" value="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="justify-content:center; align-items: center;">Modal Header</h4>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group modal-body bg-black-gradient">
                        <label for="beneficiary-id" style="color: yellow;">Beneficiary Id</label>
                        <input type="text" class="form-control " id="beneficiary-id" disabled " >
                    </div>
                </div>
                <div class=" col-md-4">
                        <div class="form-group modal-body bg-black-gradient">
                            <label for="nes-id" style="color: yellow;">Correct Nes Id</label>
                            <input type=" text" class="form-control" id="nes-id" style="background-color: #b5f9be;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group modal-body bg-black-gradient">
                            <label for="ms-id" style="color: yellow;">M S Id</label>
                            <input type="text" id="ms-id" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class=" form-group modal-body bg-black-gradient">
                            <label for="membername" style="color: yellow;">Member Name</label>
                            <input type="text" class="form-control" id="membername" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group modal-body bg-black-gradient">
                            <label for="Ben" style="color: yellow;">Beneficiary Name</label>
                            <input type="text" class="form-control" id="Ben" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group modal-body bg-black-gradient">
                            <label for="Forum" style="color: yellow;">Forum</label>
                            <input type="text" class="form-control" id="Forum" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group modal-body bg-black-gradient">
                            <label for="Cmembername" style="color: yellow;">Correct Member Name</label>
                            <input type="text" class="form-control " id="Cmembername" style="background-color: #b5f9be;"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group modal-body bg-black-gradient">
                            <label for="benName" style="color: yellow;">Correct Beneficiary Name</label>
                            <input type="text" class="form-control" id="benName" style="background-color: #b5f9be;"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group modal-body bg-black-gradient">
                            <label for="CForum" style="color: yellow;">Correct Forum</label>
                            <input type="text" class="form-control" id="CForum" style="background-color: #b5f9be;"
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="content form-group modal-body" style="max-height: 200px;overflow-y: scroll; display:none;"
                    id="member-result">
                    <table class="table table-bordered ">
                        <thead class="table overflow: auto;">
                            <tr>
                                <th>Nes Id</th>
                                <th>Member name</th>
                                <th>Guardian name</th>
                                <th>Forum</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" id="save" class="btn btn-success" data-dismiss="modal">Save</button>
                </div>
        </form>
    </div>
</div>
<?php include '_footer.php'; ?>
<script>
    $(document).ready(function() {
        // $('#razorpayDataTable').DataTable();

        $('.edit-data').on('click', function() {
            $razorId = $(this).data('razorpay-id');

            $.ajax({
                url: '<?php echo $site_url;?>razor/getRazorDetailAjax',
                method: 'POST',
                data: {
                    razor_id: $razorId
                },
                success: function(data) {
                    // console.log(data);
                    var data = JSON.parse(data);
                    if (data.error) {
                        $('#beneficiary-id').val(data.data.beneficiary_id);
                        $('#nes-id').val(data.data.nesidcorrect);
                        $('#membername').val(data.data.member_name);
                        $('#Cmembername').val(data.data.memeberName);
                        $('#Ben').val(data.data.beneficiary_name);
                        $('#benName').val(data.data.beneficiaryName);
                        $('#Forum').val(data.data.forum);
                        $('#CForum').val(data.data.forumCurrect);
                        $('#razorPayId').val(data.data.id);
                    }
                }
            });
        });

        $('#nes-id,#ms-id').on('keyup', function() {

            var type = $(this).attr('id');
            type = (type == 'ms-id') ? 'share_member_id' : 'old_id';
            $.ajax({
                url: '<?php echo $site_url;?>razor/searchMembers',
                method: 'POST',
                data: {
                    old_id: $(this).val(),
                    column: type
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.length > 0) {
                        // console.log(data);
                        $('#member-result tbody').empty();
                        var html = '',
                            tblLength = data.length;
                        for (var i = 0; i < tblLength; i++) {
                            html += `<tr>
                                        <td>` + data[i].nes_id + `</td>
                                        <td>` + data[i].correct_name + `</td>
                                        <td>` + data[i].guardian_name + `</td>
                                        <td>` + data[i].education_forum + `</td>
                                    </tr>`;
                        }
                        $('#member-result tbody').append(html);
                        $('#member-result').show();
                    }
                }
            });
        });

        $('#save').on('click', function() {
            var id = $('#razorPayId').val();
            $.ajax({
                url: '<?php echo $site_url;?>razor/razorPayUpdate',
                method: 'POST',
                data: {
                    razorPayId: id,
                    nesidcorrect: $('#nes-id').val(),
                    memeberName: $('#Cmembername').val(),
                    beneficiaryName: $('#benName').val(),
                    forumcurrect: $('#CForum').val()
                },
                success: function(data) {
                    console.log(data);
                    var data = JSON.parse(data);
                    // if (!data.error) {
                    console.log(data);
                    $('#razorpayDataTable tbody').find('tr[data-razor-rowid="' + id +
                        '"] .forum-correct').text($('#CForum').val());
                    $('#razorpayDataTable tbody').find('tr[data-razor-rowid="' + id +
                        '"] .ben-name').text($('#benName').val());
                    $('#razorpayDataTable tbody').find('tr[data-razor-rowid="' + id +
                        '"] .corret-member-name').text($('#Cmembername').val());
                    $('#razorpayDataTable tbody').find('tr[data-razor-rowid="' + id +
                        '"] .ben-id').text($('#nes-id').val());
                    // }
                }
            });
        });

        $(document).on('click', '#member-result tbody tr td', function() {
            $('#nes-id').val($(this).parent().find('td').eq(0).text());
            $('#benName').val($(this).parent().find('td').eq(1).text());
            $('#Cmembername').val($(this).parent().find('td').eq(2).text());
            $('#CForum').val($(this).parent().find('td').eq(3).text());
            $('#member-result').hide();
        });
    });

    function verifyAccess() {
        if ($('#txtAccess').val() == 'nidhi2018') {
            $('#popAccess').css('display', 'none');
        } else {

        }
    }
    // $(function() {
    //             $("#txtFrom").datepicker();
    //             autoclose: true,
    // $('.input').each(function() {
    //     $(this).datepicker('clearDates');
    // });

    $('#txtFrom').datepicker({
        autoclose: true,
        format: 'dd M yyyy',
        endDate: '0d',
        todayHighlight: true
    });

    $('#fetch-btn').on('click', function() {
        var from = $('#txtFrom').val();
        var from = moment(from, 'DD MMM YYYY').format('YYYY-MM-DD');
        if (from == 'Invalid date') {
            alert('Date format incorrect');
            return;
        }
        window.location.assign(
            '<?php echo $site_url;?>razor/editrazorpay/' + from);
    });

    $("body").addClass('sidebar-collapse');
    console.log("without transition");
</script>