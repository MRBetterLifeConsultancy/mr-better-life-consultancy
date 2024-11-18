<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h2 class="card-title">Search Prospects</h2>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body ">
                            <form name="quickForm" id="quickForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date From</label>
                                            <input type="text" name="date_from" class="form-control datetimepicker-input" data-toggle="datetimepicker" placeholder="yyyy-mm-dd" value="<?php echo $df ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Date To</label>
                                            <input type="text" name="date_to" class="form-control datetimepicker-input" data-toggle="datetimepicker" placeholder="yyyy-mm-dd" value="<?php echo $dt ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Prospect Name</label>
                                            <input type="text" name="name" class="form-control" value="<?php
                                            if ($name != "")
                                            {
                                                echo $name;
                                            }
                                            else
                                            {
                                                echo "";
                                            }
                                            ?>" placeholder="Prospect Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" class="form-control" value="<?php
                                            if ($phone != "")
                                            {
                                                echo $phone;
                                            }
                                            else
                                            {
                                                echo "";
                                            }
                                            ?>" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" class="form-control" value="<?php
                                            if ($email != "")
                                            {
                                                echo $email;
                                            }
                                            else
                                            {
                                                echo "";
                                            }
                                            ?>" placeholder="Email">
                                        </div>
                                        <?php
                                            $total_count = $prospects_count;
                                            $records_per_page = 100;
                                            $from = 1;
                                            $pages = array();
                                            $no_of_pages = intdiv($total_count, $records_per_page);
                                            $reminder = $total_count % $records_per_page;
                                            for ($i = 0; $i < $no_of_pages; $i++) {
                                                array_push($pages, ($i * $records_per_page) + 1);
                                            }
                                            ?>
                                            <div class="form-group d-none">
                                                <label>Records Per Page</label>
                                                <select class="form-control" name="per_page" id="per_page" style="width: 100%;">
                                                    <option <?php ($records_per_page == 100) ? "selected" : "" ?> value="100">100</option>
                                                    <option <?php ($records_per_page == 200) ? "selected" : "" ?> value="200">200</option>
                                                    <option <?php ($records_per_page == 300) ? "selected" : "" ?> value="300">300</option>
                                                    <option <?php ($records_per_page == 400) ? "selected" : "" ?> value="400">400</option>
                                                    <option <?php ($records_per_page == 500) ? "selected" : "" ?> value="500">500</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Page</label>
                                                <select class="form-control custom-select2 modal-select" name="page" id="page" style="width: 100%;">
                                                    <?php
                                                    foreach ($pages as $page) {
                                                    ?>
                                                        <option <?php
                                                                if ($offset == ($page - 1)) {
                                                                    echo 'selected = "selected"';
                                                                }
                                                                ?> value="<?php echo $page - 1 ?>"><?php echo $page . " - " . ($page + $records_per_page - 1) ?></option>
                                                    <?php
                                                    }
                                                    if ($reminder) {
                                                    ?>
                                                        <option <?php  if ($offset == ($total_count - $reminder)) {
                                                                echo 'selected = "selected"';
                                                            } ?> value="<?php echo ($total_count - $reminder) ?>"><?php echo ($total_count - $reminder + 1) . " - " . $total_count ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary float-right" onclick="searchProspects(event, this)">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <p><?php echo $prospects_count ?> - records found with search filters</p>
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
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-cyan">
                        <div class="card-header ">
                            <h3 class="card-title">Prospects List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Created On</th>
                                            <th>Prospect Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>View</th>
                                            <th>Follow Up</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $helperModel = new App\Models\HelperModel();
                                        if (!empty($prospects))
                                        {
                                            $sno = 1;
                                            foreach ($prospects as $prospect)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $sno++ ?></td>
                                                    <td><?php echo $helperModel->get_d_MM_Y_h_ia_from_date_string($prospect['created_on']) ?></td>
                                                    <td><?php echo $prospect['prospect_name'] ?></td>
                                                    <td><?php echo $prospect['phone'] ?></td>
                                                    <td><?php echo $prospect['email'] ?></td>
                                                    <td><?php echo $prospect['subject'] ?></td>
                                                    <td>
                                                        <button onclick="viewProspect(<?php echo $prospect['prospect_id'] ?>, this)" class='btn btn-block bg-gradient-primary'>View</button>
                                                    </td>
                                                    <td>
                                                        <button onclick="viewFollowUp(<?php echo $prospect['prospect_id'] ?>, this)" class='btn btn-block bg-gradient-info'>View Follow Ups</button>
                                                        <button onclick="addFollowUp(<?php echo $prospect['prospect_id'] ?>, this)" class='btn btn-block bg-gradient-success'>Add Follow Up</button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                                <td colspan="5">No Records</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-12">

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
<!-- view modal -->
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
                                <label for="subject">Subject</label>
                                <p name="subject" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="description">Description</label>
                                <p name="description" class="form-control-static"></p>
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

<div class="modal fade" name="view_follow_up_modal">
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
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>S.No</th>
                                    <th>Created On</th>
                                    <th>Message</th>
                                </thead>
                                <tbody name="follow_up_list">
                                </tbody>
                            </table>
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
<!-- view modal end -->

<!-- edit modal -->
<!-- /.modal -->
<div class="modal fade" name="add_follow_up_modal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <p class="modal-title">Update Prospect</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickFormAddFollowUp">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="name">Prospect Name</label>
                                <p name="name" class="form-control-static"></p>
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
                                <label for="subject">Subject</label>
                                <p name="subject" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="description">Description</label>
                                <p name="description" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group required d-none">
                                <label for="prospect_id">Prospect ID</label>
                                <input type="text" name="prospect_id" class="form-control" placeholder="Prospect ID">
                            </div>
                            <div class="form-group">
                                <label for="message">Follow Up Message</label>
                                <textarea class="form-control" placeholder="message" name="message"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="updateFollowUp(event, this)">Update</button>
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
<!-- /.modal -->

<script>

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
                        $('[name="view_modal"]').find('[name="phone"]').text(row.phone);
                        $('[name="view_modal"]').find('[name="email"]').text(row.email);
                        $('[name="view_modal"]').find('[name="subject"]').text(row.subject);
                        $('[name="view_modal"]').find('[name="description"]').text(row.description);
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

    function addFollowUp(prospect_id)
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
                        $('[name="add_follow_up_modal"]').find('[name="name"]').text(row.prospect_name);
                        $('[name="add_follow_up_modal"]').find('[name="phone"]').text(row.phone);
                        $('[name="add_follow_up_modal"]').find('[name="email"]').text(row.email);
                        $('[name="add_follow_up_modal"]').find('[name="subject"]').text(row.subject);
                        $('[name="add_follow_up_modal"]').find('[name="description"]').text(row.description);
                        $('[name="add_follow_up_modal"]').find('[name="prospect_id"]').val(row.prospect_id);
                    });
                    $('[name="add_follow_up_modal"]').modal('show');
                }
                else 
                {
                    toastr.error(receivedData.message);
                }
            },
            error: function ()
            {
                enableDisableDiv('#datatable', false);
                toastr.error("Refresh the page and try again");
            }
        });
    }

    function updateFollowUp(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#datatable', false);

        prospect_id = $('[name="add_follow_up_modal"]').find('[name="prospect_id"]').val();
        message = $('[name="add_follow_up_modal"]').find('[name="message"]').val();

        var submitData = {};
        submitData['prospect_id'] = prospect_id;
        submitData['message'] = message;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/view_edit_prospects/add_follow_up',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#datatable', true);

                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1)
                {
                    if (receivedData.redirect_url)
                    {
                        window.location.href = receivedData.redirect_url;
                    }
                }
                else
                {
                    toastr.error(receivedData.message);
                }
            },
            error: function ()
            {
                enableDisableDiv('#datatable', false);
                toastr.error("Refresh the page and try again");
            }
        });
    }

    function viewFollowUp(prospect_id, e)
    {
        enableDisableDiv('#datatable', false);
        var submitData = {};
        submitData['prospect_id'] = prospect_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/prospect/follow_up',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#datatable', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    var receivedDataArray = receivedData.follow_ups;
                    row_template = '';
                    sno = 1;
                    $.each(receivedDataArray, function (idx, row)
                    {
                        row_template += '<tr><td>'+ sno +'</td><td>'+ formatDate(row.datetime, "dddd, mmmm dS, yyyy hh:mm:ss tt") +'</td><td>'+ row.message +'</td></tr>';
                        sno += 1;
                    });
                    $('[name="view_follow_up_modal"]').find('[name="follow_up_list"]').html(row_template);
                    $('[name="view_follow_up_modal"]').modal('show');
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

    function searchProspects(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#quickForm', false);
        var date_from = $('#quickForm').find('[name="date_from"]').val();
        var date_to = $('#quickForm').find('[name="date_to"]').val();
        var name = $('#quickForm').find('[name="name"]').val();
        var phone = $('#quickForm').find('[name="phone"]').val();
        var email = $('#quickForm').find('[name="email"]').val();
        var offset = $('#quickForm').find('[name="page"]').val();

        var submitData = {};
        submitData['date_from'] = date_from;
        submitData['date_to'] = date_to;
        submitData['name'] = name;
        submitData['phone'] = phone;
        submitData['email'] = email;
        submitData['offset'] = offset;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/view_edit_prospects/search',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#quickForm', true);

                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1)
                {
                    // alert('hi')
                    // toastr.success('Unit search list.');
                    if (receivedData.redirect_url)
                    {
                        window.location.href = receivedData.redirect_url;
                    }
                }
                else
                {
                    toastr.error(receivedData.message);
                }

            },
            error: function ()
            {
                enableDisableDiv('#quickForm', true);
                toastr.error("Refresh the page and try again");
                // alert("Refresh the page and try again")
            }
        });
    }

    // form edit validation
    $('#quickFormAddFollowUp').validate({
        rules: {
            message: {
                required: true
            },
        },
        messages: {
        },
        errorElement: 'span',
        errorPlacement: function (error, element)
        {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass)
        {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass)
        {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        }
    });

    $(function(){
        $('[name="date_from"]').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {time: 'far fa-clock'},
        });
        $('[name="date_to"]').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {time: 'far fa-clock'},
        });
    });
</script>