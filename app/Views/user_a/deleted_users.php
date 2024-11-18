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
                            <h3 class="card-title">Deleted User List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>City</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Contact Person</th>
                                        <!-- <th class="<?php //echo ($g_user_type != 'admin') ? 'd-none' : '' ?>">User</th> -->
                                        <th>View</th>
                                        <th>Restore</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (!empty($users)) {
                                        $sno = 1;
                                        $helperModel = new App\Models\HelperModel();
                                        foreach ($users as $user) {
                                            ?>
                                            <tr>
                                                <td><?php echo $sno++ ?></td>
                                                <td><?php echo $user['user_id'] ?></td>
                                                <td><?php echo $user['user_name'] ?></td>
                                                <td><?php echo $user['city'] ?></td>
                                                <td><?php echo $user['phone'] ?></td>
                                                <td><?php echo $user['email'] ?></td>
                                                <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
                                                <!-- <td class="<?php //echo ($g_user_type != 'admin') ? 'd-none' : '' ?>"><?php echo $user['user_name'] . " - " . $user['city'] ?></td> -->
                                                <td>
                                                    <button onclick="viewUser(<?php echo $user['user_id'] ?>, this)" class='btn btn-block bg-gradient-info'>View</button>
                                                </td>
                                                <td>
                                                    <button onclick="restoreUser(<?php echo $user['user_id'] ?>, this)" class='btn btn-block bg-gradient-success'>Restore</button>
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

<div class="modal fade" name="view_modal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <p class="modal-title">User Info</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="name">User Name</label>
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
                                <label for="address">Address</label>
                                <p name="address" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4 <?php echo ($g_user_type != 'admin') ? 'd-none' : '' ?>">
                            <div class="form-group view-modal-item">
                                <label for="phone">User</label>
                                <p name="user" class="form-control-static"></p>
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
                        <label class="label">Do you want to restore this user?</label>
                    </div>
                    <input type="hidden" name="user_id" value="">
                    <button type="button" class="btn btn-primary" onclick='restoreUsersAfterConfirmation(event,this)'>Restore</button>
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

    function restoreUser(userId) {
        $('[name="restore_modal"]').find('[name="user_id"]').val(userId);
        $('[name="restore_modal"]').modal('show');
    }

    function restoreUsersAfterConfirmation(ev,e) {
        ev.preventDefault();
        enableDisableDiv('#quickForm1', false);
        var user_id = $('[name="restore_modal"]').find('[name="user_id"]').val();

        var submitData = {};
        submitData['user_id'] = user_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/deleted_users/restore',
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

    function viewUser(user_id, e)
    {
        enableDisableDiv('#datatable', false);
        var submitData = {};
        submitData['user_id'] = user_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/user/info',
            datatype: 'json',
            type: 'POST',
            data: submittedData,

            success: function (response)
            {
                enableDisableDiv('#datatable', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    var receivedDataArray = receivedData.users;
                    $.each(receivedDataArray, function (idx, row)
                    {
                        $('[name="view_modal"]').find('[name="name"]').text(row.user_name);
                        $('[name="view_modal"]').find('[name="user"]').text(row.user_name + " - " + row.city);
                        $('[name="view_modal"]').find('[name="city"]').text(row.city);
                        $('[name="view_modal"]').find('[name="person"]').text(row.first_name + " " + row.last_name);
                        $('[name="view_modal"]').find('[name="phone"]').text(row.phone);
                        $('[name="view_modal"]').find('[name="address"]').text(row.address);
                        $('[name="view_modal"]').find('[name="edit_button"]').data("id", row.user_id);
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