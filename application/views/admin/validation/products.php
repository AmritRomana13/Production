<?php
$folders_arr = array();
$get_categorys = get_categorys_admin();
if (!empty($get_categorys)) {
    foreach ($get_categorys as $cat) {
        $parentid = $cat->parent_category_id;

        if ($parentid == '0') $parentid = "#";
        $selected = false;
        $opened = false;
        if (isset($cat_id)) {
            $cat_id_array = explode(',', $cat_id);
            if (in_array($cat->id, $cat_id_array)) {
                $selected = true;
                $opened = true;
            }
        }

        if ($parentid == '#') {
            $icon = 'uil-folder';
        } else {
            $icon = 'uil-files-landscapes';
        }

        $folders_arr[] = array(
            "id" => $cat->id,
            "parent" => $parentid,
            "text" => preg_replace('/(\v|\s)+/', ' ', $cat->category_name),
            "icon" => $icon,
            "state" => array("selected" => $selected, "opened" => $opened)
        );
    }
}

?>
<script src="https://cdn.tiny.cloud/1/r12mss0vsml7o66lwradvrizf2loae1kxajlcqefuzvseeun/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    tinymce.init({
        selector: '#description',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        importcss_append: true,
        file_picker_callback: function(callback, value, meta) {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                    text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                    alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                    source2: 'alt.ogg',
                    poster: 'https://www.google.com/logos/google.jpg'
                });
            }
        },
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 300,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });
</script>
<script>
    var category_json_data = '<?= json_encode($folders_arr) ?>';

    $(document).ready(function() {
        var folder_jsondata = JSON.parse(category_json_data);
        $('#category_tree').jstree({
                'core': {
                    'data': folder_jsondata,
                    'multiple': true
                },
                'checkbox': {
                    'deselect_all': true,
                    'three_state': false,
                    "two_state": false
                },
                'plugins': ["checkbox", "changed"]
            })
            .bind("loaded.jstree", function(event, data) {
                $(this).jstree("open_all");
            });

        // for edit section
        var selected_cats = $('#cat_id_temp').val();
        if (selected_cats) {
            selected_cat_array = selected_cats.split(',');
            console.log(selected_cat_array);
        }

    });



    $('#category_tree').on('changed.jstree', function(e, data) {
        getCatFromTree();
    });

    function getCatFromTree() {
        var cat_id = $("#category_tree").jstree("get_selected").toString();
        console.log(cat_id);
        $('#cat_id').val(cat_id);
    }


    $(function() {


        $('#add_more_item').on('click', function() {
            var html = '<tr> <td><input type="text" class="form-control" id="size[]" name="size[]" placeholder="Size"></td> <td><button type="button" class="remove-item form-control btn btn-danger"><i class="uil uil-trash "></i></button> </td></tr>';
            $("#prodtable").append(html);
        });


        $("#prodtable").on('click', '.remove-item', function() {
            $(this).closest('tr').remove()
        });

        $('#add_product').formValidation({
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
                brand: {
                    validators: {
                        notEmpty: {
                            message: 'Please Select brand'
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