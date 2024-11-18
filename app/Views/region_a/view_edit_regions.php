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
                            <h2 class="card-title">Search Regions</h2>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body ">
                            <form name="quickForm" id="quickForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="region_name" class="form-control" placeholder="" value="<?php echo $region_name ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                            $total_count = $regions_count;
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
                                        <button class="btn btn-primary float-right" onclick="searchRegions(event, this)">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <p><?php echo $regions_count ?> - records found with search filters</p>
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
                            <h3 class="card-title">Regions List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Region Name</th>
                                            <th>Short Name</th>
                                            <th>Is Continent</th>
                                            <th>Is Country</th>
                                            <th>View</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $helperModel = new App\Models\HelperModel();
                                        if (!empty($regions))
                                        {
                                            $sno = 1;
                                            foreach ($regions as $region)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $sno++ ?></td>
                                                    <td><?php echo $region['region_name'] ?></td>
                                                    <td><?php echo $region['shortcode'] ?></td>
                                                    <td><?php echo $region['is_continent'] == 1 ? 'Yes' : 'No' ?></td>
                                                    <td><?php echo $region['is_country'] == 1 ? 'Yes' : 'No' ?></td>
                                                    <td>
                                                        <button onclick="viewRegion(<?php echo $region['region_id'] ?>, this)" class='btn btn-block bg-gradient-info'>View</button>
                                                    </td>
                                                    <td>
                                                        <button onclick="editRegion(<?php echo $region['region_id'] ?>, this)" class='btn btn-block bg-gradient-warning'>Edit</button>
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
                <p class="modal-title">Region Info</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="region_name">Region Name</label>
                                <p name="region_name" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="is_country">Is Country</label>
                                <p name="is_country" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group view-modal-item">
                                <label for="is_continent">Is Continent</label>
                                <p name="is_continent" class="form-control-static"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group view-modal-item">
                                <label for="brief_document">Details JSON text</label>
                                <p name="brief_document" class="form-control-static"></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-gradient-light">
                <button type="button" class="btn btn-primary" name="edit_button" onclick='initEditRegion(this)'>Edit</button>
                <button type="button" class="btn bg-gradient-danger float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- edit modal -->
<!-- /.modal -->
<div class="modal fade" name="edit_modal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <p class="modal-title">Update Region</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickFormEdit">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <div class="form-group required d-none">
                                <label for="region_id">Region ID</label>
                                <input type="text" name="region_id" class="form-control" placeholder="Region ID">
                            </div>
                            <div class="form-group required">
                                <label for="region_name">Region Name</label>
                                <input type="text" name="region_name" class="form-control" placeholder="Region Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="brief_document">Brief Document</label>
                                <textarea class="form-control" placeholder="brief_document" name="brief_document" rows="20"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-gradient-light">
                <button class="btn btn-primary" onclick="updateRegion(event, this)">Update</button>
                <button type="button" class="btn bg-gradient-danger float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    function viewRegion(region_id, e)
    {
        enableDisableDiv('#datatable', false);
        var submitData = {};
        submitData['region_id'] = region_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/region/info',
            datatype: 'json',
            type: 'POST',
            data: submittedData,

            success: function (response)
            {
                enableDisableDiv('#datatable', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    var receivedDataArray = receivedData.region;
                    $.each(receivedDataArray, function (idx, row)
                    {
                        $('[name="view_modal"]').find('[name="region_name"]').text(row.region_name);
                        $('[name="view_modal"]').find('[name="is_country"]').text(row.is_country);
                        $('[name="view_modal"]').find('[name="is_continent"]').text(row.is_continent);
                        $('[name="view_modal"]').find('[name="brief_document"]').text(row.brief_document);
                        $('[name="view_modal"]').find('[name="edit_button"]').data('id', row.region_id);
                        $('[name="view_modal"]').find('[name="edit_button"]').show();
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

    function initEditRegion(e)
    {
        var insert_id = $(e).data('id');
        $('[name="view_modal"]').modal('hide');
        editRegion(insert_id);
    }

    function editRegion(region_id, e)
    {
        enableDisableDiv('#datatable', false);
        var submitData = {};
        submitData['region_id'] = region_id;
        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/region/info',
            datatype: 'json',
            type: 'POST',
            data: submittedData,

            success: function (response)
            {
                enableDisableDiv('#datatable', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    var receivedDataArray = receivedData.region;
                    $.each(receivedDataArray, function (idx, row)
                    {
                        $('[name="edit_modal"]').find('[name="region_id"]').val(row.region_id);
                        $('[name="edit_modal"]').find('[name="region_name"]').val(row.region_name);
                        $('[name="edit_modal"]').find('[name="brief_document"]').val(row.brief_document);
                    });
                    $('[name="edit_modal"]').modal('show');
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

    function updateRegion(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#quickFormEdit', false);
        if (!$('#quickFormEdit').valid())
        {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#quickFormEdit', true);
            return;
        }

        var region_name = $('[name="edit_modal"]').find('[name="region_name"]').val();
        var brief_document = $('[name="edit_modal"]').find('[name="brief_document"]').val();
        var region_id = $('[name="edit_modal"]').find('[name="region_id"]').val();

        var submitData = {};
        submitData['region_name'] = region_name;
        submitData['brief_document'] = brief_document;
        submitData['region_id'] = region_id;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/view_edit_regions/edit',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#quickFormEdit', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    toastr.success(receivedData.message);
                    if (receivedData.redirect_url)
                    {
                        window.location.reload();
                    }
                }
                else
                {
                    toastr.error(receivedData.message);
                    // alert(receivedUpdateData.message)
                }
            },
            error: function ()
            {
                enableDisableDiv('#quickFormEdit', true);
                toastr.error("Refresh the page and try again");
            }

        });
    }

    function searchRegions(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#quickForm', false);
        var region_name = $('#quickForm').find('[name="region_name"]').val();
        var offset = $('#quickForm').find('[name="page"]').val();

        var submitData = {};
        submitData['region_name'] = region_name;
        submitData['offset'] = offset;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/view_edit_regions/search',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#quickForm', true);
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
                enableDisableDiv('#quickForm', true);
                toastr.error("Refresh the page and try again");
            }
        });
    }
</script>