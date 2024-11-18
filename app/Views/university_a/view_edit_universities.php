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
                            <h2 class="card-title">Search universities</h2>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body ">
                            <form name="quickForm" id="quickForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Region</label>
                                            <select class="form-control custom-select2" data-toggle="select2" name="region" data-placeholder="Choose ...">
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($regions as $region)
                                                    {
                                                        $selected = "";
                                                        if($region_id == $region['region_id'])
                                                        {
                                                            $selected = "selected";
                                                        }
                                                        ?>
                                                        <option value="<?php echo $region['region_id'] ?>" <?php echo $selected ?> data-name="<?php echo $region['region_name'] ?>"><?php echo $region['region_name']?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>                   
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                            $total_count = $universities_count;
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
                                        <button class="btn btn-primary float-right" onclick="searchuniversities(event, this)">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <p><?php echo $universities_count ?> - records found with search filters</p>
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
                            <h3 class="card-title">Universities List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>ID</th>
                                            <th>University Logo</th>
                                            <th>University Name</th>
                                            <th>Region name</th>
                                            <th>Contact Details</th>
                                            <th>Address</th>
                                            <th>Website</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $helperModel = new App\Models\HelperModel();
                                        if (!empty($universities))
                                        {
                                            $sno = 1;
                                            foreach ($universities as $university)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $sno++ ?></td>
                                                    <td><?php echo $university['university_id'] ?></td>
                                                    <td>
                                                        <img class="img-fluid" src="<?php echo $custom_site_url. 'assets/img/universities/'. $university['logo'] ?>">
                                                    </td>
                                                    <td><?php echo $university['university_name'] ?></td>
                                                    <td><?php echo $university['region_name'] ?></td>
                                                    <td>
                                                        Phone: <?php echo $university['phone'] ?><br>
                                                        Alternate Phone: <?php echo $university['alternate_phone'] ?><br>
                                                        Email: <?php echo $university['email'] ?><br>
                                                        Alternate Email: <?php echo $university['alternate_email'] ?>
                                                    </td>
                                                    <td><?php echo $university['address'] ?></td>
                                                    <td><?php echo $university['website'] ?></td>
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
                <p class="modal-title">University Info</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="name">University Name</label>
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

<script>

    function viewUniversity(university_id, e)
    {
        enableDisableDiv('#datatable', false);
        var submitData = {};
        submitData['university_id'] = university_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/university/info',
            datatype: 'json',
            type: 'POST',
            data: submittedData,

            success: function (response)
            {
                enableDisableDiv('#datatable', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    var receivedDataArray = receivedData.universities;
                    $.each(receivedDataArray, function (idx, row)
                    {
                        $('[name="view_modal"]').find('[name="name"]').text(row.university_name);
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

    function searchuniversities(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#quickForm', false);
        var name = $('#quickForm').find('[name="name"]').val();
        var region = $('#quickForm').find('[name="region"]').val();
        var offset = $('#quickForm').find('[name="page"]').val();

        var submitData = {};
        submitData['name'] = name;
        submitData['region'] = region;
        submitData['offset'] = offset;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/view_edit_universities/search',
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
</script>