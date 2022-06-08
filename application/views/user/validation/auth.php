<script>
    $(function() {
        $('#signup').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                full_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Full Name'
                        }
                    }
                },
                full_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Full Name'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Your email id'
                        },
                        emailAddress: {
                            message: 'The value is not a valid email id'
                        },
                        remote: {
                            message: 'This Email id already registered with us.',
                            url: base_url + 'auth/check_email/',
                            data: {
                                type: 'email_address'
                            },
                            type: 'POST'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter password'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the FormValidation instance
            var bv = $form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: $form.attr('action'),
                type: "POST",
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function(result) {
                    console.log(result);
                    var obj = JSON.parse(result);
                    if (obj.status == 200) {
                        $('#notification-message').removeClass('d-none').addClass('alert-success').html(obj.message);
                        setTimeout(function() {
                            $('#notification-message').html('').removeClass('alert-success').addClass('d-none');
                            window.location.href = base_url + "auth/login";
                        }, 3000);
                    } else {
                        $('#notification-message').removeClass('d-none').addClass('alert-danger').html(obj.message);
                        setTimeout(function() {
                            $("#submit_button").removeAttr("disabled").removeClass("disabled");
                            $('#notification-message').html('').removeClass('alert-danger').addClass('d-none');
                        }, 3000);
                    }
                }
            });
        });

        $('#signin').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Email Or Phone number'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter password'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the FormValidation instance
            var bv = $form.data('formValidation');

            // Use Ajax to submit form data
            $.ajax({
                url: $form.attr('action'),
                type: "POST",
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function(result) {
                    console.log(result);
                    var obj = JSON.parse(result);
                    if (obj.status == 200) {
                        $('#notification-message').removeClass('d-none').addClass('alert-success').html(obj.message);
                        setTimeout(function() {
                            $('#notification-message').html('').removeClass('alert-success').addClass('d-none');
                            window.location.href = base_url;
                        }, 3000);
                    } else {
                        $('#notification-message').removeClass('d-none').addClass('alert-danger').html(obj.message);
                        setTimeout(function() {
                            $("#submit_button").removeAttr("disabled").removeClass("disabled");
                            $('#notification-message').html('').removeClass('alert-danger').addClass('d-none');
                        }, 3000);
                    }
                }
            });
        });
    });
</script>