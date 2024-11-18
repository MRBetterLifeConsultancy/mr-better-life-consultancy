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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h2 class="card-title">Create Prospect</h2>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body ">
                            <form name="quickForm" id="quickForm">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label for="name">Prospect Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Prospect Name">
                                        </div>
                                        <div class="form-group required">
                                            <label for="city">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="City">
                                        </div>
                                        <div class="form-group required">
                                            <label for="person">Contact Person</label>
                                            <input type="text" name="person" class="form-control" placeholder="Contact Person">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group required">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                                        </div>
                                        <div class="form-group required">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" placeholder="address" name="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" onclick="submitForm(event, this)">Submit</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
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

<script>
    // form submit

    function submitForm(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#quickForm', false);
        if (!$('#quickForm').valid())
        {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#quickForm', true);
            return;
        }
        var client = $('#quickForm').find('[name="client"]').val();
        var name = $('#quickForm').find('[name="name"]').val();
        var city = $('#quickForm').find('[name="city"]').val();
        var phone = $('#quickForm').find('[name="phone"]').val();
        var email = $('#quickForm').find('[name="email"]').val();
        var address = $('#quickForm').find('[name="address"]').val();
        var person = $('#quickForm').find('[name="person"]').val();

        var submitData = {};
        submitData['client'] = client;
        submitData['name'] = name;
        submitData['city'] = city;
        submitData['address'] = address;
        submitData['phone'] = phone;
        submitData['email'] = email;
        submitData['person'] = person;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/create_prospect/create',
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
                    toastr.success(receivedData.message);
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


    // form validation
    $('#quickForm').validate({
        rules: {
            client: {
                required: true
            },
            name: {
                required: true
            },
            city: {
                required: true
            },
            email: {
                required: true
            },
            person: {
                required: true
            },
            phone: {
                digits: true,
                required: true,
                pattern: /^[6-9]\d{9}$/
            },
        },
        messages: {
            phone: {
                pattern: "Enter phone starting with [6,7,8,9] and 10 digits long"
            }
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
</script>