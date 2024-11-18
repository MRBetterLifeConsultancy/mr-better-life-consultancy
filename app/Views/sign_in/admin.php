<div class="login_page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center display-block">
                <img src="<?php echo $custom_site_url; ?>/assets/img/MR-Betterlife.png" alt="" height="100px">
            </div>
            <div class="card-body">
                <p class="login-box-msg">You are signing-in as <span style="color:blue">Admin</span></p>

                <form id="loginForm" name="loginForm">
                    <div class="alert-message-container" style="display:none">
                        <div class="alert alert-danger ">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <span class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button class="btn btn-primary btn-block" onclick="signId(event, this)">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<script>
    var Toast = null;
    $(function ()
    {
        Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
    });
    // form submit

    function signId(ev)
    {
        ev.preventDefault();
        enableDisableDiv('#loginForm', false);
        if (!$('#loginForm').valid())
        {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#loginForm', true);
            return;
        }
        $('#loginForm').find('.email').hide();
        $('#loginForm').find('.password').hide();
        var email = $('#loginForm').find('[name="email"]').val();
        var password = $('#loginForm').find('[name="password"]').val();

        var submitData = {};
        submitData['email'] = email;
        submitData['password'] = password;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/admin_login/sign_in',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#loginForm', true);
                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1)
                {
                    // alert('hi')
                    toastr.success('Login successfully.');
                    if (receivedData.redirect_url)
                    {
                        window.location.href = receivedData.redirect_url;
                    }
                }
                else
                {
                    toastr.error(receivedData.message)
                    $('#loginForm').find('.alert-message-container').find('.alert-message').text(receivedData.message);
                    $('#loginForm').find('[name="email"]').addClass('is-invalid');
                    $('#loginForm').find('[name="password"]').addClass('is-invalid');
                    $('#loginForm').find('.alert-message-container').show();
                }

            },
            error: function ()
            {
                enableDisableDiv('#loginForm', true);
                toastr.error("Refresh the page and try again")
                // alert("Refresh the page and try again")
            }
        });
    }


    // form validation
    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true

            },
        },
        messages: {
            email: {
                required: "Please enter an email address",
                email: "Please enter a vaild email address"
            },
            password: {
                required: "Please provide a password",
                // minlength: "Your password must be at least 5 characters long"
            },
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