<main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/about-page-title-bg.jpg);">
        <div class="container">
            <h1>My Profile</h1>
            <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">My Profile</li>
            </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->
    <section class="profile section light-background">
        <div class="container h-100">
            <div class="row h-100">
                <?php
                    if(isset($user_data) && count($user_data) > 0)
                    {
                ?>
                <h3>Welcome, <?php echo $user_data['first_name'].' '.$user_data['middle_name'].' '.$user_data['last_name'] ?> !</h3>
                <hr class="my-3">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center mb-2">
                                <?php
                                    // if($user_data['profile_picture'] == "")
                                    // {
                                        $src = "blank-profile-picture.png";
                                    // }
                                    // else
                                    // {
                                        // $src = $user_data['user_id'] ."/". $user_data['profile_picture'];
                                    // }
                                ?>
                                <img class="profile-user-img img-fluid img-circle" src="<?php echo $custom_site_url ."uploads/user_files/".$src ?>" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo $user_data['first_name']." ".$user_data['last_name'] ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Phone</b> <span class="text-primary float-right"><?php echo $user_data['phone'] ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <span class="text-primary float-right"><?php echo $user_data['email'] ?></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b> <span class="text-primary float-right"><?php echo $user_data['gender'] ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-warning">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                        <form id="quickFormPhone" name="quickFormPhone">
                        <div class="form-group d-none">
                            <label for="user_id">Employee ID</label>
                            <input type="text" name="user_id" class="form-control" value="<?php echo $user_data['user_id'];?>">
                        </div>
                          <div class="card-header bg-warning">
                            <!-- /.widget-user-image -->
                            <h3 class="card-title">Edit Phone</h3>
                          </div>
                          <div class="card-body">
                            <div name="phone" style="display:none">
                                <div class="alert alert-danger ">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    Already a user exists with this phone.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="current_phone">Current Phone</label>
                                <p name="current_phone" class="form-control-static"><?php echo $user_data['phone'];?></p>
                            </div>
                            <div class="form-group">
                                <label for="new_phone">New Phone</label>
                                <input name="new_phone" class="form-control" placeholder="New Phone">
                            </div>
                            <button type="button" class="btn btn-primary float-right" onclick='updatePhone(event,this)'>Update</button>
                          </div>
                        </form>
                    </div>
                    <div class="card card-warning">
                      <!-- Add the bg color to the header using any of the bg-* classes -->
                        <form id="quickFormPassword" name="quickFormPassword">
                        <div class="form-group d-none">
                            <label for="user_id">Employee ID</label>
                            <input type="text" name="user_id" class="form-control" value="<?php echo $user_data['user_id'];?>">
                        </div>
                          <div class="card-header bg-warning">
                            <!-- /.widget-user-image -->
                            <h3 class="card-title">Edit Password</h3>
                          </div>
                          <div class="card-body">
                            <div name="password" style="display:none">
                                <div class="alert alert-danger ">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                    Please check the current password and enter again.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input name="current_password" class="form-control" placeholder="Current Password">
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input name="new_password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_Password">Confirm password</label>
                                <input name="confirm_password" class="form-control" placeholder="Confirm password">
                            </div>
                            <button type="button" class="btn btn-primary float-right" onclick='updatePassword(event,this)'>Update</button>
                          </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3>Personal Info</h3>
                            <hr class="my-2">
                            <form name="basicInfoForm" id="basicInfoForm">
                                <div class="row">
                                    <div class="col-md-6 d-none">
                                        <div class="form-group">
                                            <label class="form-label" for="user_id">User Id</label>
                                            <input type="text" name="user_id" class="form-control form-control-lg" value="<?php echo $user_data['user_id'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="" value="<?php echo $user_data['first_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="middle_name">Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name" placeholder="" value="<?php echo $user_data['middle_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="" value="<?php echo $user_data['last_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" name="phone" placeholder="" value="<?php echo $user_data['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $user_data['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date_of_birth">Phone</label>
                                            <input type="date" class="form-control" name="date_of_birth" placeholder="" value="<?php echo $user_data['date_of_birth'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-select" name="gender">
                                                <option value="">Choose option</option>
                                                <option value="MALE" <?php echo $user_data['gender'] == "MALE" ? 'selected' : '' ?>>Male</option>
                                                <option value="FEMALE" <?php echo $user_data['gender'] == "FEMALE" ? 'selected' : '' ?>>Female</option>
                                                <option value="OTHER" <?php echo $user_data['gender'] == "OTHER" ? 'selected' : '' ?>>Prefer not to say</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-warning float-right" onclick="submitForm(event, this)">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    else
                    {
                ?>
                    Some error occured. Try again later.
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
</main>

<script>
    function submitForm(ev, e) 
    {
        ev.preventDefault();
        enableDisableDiv('#basicInfoForm', false);
        if (!$('#basicInfoForm').valid()) {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#basicInfoForm', true);
            return;
        }
        var user_id = $('#basicInfoForm').find('[name="user_id"]').val();
        var first_name = $('#basicInfoForm').find('[name="first_name"]').val();
        var last_name = $('#basicInfoForm').find('[name="last_name"]').val();
        var middle_name = $('#basicInfoForm').find('[name="middle_name"]').val();
        var date_of_birth = $('#basicInfoForm').find('[name="date_of_birth"]').val();
        var gender = $('#basicInfoForm').find('[name="gender"]').val();
        var phone = $('#basicInfoForm').find('[name="phone"]').val();
        var email = $('#basicInfoForm').find('[name="email"]').val();
        var password = $('#basicInfoForm').find('[name="password"]').val();
        var confirm_password = $('#basicInfoForm').find('[name="confirm_password"]').val();
        
        var submitData = {};
        submitData['user_id'] = user_id;
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
            url: '<?php echo $custom_site_url . $controller; ?>/profile/edit',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function(response) {
                enableDisableDiv('#basicInfoForm', true);
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
                enableDisableDiv('#basicInfoForm', true);
                toastr.error("Refresh the page and try again")
            }
        });
    }

    // form validation
    $('#basicInfoForm').validate({
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
            email:{
                required: "Please enter your email"
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