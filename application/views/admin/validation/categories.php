<script>
    $(function() {
        $("#categories").DataTable({}), $(".dataTables_length select").addClass("form-select form-select-sm");

        $('.parent_category').select2({
            dropdownParent: $('#add_category_modal'),
            width: '100%'
        });

        $('.parent_category_2').select2({
            dropdownParent: $('#edit_category_modal'),
            width: '100%'
        });

        $('.featured_select').select2({
            dropdownParent: $('#add_category_modal'),
            width: '100%'
        });

        $('.featured_select_edit').select2({
            dropdownParent: $('#edit_category_modal'),
            width: '100%'
        });


        $('#add_category').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                category_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Category Name'
                        }
                    }
                },
                category_position: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Category Menu Position'
                        },
                        integer: {
                            message: 'The value is not a valid integer number',
                        },
                    }
                },

            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target);

            var bv = $form.data('formValidation');

            $.ajax({
                url: $form.attr('action'),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
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

        $('#edit_category_form').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                category_nameedit: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Category Name'
                        }
                    }
                },
                category_position_edit: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Category Menu Position'
                        },
                        integer: {
                            message: 'The value is not a valid integer number',
                        },
                    }
                },

            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();

            var $form = $(e.target);

            var bv = $form.data('formValidation');

            $.ajax({
                url: $form.attr('action'),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
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

    function delete_category(cat_id) {

        var ajax_payload = {
            cat_id: cat_id
        }

        var msg = 'Are you sure want to Delete this Category';
        var btn_text = 'Yes, delete';

        Swal.fire({
            title: "Are you sure?",
            text: msg,
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: btn_text
        }).then(function(t) {

            if (t.value) {
                $.ajax({
                    url: base_url + 'cc_admin/categories/delete',
                    type: "POST",
                    data: ajax_payload,
                    success: function(data) {
                        var obj = JSON.parse(data);
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
            }
        });
    }

    function edit_category(cat_id) {
        var ajax_payload = {
            cat_id: cat_id
        }

        $.ajax({
            url: base_url + 'cc_admin/categories/get_data',
            type: "POST",
            data: ajax_payload,
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 200) {

                    $('#edit_category_modal').modal('show');
                    $('#category_nameedit').val(obj.data.category_name);
                    $('#category_position_edit').val(obj.data.position);
                    $('#parent_category_edit').val(obj.data.parent_category_id).change();
                    $('#featured_edit').val(obj.data.featured).change();
                    $('#cat_id').val(obj.data.id);

                } else {
                    toastr["error"]("message", obj.message);
                }
            }
        });
    }
</script>