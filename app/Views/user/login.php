<main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/about-page-title-bg.jpg);">
        <div class="container">
            <h1>Sign In</h1>
            <!-- <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Sign In</li>
                </ol>
            </nav> -->
        </div>
    </div><!-- End Page Title -->
    <section class="login section dark-bckground">
        <div class="container section-title" data-aos="fade-up">
            <!-- <h2>SIGN IN</h2> -->
            <p>Enter your credentials for signing into your account</p>
        </div>
        <div class="container h-100 w-50">
            <div class="row justify-content-center h-100">
                <div class="col-12 col-lg-9 col-xl-9">
                    <div class="card mb-3">
                        <div class="card-body px-5 py-5">
                            <form name="loginForm" id="loginForm">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="form-label" for="phone">Phone Number</label>
                                            <input type="tel" name="phone" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-lg" onclick="submitForm(event, this)">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <p>Not a user? <a href="<?php echo $custom_site_url . $controller; ?>/register" class="text-primary">Register</a></p>
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
        enableDisableDiv('#loginForm', false);
        if (!$('#loginForm').valid()) {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#loginForm', true);
            return;
        }
        var phone = $('#loginForm').find('[name="phone"]').val();
        var password = $('#loginForm').find('[name="password"]').val();
        
        var submitData = {};
        submitData['phone'] = phone;
        submitData['password'] = password;

        var submittedData = {
            'submittedData': submitData
        };

        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/login/sign_in',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function(response) {
                enableDisableDiv('#loginForm', true);
                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1) 
                {
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
            error: function() 
            {
                enableDisableDiv('#loginForm', true);
                toastr.error("Refresh the page and try again")
            }
        });
    }

    // form validation
    $('#loginForm').validate({
        rules: {
            phone:{
                required: true,
                pattern: /^[6-9]\d{9}$/,
            },
            password: {
                required: true,
            },
        },
        messages: {
            phone:{
                required: "Please enter a phone number",
                pattern: "Enter phone starting with [6,7,8,9] and 10 digits long"
            },
            password: {
                required: "Please enter password",
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