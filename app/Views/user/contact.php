<main class="main">

<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/contact-page-title-bg.jpg);">
  <div class="container">
    <h1>Contact Us</h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="index.html">Home</a></li>
        <li class="current">Contact Us</li>
      </ol>
    </nav>
  </div>
</div><!-- End Page Title -->

<!-- Contact Section -->
<section id="contact" class="contact section">

  <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-5">
        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
          <i class="bi bi-geo-alt flex-shrink-0"></i>
          <div>
            <h3>Address</h3>
            <p>1st floor, 23-6-72, MR Palli Rd, </p>
            <p>Vasavinagar, New Balaji Colony, </p>
            <p>Tirupati, Andhra Pradesh 517501 </p>
          </div>
        </div><!-- End Info Item -->

        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
          <i class="bi bi-telephone flex-shrink-0"></i>
          <div>
            <h3>Call Us</h3>
            <p>+44 7913145678</p>
            <p>+91 9912000140</p>
          </div>
        </div><!-- End Info Item -->

        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
          <i class="bi bi-envelope flex-shrink-0"></i>
          <div>
            <h3>Email Us</h3>
            <p>info@mrbetterlifeconsultancy.com</p>
          </div>
        </div><!-- End Info Item -->
      </div>

      <div class="col-lg-7">
        <div class="container contact-title" data-aos="fade-up">
            <h2>Book a Free Counselling Session</h2>
            <p>We are excited to help you achieve your dreams and looking forward to your successful endeavors!</p>
        </div> 
        <form id="contactForm" name="contactForm" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="form-group required">
                        <input type="text" name="name" class="form-control" placeholder="Your Name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group required">
                        <input type="text" name="phone" class="form-control" placeholder="Your Phone">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group required">
                        <input type="email" class="form-control" name="email" placeholder="Your Email">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group required">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" value="<?php echo $subject ?>">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group required">
                        <textarea class="form-control" name="message" rows="6" placeholder="Message"></textarea>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                    <button class="btn btn-primary" type="submit" onclick="bookSession(event, this)">Send Request</button>
                </div>

            </div>
        </form>
      </div><!-- End Contact Form -->

    </div>

  </div>

</section><!-- /Contact Section -->

</main>
<script>
    function bookSession(ev, e) 
    {
        ev.preventDefault();
        enableDisableDiv('#contactForm', false);
        if (!$('#contactForm').valid()) {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#contactForm', true);
            return;
        }
        var name = $('#contactForm').find('[name="name"]').val();
        var phone = $('#contactForm').find('[name="phone"]').val();
        var email = $('#contactForm').find('[name="email"]').val();
        var subject = $('#contactForm').find('[name="subject"]').val();
        var message = $('#contactForm').find('[name="message"]').val();
        
        var submitData = {};
        submitData['name'] = name;
        submitData['phone'] = phone;
        submitData['email'] = email;
        submitData['subject'] = subject;
        submitData['message'] = message;

        var submittedData = {
            'submittedData': submitData
        };

        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/create_prospect/create',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function(response) {
                enableDisableDiv('#contactForm', true);
                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1) 
                {
                    toastr.success(receivedData.message);
                    if (receivedData.redirect_url) 
                    {
                        clearContactForm();
                    }
                } 
                else 
                {
                    toastr.error(receivedData.message);
                }
            },
            error: function() 
            {
                enableDisableDiv('#contactForm', true);
                toastr.error("Refresh the page and try again")
            }
        });
    }

    function clearContactForm()
    {
        $('#contactForm').find('[name="name"]').val('');
        $('#contactForm').find('[name="phone"]').val('');
        $('#contactForm').find('[name="email"]').val('');
        $('#contactForm').find('[name="subject"]').val('');
        $('#contactForm').find('[name="message"]').val('');
    }

    // form validation
    $('#contactForm').validate({
        rules: {
            name:{
                required: true
            },
            phone:{
                required: true,
                pattern: /^[6-9]\d{9}$/,
            },
            email:{
                required: true,
                email: true
            },
            subject:{
                required: true
            },
            message:{
                required: true
            },
        },
        messages: {
            name:{
                required: "Please enter your full name"
            },
            phone:{
                required: "Please enter a phone number",
                pattern: "Invalid Phone Number"
            },
            email:{
                required: "Please enter your email"
            },
            subject:{
                required: "Please enter subject/purpose of the session"
            },
            message:{
                required: "Please enter message"
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