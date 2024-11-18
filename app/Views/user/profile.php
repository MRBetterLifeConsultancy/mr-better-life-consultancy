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
    <section class="section profile">
        <div class="row <?php echo $view_type == 1 ? 'px-2' : 'px-5 mx-5' ?>">
            <?php
                $helperModel = new App\Models\HelperModel();
                if(isset($user_data) && count($user_data) > 0)
                {
            ?>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <?php
                            if($user_data['profile_picture'] == "")
                            {
                                $src = "blank-profile-picture.png";
                            }
                            else
                            {
                                $src = $user_data['user_id'] ."/". $user_data['profile_picture'];
                            }
                        ?>
                        <img src="<?php echo $custom_site_url ."uploads/user_files/".$src ?>" style="height=200px;width=200px;" alt="Profile" class="rounded-circle">
                        <h2><?php echo $user_data['first_name']." ".$user_data['middle_name']." ".$user_data['last_name'] ?></h2>
                        <!-- <h3>Web Designer</h3> -->
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <!-- <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                            </li> -->
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-phone">Change Phone Number</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                                <!-- <h5 class="card-title">About</h5>
                                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->
                                <h5 class="card-title">Profile Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label ">First Name</div>
                                            <div class="col-md-8"><?php echo $user_data['first_name'] == null ? '-----' : $user_data['first_name'] ?> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label ">Middle Name</div>
                                            <div class="col-md-8"><?php echo $user_data['middle_name'] == null ? '-----' : $user_data['middle_name'] ?> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label ">Last Name</div>
                                            <div class="col-md-8"><?php echo $user_data['last_name'] == null ? '-----' : $user_data['last_name'] ?> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Date of Birth</div>
                                            <div class="col-md-8"><?php echo $helperModel->get_d_MM_Y_from_date_string($user_data['date_of_birth']) ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Gender</div>
                                            <div class="col-md-8"><?php echo $user_data['gender'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Phone</div>
                                            <div class="col-md-8"><?php echo $user_data['phone'] == null ? '-----' : $user_data['phone'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Alternate Phone</div>
                                            <div class="col-md-8"><?php echo $user_data['alternate_phone'] == null ? '-----' : $user_data['alternate_phone'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Email</div>
                                            <div class="col-md-8"><?php echo $user_data['email'] == null ? '-----' : $user_data['email'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Alternate Email</div>
                                            <div class="col-md-8"><?php echo $user_data['alternate_email'] == null ? '-----' : $user_data['alternate_email'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Current Address</div>
                                            <div class="col-md-8"><?php echo $user_data['current_address'] == null ? '-----' : $user_data['current_address'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 label">Permanent Address</div>
                                            <div class="col-md-8"><?php echo $user_data['permanent_address'] == null ? '-----' : $user_data['permanent_address'] ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <!-- Profile Edit Form -->
                                <form name="basicInfoForm" id="basicInfoForm">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?php echo $custom_site_url ."uploads/user_files/".$src ?>" alt="Profile">
                                            <div class="pt-2">
                                            <button class="btn btn-primary btn-sm" onclick="editProfilePicture(event,this)"><i class="bi bi-upload"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="deleteProfilePicture(event,this)"><i class="bi bi-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 d-none">
                                        <label for="user_id" class="col-md-4 col-lg-3 col-form-label">User ID</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="user_id" type="text" class="form-control" value="<?php echo $user_data['user_id'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="first_name" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="first_name" type="text" class="form-control" value="<?php echo $user_data['first_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="middle_name" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="middle_name" type="text" class="form-control" value="<?php echo $user_data['middle_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="last_name" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="last_name" type="text" class="form-control" value="<?php echo $user_data['last_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                        <select class="form-control custom-select2" data-toggle="select2" name="gender" onchange="getRegionList(event, this)">
                                            <option value="MALE" <?php echo $user_data['gender'] == 'MALE' ? 'selected' : '' ?>>MALE</option>
                                            <option value="FEMALE" <?php echo $user_data['gender'] == 'FEMALE' ? 'selected' : '' ?>>FEMALE</option>
                                            <option value="OTHER" <?php echo $user_data['gender'] == 'OTHER' ? 'selected' : '' ?>>PREFER NOT TO SAY</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">Date of birth</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="date_of_birth" type="date" class="form-control" value="<?php echo $user_data['date_of_birth'] ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" value="<?php echo $user_data['phone'] ?>">
                                        </div>
                                    </div> -->
                                    <div class="row mb-3">
                                        <label for="alternate_phone" class="col-md-4 col-lg-3 col-form-label">Alternate Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="alternate_phone" type="text" class="form-control" value="<?php echo $user_data['alternate_phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" value="<?php echo $user_data['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alternate_email" class="col-md-4 col-lg-3 col-form-label">Alternate Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="alternate_email" type="email" class="form-control" value="<?php echo $user_data['alternate_email'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="current_address" class="col-md-4 col-lg-3 col-form-label">Current Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="current_address" class="form-control" style="height: 100px"><?php echo $user_data['current_address'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="permanent_address" class="col-md-4 col-lg-3 col-form-label">Permanent Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="permanent_address" class="form-control" style="height: 100px"><?php echo $user_data['permanent_address'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" onclick="submitForm(event, this)">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                            <div class="tab-pane fade pt-3" id="profile-change-phone">
                                <!-- Change Phone Form -->
                                <form name="phoneEditForm" id="phoneEditForm">
                                    <div class="row mb-3 d-none">
                                        <label for="user_id" class="col-md-4 col-lg-3 col-form-label">User ID</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="user_id" type="text" class="form-control" value="<?php echo $user_data['user_id'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="currentPhone" class="col-md-4 col-lg-3 col-form-label">Current Phone</label>
                                        <div class="form-group col-md-8 col-lg-9">
                                            <p name="current_phone" type="text" class="form-control-static"><?php echo $user_data['phone'] ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="newPhone" class="col-md-4 col-lg-3 col-form-label">New Phone</label>
                                        <div class="form-group col-md-8 col-lg-9">
                                            <input name="new_phone" type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="updatePhone(event, this)" class="btn btn-primary">Update Phone</button>
                                    </div>
                                </form><!-- End Change Phone Form -->
                            </div>
                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form name="passwordEditForm" id="passwordEditForm">
                                    <div class="row mb-3 d-none">
                                        <label for="user_id" class="col-md-4 col-lg-3 col-form-label">User ID</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="user_id" type="text" class="form-control" value="<?php echo $user_data['user_id'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="form-group col-md-8 col-lg-9">
                                            <input name="current_password" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="form-group col-md-8 col-lg-9">
                                            <input name="new_password" type="password" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="form-group col-md-8 col-lg-9">
                                            <input name="confirm_password" type="password" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button onclick="updatePassword(event, this)" class="btn btn-primary">Update Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </section>
</main>

<div class="modal fade" name="edit_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning d-flex justify-content-between">
                <p class="modal-title">Update User</p>
                <button type="button" class="close btn btn-md float-right" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="profilePictureForm" id="profilePictureForm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-none">
                                <label for="user_id">user ID</label>
                                <input type="text" name="user_id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="current_profile_picture_file">Current Profile Picture:</label>
                                <img src="" alt="" class="" width="80%" height="80%" id="current_profile_picture_file" name="current_profile_picture_file">
                                <p name="cppf_status" class="form-control-static text-danger"></p>
                            </div>
                            <br><br>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="profile_picture">Profile Photo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profile_picture" id="profile_picture">
                                        <!-- <label class="custom-file-label" for="profile_picture">Choose file</label> -->
                                    </div>
                                    <br>
                                    <div class="input-group-append">
                                        <button class="btn btn-danger btn-sm" onclick="clearProfilePicture(event, this)"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary float-right" onclick='updateProfilePicture(event, this)'>Update</button>
                </form>
            </div>
            <div class="modal-footer bg-gradient-light">
                <button type="button" class="btn bg-gradient-danger float-right" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
        var alternate_phone = $('#basicInfoForm').find('[name="alternate_phone"]').val();
        var email = $('#basicInfoForm').find('[name="email"]').val();
        var alternate_email = $('#basicInfoForm').find('[name="alternate_email"]').val();
        var current_address = $('#basicInfoForm').find('[name="current_address"]').val();
        var permanent_address = $('#basicInfoForm').find('[name="permanent_address"]').val();
        
        var submitData = {};
        submitData['user_id'] = user_id;
        submitData['first_name'] = first_name;
        submitData['middle_name'] = middle_name;
        submitData['last_name'] = last_name;
        submitData['date_of_birth'] = date_of_birth;
        submitData['gender'] = gender;
        submitData['phone'] = phone;
        submitData['alternate_phone'] = alternate_phone;
        submitData['email'] = email;
        submitData['alternate_email'] = alternate_email;
        submitData['current_address'] = current_address;
        submitData['permanent_address'] = permanent_address;

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

    function editProfilePicture(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#basicInfoForm', false);
        $('#basicInfoForm').find('[name="phone"]').hide();
        var user_id = $('[name="basicInfoForm"]').find('[name="user_id"]').val();
        
        var updateData = {};
        updateData['user_id'] = user_id;
        var updatedData = {'submittedData': updateData};
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/user/info',
            datatype: 'json',
            type: 'POST',
            data: updatedData,
            success: function (response)
            {
                enableDisableDiv('#basicInfoForm', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    var receivedDataArray = receivedData.users;
                    $.each(receivedDataArray, function (idx, row)
                    {
                        $('[name="profilePictureForm"]').find('[name="user_id"]').val(row.user_id);
                        if (row.profile_picture != null && (row.profile_picture).length > 0)
                        {
                            $('[name="profilePictureForm"]').find('[name="current_profile_picture_file"]').attr('src', "<?php echo $custom_site_url; ?>uploads/user_files/" + userId + "/" + row.profile_picture);
                            $('[name="profilePictureForm"]').find('[name="cppf_status"]').hide();
                        }
                        else
                        {
                            $('[name="profilePictureForm"]').find('[name="current_profile_picture_file"]').hide();
                            $('[name="profilePictureForm"]').find('[name="cppf_status"]').text('Profile picture not uploaded');
                            $('[name="profilePictureForm"]').find('[name="cppf_status"]').show();
                        }
                    });
                    $('[name="edit_modal"]').modal('show');
                }
                else
                {
                    toastr.error(receivedData.message)
                }
            },
            error: function ()
            {
                enableDisableDiv('#basicInfoForm', true);
                toastr.error("Refresh the page and try again")
            }

        });
    }

    function updateProfilePicture(ev, e)
    {
        ev.preventDefault();
        enableDisableDiv('#profilePictureForm', false);
        if (!$('#profilePictureForm').valid())
        {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#profilePictureForm', true);
            return;
        }
        var formElement = $('#profilePictureForm')[0];
        var formData = new FormData(formElement);

        var submittedData = {
            'submittedData': formData
        };

        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/profile/edit_profile_picture',
            datatype: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function (response)
            {
                enableDisableDiv('#profilePictureForm', true);
                var receivedData = jQuery.parseJSON(response);
                if (receivedData.success == 1)
                {
                    toastr.success(receivedData.message);
                    if (receivedData.redirect_url)
                    {
                        window.location.reload();
                        // window.location.href = receivedData.redirect_url;
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
                enableDisableDiv('#profilePictureForm', true);
                toastr.error("Refresh the page and try again");
            }

        });
    }

    function deleteProfilePicture(ev,e)
    {
        ev.preventDefault();
        enableDisableDiv('#basicInfoForm', false);
        $('#basicInfoForm').find('[name="phone"]').hide();
        var user_id = $('[name="basicInfoForm"]').find('[name="user_id"]').val();
        
        var updateData = {};
        updateData['user_id'] = user_id;
        var updatedData = {'submittedData': updateData};
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/profile/delete_profile_picture',
            datatype: 'json',
            type: 'POST',
            data: updatedData,
            success: function (response)
            {
                console.log(response);
                enableDisableDiv('#basicInfoForm', true);
                var receivedData = jQuery.parseJSON(response);
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
                    toastr.error(receivedData.message)
                }
            },
            error: function ()
            {
                enableDisableDiv('#basicInfoForm', true);
                toastr.error("Refresh the page and try again")
            }

        });
    }

    function updatePhone(ev,e)
    {
        ev.preventDefault();
        enableDisableDiv('#phoneEditForm', false);
        if (!$('#phoneEditForm').valid())
        {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#phoneEditForm', true);
            return;
        }
        $('#phoneEditForm').find('[name="phone"]').hide();
        var user_id = $('[name="phoneEditForm"]').find('[name="user_id"]').val();
        var current_phone = $('[name="phoneEditForm"]').find('[name="current_phone"]').html();
        var new_phone = $('[name="phoneEditForm"]').find('[name="new_phone"]').val();
        if(current_phone==new_phone){
            toastr.error('Current and new phone cannot be same');
            enableDisableDiv('#phoneEditForm', true);
            return;
        }
        var updateData = {};
        updateData['user_id'] = user_id;
        updateData['new_phone'] = new_phone;
        var updatedData = {'submittedData': updateData};
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/profile/edit_phone',
            datatype: 'json',
            type: 'POST',
            data: updatedData,
            success: function (response)
            {
                console.log(response);
                enableDisableDiv('#phoneEditForm', true);
                var receivedData = jQuery.parseJSON(response);
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
                    toastr.error(receivedData.message)
                    // alert(receivedUpdateData.message)
                    if(receivedData.message == "Email id already present.Please try with another phone id")
                    {
                        $('#phoneEditForm').find('[name="phone"]').show();
                        $('#phoneEditForm').find('[name="new_phone"]').addClass('is-invalid');
                    }
                }
            },
            error: function ()
            {
                enableDisableDiv('#phoneEditForm', true);
                toastr.error("Refresh the page and try again")
            }

        });
    }

    function updatePassword(ev,e)
    {
        ev.preventDefault();
        enableDisableDiv('#passwordEditForm', false);
        if (!$('#passwordEditForm').valid())
        {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#passwordEditForm', true);
            return;
        }
        $('#passwordEditForm').find('[name="password"]').hide();
        var user_id = $('[name="passwordEditForm"]').find('[name="user_id"]').val();
        var current_password = $('[name="passwordEditForm"]').find('[name="current_password"]').val();
        var new_password = $('[name="passwordEditForm"]').find('[name="new_password"]').val();
        var confirm_password = $('[name="passwordEditForm"]').find('[name="confirm_password"]').val();
        var updateData = {};
        updateData['user_id'] = user_id;
        updateData['confirm_password'] = confirm_password;
        updateData['current_password'] = current_password;
        var updatedData = {'submittedData': updateData};
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/profile/edit_password',
            datatype: 'json',
            type: 'POST',
            data: updatedData,
            success: function (response)
            {
                console.log(response);
                enableDisableDiv('#passwordEditForm', true);
                var receivedData = jQuery.parseJSON(response);
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
                    toastr.error(receivedData.message)
                    // alert(receivedUpdateData.message)
                    if(receivedData.message == "Current password not matched Please try again")
                    {
                        $('#passwordEditForm').find('[name="password"]').show();
                        $('#passwordEditForm').find('[name="current_password"]').addClass('is-invalid');
                    }

                }
            },
            error: function ()
            {
                enableDisableDiv('#passwordEditForm', true);
                toastr.error("Refresh the page and try again")
            }

        });
    }

    function clearProfilePicture(ev, e)
    {
        ev.preventDefault();
        $('#profilePictureForm').find('[name="profile_picture"]').val(null);
        $('#profilePictureForm').find('[name="profile_picture"]').siblings(".custom-file-label").addClass("selected").html('Choose File');
    }

    $(".custom-file-input").on("change", function ()
    {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

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

    $('#passwordEditForm').validate({
        rules: {
            current_password: {
                required: true,
            },
            new_password: {
                required: true,
                pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,}$/
            },
            confirm_password: {
                required: true,
                pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,}$/,
                equalTo: '[name="new_password"]'
            },
        },
        messages: {
            current_password: {
                required: "Please enter a current password",
            },
            new_password: {
                required: "Please enter a new password",
                pattern: "Password should be atleast 8 characters, with at least 1 uppercase letter, 1 lowercase letter, 1 digit and 1 special character"

            },
            confirm_password: {
                required: "Please enter a confirm password",
                equalTo: "Confirm password and new password should be same",
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