

$(document).ready(function() {

  /**
   * Validate the signup form
   */
  $('#signupForm').validate({
    rules: {
      email: {
        remote: {
          url: siteurl + "validate_email.php",
          type: 'post'
        }
      },
      password: {
        minlength: 6
      },
      password_confirmation:{
        equalTo:'#password'
      }
    },
    messages: {
      email: {
        remote: 'Already taken, please choose another one.'
      },
      password: {
        required: 'This field is required.',
        minlength: $.validator.format('Please enter at least {0} characters.')
      }
    }
  });


  /**
   * Validate the user admin form
   */
  $('#userForm').validate({
    rules: {
      email: {
        remote: {
          url: siteurl + "validate_email.php",
          type: 'post',
          data: {
            user_id: function() {
              return $userID;
            }
          }
        }
      },
      password: {
        required: function(element) {
          return $userID == null;
        },
        minlength: 6
      },
      address:{
        minlength:6,
        maxlength:100,
        required:false
      },
      phone:{
        minlength:6,
        maxlength:15,
        number:true,
        required:false
      }
    },
    messages: {
      email: {
        remote: 'Already taken'
      },
      password: {
        required: 'Required.',
        minlength: $.validator.format('Min {0} characters.')
      },
      address:{
        minlength:$.validator.format('Min {0} characters.'),
        maxlength:$.validator.format('Max  {0} characters.')
      },
      phone:{
        number:'Only numbers',
        minlength:$.validator.format('Min {0} numbers.'),
        maxlength:$.validator.format('Max {0} numbers.')
      }
    }
  });
  
  /**
   * Validate the password reset form
   */
  $('#resetPasswordForm').validate({
    rules:{
      password:{
        minlength:6
      },
      password_confirmation:{
        equalTo:'#password'
      }
    },
    messages:{
      password:{
        required:'This field is required',
        minlength:$.validator.format('Please enter at least {0} characters.')
      }
    }
  });

  /**
   * Validate the password reset form
   */
  $('#changePasswordForm').validate({
    rules:{
      currentpassword:{
        minlength:6
      },
      password:{
        minlength:6
      },
      password_confirmation:{
        equalTo:'#password'
      }
    },
    messages:{
      password:{
        required:'This field is required',
        minlength:$.validator.format('Please enter at least {0} characters.')
      }
    }
  });

    $('#profileForm').validate({
    rules:{
      address:{
        minlength:6,
        maxlength:100,
        required:false
      },
      phone:{
        minlength:6,
        maxlength:15,
        number:true,
        required:false
      }
    },
    messages:{
      address:{
        minlength:$.validator.format('Please enter min {0} characters.'),
        maxlength:$.validator.format('Please enter max  {0} characters.')
      },
      phone:{
        number:'Please enter only numbers',
        minlength:$.validator.format('Please enter min {0} numbers.'),
        maxlength:$.validator.format('Please enter max {0} numbers.')
      }
    }
  });

  /**
   * Validate the password reset form
   */
  $('#contactForm').validate({
    rules:{
      name:{
          required:true
      },
      email: {
          required: true,
          email: true
      },
      message:{
        required: true,
        minlength:20,
        maxlength:300
      },
      captcha:{
        required: true,
      }
    },
    messages:{
      message:{
        required:'This field is required',
        minlength:$.validator.format('Please enter at least {0} characters.'),
        maxlength:$.validator.format('Your Message is exceeding limit of {0} characters')
      }

    }
  });
});
