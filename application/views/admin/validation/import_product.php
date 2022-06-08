<script>
    $(function() {
        $('#bulkproductsimport').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                productsfile: {
                    validators: {
                        notEmpty: {
                            message: 'Please select an file'
                        },
                        file: {
                            extension: 'xlsx,csv',
                            // type: 'image/jpeg,image/png',
                            // maxSize: 62500, // 250 * 250
                            message: 'The selected file is not valid'
                        },
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

                        toastr["success"]("message", obj.message);

                        setTimeout(function() {
                            window.location.href = base_url + 'cc_admin/products';
                        }, 3000);
                    } else {
                        toastr["error"]("message", obj.message);
                    }
                }
            });
        });
    });
</script>