<script>
    $(function() {
        $("#categories").DataTable({}), $(".dataTables_length select").addClass("form-select form-select-sm");

        $('.parent_category').select2({
            dropdownParent: $('#add_category_modal'),
            width: '100%'
        });


        $('#add_category').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                brand_name: {
                    validators: {
                        notEmpty: {
                            message: 'Please Enter Brand Name'
                        }
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

        var msg = 'Are you sure want to Delete this Brand';
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
                    url: base_url + 'cc_admin/categories/delete_brand',
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
</script>