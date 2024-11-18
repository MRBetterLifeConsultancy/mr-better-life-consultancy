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
                            <h2 class="card-title">Add User</h2>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body ">
                            <form name="quickForm" id="quickForm">
                                <div class="row">
                                    <!-- left column -->
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" class="form-control" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="last_name">Surname</label>
                                            <input type="text" name="last_name" class="form-control" placeholder="Surname">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control custom-select" data-toggle="select2" name="gender">
                                                <option value="">Choose option</option>
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                                <option value="OTHER">Prefer not to say</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="date_of_birth">Date of Birth Number</label>
                                            <input type="date" name="date_of_birth" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group required">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control" placeholder="Password">
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
        if (!$('#quickForm').valid()) {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#quickForm', true);
            return;
        }
        var first_name = $('#quickForm').find('[name="first_name"]').val();
        var last_name = $('#quickForm').find('[name="last_name"]').val();
        var middle_name = $('#quickForm').find('[name="middle_name"]').val();
        var date_of_birth = $('#quickForm').find('[name="date_of_birth"]').val();
        var gender = $('#quickForm').find('[name="gender"]').val();
        var phone = $('#quickForm').find('[name="phone"]').val();
        var email = $('#quickForm').find('[name="email"]').val();
        var password = $('#quickForm').find('[name="password"]').val();
        var confirm_password = $('#quickForm').find('[name="confirm_password"]').val();
        
        var submitData = {};
        submitData['first_name'] = first_name;
        submitData['middle_name'] = middle_name;
        submitData['last_name'] = last_name;
        submitData['date_of_birth'] = date_of_birth;
        submitData['gender'] = gender;
        submitData['phone'] = phone;
        submitData['email'] = email;
        submitData['password'] = password;
        submitData['confirm_password'] = confirm_password;

        var submittedData = {
            'submittedData': submitData
        };

        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/create_user/create',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function(response) {
                enableDisableDiv('#quickForm', true);
                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1) 
                {
                    toastr.success(receivedData.message);
                    if (receivedData.redirect_url) 
                    {
                        // window.location.href = receivedData.redirect_url;
                        window.location.reload();
                    }
                } 
                else 
                {
                    toastr.error(receivedData.message);
                }
            },
            error: function() 
            {
                enableDisableDiv('#quickForm', true);
                toastr.error("Refresh the page and try again")
            }
        });
    }

    // form validation
    $('#quickForm').validate({
        rules: {
            first_name:{
                required: true
            },
            // middle_name:{
            //     required: true
            // },
            last_name:{
                required: true
            },
            date_of_birth:{
                required: true,
            },
            gender:{
                required: true,
            },
            email:{
                required: true,
                email: true
            },
            phone:{
                required: true,
                pattern: /^[6-9]\d{9}$/,
            },
            password: {
                required: true,
                pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,}$/
            },
            confirm_password: {
                required: true,
                pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,}$/,
                equalTo: '[name="password"]'
            },
        },
        messages: {
            first_name:{
                required: "Please enter your first name"
            },
            last_name:{
                required: "Please enter your last name"
            },
            middle_name:{
                required: "Please enter your middle name"
            },
            date_of_birth:{
                required: "Please enter your date of birth"
            },
            gender:{
                required: "Please enter your gender"
            },
            phone:{
                required: "Please enter a phone number",
                pattern: "Enter phone starting with [6,7,8,9] and 10 digits long"
            },
            email:{
                required: "Please enter your email"
            },
            password: {
                required: "Please enter password",
                pattern: "Password should be atleast 8 characters, with at least 1 uppercase letter, 1 lowercase letter, 1 digit and 1 special character"
            },
            confirm_password: {
                required: "Please confirm password",
                equalTo: "Confirm password and password should be same",
                pattern: "Password should be atleast 8 characters, with at least 1 uppercase letter, 1 lowercase letter, 1 digit and 1 special character"
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        }
    });
</script>