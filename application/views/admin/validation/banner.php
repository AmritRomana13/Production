<script>
    $(function() {
        $('#add_slider').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                top_title: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Title'
                        }
                    }
                },
                middle_title: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Middle Text'
                        }
                    }
                },
                bottom_title: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Bottom text'
                        }
                    }
                },
                button_text: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Button Text'
                        }
                    }
                },
                image: {
                    validators: {
                        notEmpty: {
                            message: 'Please Select Image'
                        },
                        file: {
                            extension: 'jpg,png,jpeg',
                            message: 'The selected file is not valid'
                        },
                    }
                },
                link: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Button Link'
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
                            window.location.href = base_url + 'cc_admin/sliders/banners';
                        }, 3000);
                    } else {
                        toastr["error"]("message", obj.message);
                    }
                }
            });
        });

        $('#edit_product').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                product_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Product Name'
                        }
                    }
                },
                mrp: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Product Mrp price'
                        },
                        numeric: {
                            message: 'Please enter valid mrp price',
                        }
                    }
                },
                sale_price: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Product Sale Price price'
                        },
                        numeric: {
                            message: 'Please enter valid Sale Price price',
                        }
                    }
                },
                short_description: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter Short Description'
                        }
                    }
                },
                thumbnail: {
                    validators: {
                        file: {
                            extension: 'jpg,png,jpeg',
                            message: 'The selected file is not valid'
                        },
                    }
                },
                pdf_file: {
                    validators: {
                        file: {
                            extension: 'pdf',
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
                            window.location.href = base_url + 'cc_admin/sliders/banners';
                        }, 3000);
                    } else {
                        toastr["error"]("message", obj.message);
                    }
                }
            });
        });
    });
</script>