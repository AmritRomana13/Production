<script>
    $(function() {
        $('#add_slider').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                image_1: {
                    validators: {
                        file: {
                            extension: 'jpg,png,jpeg',
                            message: 'The selected file is not valid'
                        },
                    }
                },
                image_2: {
                    validators: {
                        file: {
                            extension: 'jpg,png,jpeg',
                            message: 'The selected file is not valid'
                        },
                    }
                },
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
                data: new FormData(
                    this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function(result) {
                    console.log(result);
                    var obj = JSON.parse(result);

                    if (obj.status == 200) {

                        toastr["success"]("message", obj.message);

                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    } else {
                        toastr["error"]("message", obj.message);
                    }
                }
            });
        });
    });
</script>