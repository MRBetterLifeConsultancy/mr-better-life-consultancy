<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-danger">
                        <div class="card-header ">
                            <h3 class="card-title">Deleted Prospect List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>ID</th>
                                        <th>Prospect Name</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Contact Person</th>
                                        <th>View</th>
                                        <th>Restore</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (!empty($prospects)) {
                                        $sno = 1;
                                        $helperModel = new App\Models\HelperModel();
                                        foreach ($prospects as $prospect) {
                                            ?>
                                            <tr>
                                                <td><?php echo $sno++ ?></td>
                                                <td><?php echo $prospect['prospect_id'] ?></td>
                                                <td><?php echo $prospect['prospect_name'] ?></td>
                                                <td><?php echo $prospect['city'] ?></td>
                                                <td><?php echo $prospect['phone'] ?></td>
                                                <td><?php echo $prospect['email'] ?></td>
                                                <td><?php echo $prospect['contact_name'] ?></td>
                                                <td>
                                                    Amount: <?php echo $helperModel->getIndianCurrency($prospect['amount'],'Rs.') ?> <br>
                                                    Amount Paid: <?php echo $helperModel->getIndianCurrency($prospect['amount_paid'],'Rs.') ?>
                                                </td>
                                                <td>
                                                    <button onclick="viewProspect(<?php echo $prospect['prospect_id'] ?>, this)" class='btn btn-block bg-gradient-info'>View</button>
                                                </td>
                                                <td>
                                                    <button onclick="restoreProspect(<?php echo $prospect['prospect_id'] ?>, this)" class='btn btn-block bg-gradient-success'>Restore</button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } 
                                    else 
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="8">No Records</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ./wrapper -->
<div class="modal fade" name="view_modal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <p class="modal-title">Prospect Info</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="name">Prospect Name</label>
                                <p name="name" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="city">City</label>
                                <p name="city" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="person">Contact Person</label>
                                <p name="person" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="phone">Phone</label>
                                <p name="phone" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="email">Email</label>
                                <p name="email" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="address">Address</label>
                                <p name="address" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="amount">Amount</label>
                                <p name="amount" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="amount_paid">Amount Paid</label>
                                <p name="amount_paid" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-gradient-light">
                <button type="button" class="btn bg-gradient-danger float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- delete modal -->
<div class="modal fade" name="restore_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-warning">
                <p class="modal-title">Restore Model</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickForm1">
                    <div class="form-group">
                        <label class="label">Do you want to restore this prospect?</label>
                    </div>
                    <input type="hidden" name="prospect_id" value="">
                    <button type="button" class="btn btn-primary" onclick='restoreProspectsAfterConfirmation(event,this)'>Restore</button>
                </form>
            </div>
            <div class="modal-footer bg-gradient-warning">
                <button type="button" class="btn bg-gradient-danger float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end of delete modal -->


<script>
    var Toast = null;
    $(function() {
        Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
    });

    function restoreProspect(prospectId) {
        $('[name="restore_modal"]').find('[name="prospect_id"]').val(prospectId);
        $('[name="restore_modal"]').modal('show');
    }

    function restoreProspectsAfterConfirmation(ev,e) {
        ev.preventDefault();
        enableDisableDiv('#quickForm1', false);
        var prospect_id = $('[name="restore_modal"]').find('[name="prospect_id"]').val();

        var submitData = {};
        submitData['prospect_id'] = prospect_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/deleted_prospects/restore',
            datatype: 'json',
            type: 'POST',
            data: submittedData,

            success: function(response) {
                enableDisableDiv('#quickForm1', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1) {
                    toastr.success(receivedData.message);
                    if (receivedData.redirect_url) {
                        window.location.href = receivedData.redirect_url;
                    }
                } else {
                    toastr.error(receivedData.message);
                    // alert(receivedUpdateData.message)
                }
            },
            error: function() {
                enableDisableDiv('#quickForm1', true);
                toastr.error("Refresh the page and try again");
            }
        });

    }

    function viewProspect(prospect_id, e)
    {
        enableDisableDiv('#datatable', false);
        var submitData = {};
        submitData['prospect_id'] = prospect_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/prospect/info',
            datatype: 'json',
            type: 'POST',
            data: submittedData,

            success: function (response)
            {
                enableDisableDiv('#datatable', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    var receivedDataArray = receivedData.prospects;
                    $.each(receivedDataArray, function (idx, row)
                    {
                        $('[name="view_modal"]').find('[name="name"]').text(row.prospect_name);
                        $('[name="view_modal"]').find('[name="city"]').text(row.city);
                        $('[name="view_modal"]').find('[name="person"]').text(row.contact_name);
                        $('[name="view_modal"]').find('[name="phone"]').text(row.phone);
                        $('[name="view_modal"]').find('[name="email"]').text(row.email);
                        $('[name="view_modal"]').find('[name="address"]').text(row.address);
                        $('[name="view_modal"]').find('[name="amount"]').text('Rs.' + row.amount);
                        $('[name="view_modal"]').find('[name="amount_paid"]').text('Rs.' + row.amount_paid);
                        $('[name="view_modal"]').find('[name="edit_button"]').data("id", row.prospect_id);
                    });
                    $('[name="view_modal"]').modal('show');


                }
                else 
                {
                    toastr.error(receivedData.message);
                }
            },
            error: function ()
            {
                enableDisableDiv('#datatable', true);
                toastr.error("Refresh the page and try again")
            }
        });
    } 
</script>