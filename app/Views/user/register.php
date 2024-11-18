<main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/about-page-title-bg.jpg);">
        <div class="container">
            <h1>Registration Page</h1>
            <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Register</li>
            </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->
    <section class="register section light-background">
        <div class="dark-div pt-5">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-12 col-lg-9 col-xl-9">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-4 pb-2 pb-md-0 text-primary">Registration</h3>
                                <hr class="mb-md-4">
                                <form name="registerForm" id="registerForm">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="first_name">First Name</label>
                                                <input type="text" name="first_name" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="middle_name">Middle Name</label>
                                                <input type="text" name="middle_name" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="last_name">Last Name</label>
                                                <input type="text" name="last_name" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group datepicker w-100">
                                                <label for="date_of_birth" class="form-label">Date of birth</label>
                                                <input type="date" class="form-control form-control-lg" name="date_of_birth" />
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <div class="form-group">
                                                <label class="form-select-label" for="gender">Gender</label>
                                                <select class="form-select form-select-lg" name="gender">
                                                    <option value="">Choose option</option>
                                                    <option value="MALE">Male</option>
                                                    <option value="FEMALE">Female</option>
                                                    <option value="OTHER">Prefer not to say</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" name="email" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Phone Number</label>
                                                <input type="tel" name="phone" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" name="password" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-group">
                                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-primary btn-lg" onclick="submitForm(event, this)">Submit</button>
                                    </div>
                                </form>
                                <br>
                                <p>Already a user? <a href="<?php echo $custom_site_url . $controller; ?>/login" class="text-primary">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>

    function submitForm(ev, e) 
    {
        ev.preventDefault();
        enableDisableDiv('#registerForm', false);
        if (!$('#registerForm').valid()) {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#registerForm', true);
            return;
        }
        var first_name = $('#registerForm').find('[name="first_name"]').val();
        var last_name = $('#registerForm').find('[name="last_name"]').val();
        var middle_name = $('#registerForm').find('[name="middle_name"]').val();
        var date_of_birth = $('#registerForm').find('[name="date_of_birth"]').val();
        var gender = $('#registerForm').find('[name="gender"]').val();
        var phone = $('#registerForm').find('[name="phone"]').val();
        var email = $('#registerForm').find('[name="email"]').val();
        var password = $('#registerForm').find('[name="password"]').val();
        var confirm_password = $('#registerForm').find('[name="confirm_password"]').val();
        
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
            url: '<?php echo $custom_site_url . $controller; ?>/register/sign_up',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function(response) {
                enableDisableDiv('#registerForm', true);
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
                enableDisableDiv('#registerForm', true);
                toastr.error("Refresh the page and try again")
            }
        });
    }

    // form validation
    $('#registerForm').validate({
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