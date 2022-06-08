<script>
    $("#top_category").on('change', function() {
        var top_category = $(this).val();

        $.ajax({
            url: "<?php echo base_url(); ?>cc_admin/categories/getsubcats",
            type: "POST",
            data: {
                top_category: top_category
            },
            success: function(result) {
                var obj = JSON.parse(result);
                if (obj.status == 200) {
                    $("#sub_category").html(obj.options);
                } else {
                    toastr["error"]("message", obj.message);
                }
            }
        });
    });

    $(function() {

        $('#products_list').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                top_category: {
                    validators: {
                        notEmpty: {
                            message: 'Please select Top Category'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();

            $("#products_table_filter").dataTable().fnDestroy();

            $('#products_table_filter').DataTable({
                dom: 'lBfrtip',
                buttons: {
                    dom: {
                        button: {
                            tag: 'button',
                            className: ''
                        }
                    },
                    buttons: [{
                        extend: 'excel',
                        className: 'btn btn-block btn-dark',
                        titleAttr: 'Excel export.',
                        text: 'Export To Excel <i class="fa fa-file-excel-o ml-2"></i>',
                        filename: 'WH Stock Report',
                        title: '',
                        extension: '.xlsx',
                    }]
                },
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                "processing": true,
                "ajax": {
                    "url": base_url + 'cc_admin/products/products_data_ajax',
                    "type": 'POST',
                    "data": function(d) {
                        return $('#products_list').serialize();
                    },
                }
            });

            $('#submit_button').removeAttr('disabled').removeClass('disabled');

        });
    });


    function change_status_product(product_id, status, e) {

        var msg = '';
        var btn_text = '';
        if (status == 1) {
            var msg = 'Are you sure want to activate this Product';
            var btn_text = 'Yes, activate';
        } else if (status == 2) {
            var msg = 'Are you sure want to deactivate this Product';
            var btn_text = 'Yes, deactivate';
        } else if (status == 3) {
            var msg = 'Are you sure want to Delete this Product';
            var btn_text = 'Yes, delete';
        }
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
                var dataString = "id=" + product_id + "&status=" + status
                $.ajax({
                    url: base_url + 'cc_admin/products/change_status',
                    type: "POST",
                    data: dataString,
                    success: function(data) {
                        var obj = JSON.parse(data);
                        if (obj.status == 200) {

                            toastr["success"]("success", obj.message);

                            // setTimeout(function() {
                            //     window.location.href = base_url + 'admin_root/products';
                            // }, 3000);
                            var products_table_filter = $('#products_table_filter').DataTable();
                            if (status == 1) {
                                $(e).closest('tr').find('.p-status').removeClass('bg-soft-warning').addClass('bg-soft-success ').text('Active');
                            } else if (status == 2) {
                                $(e).closest('tr').find('.p-status').removeClass('bg-soft-success').addClass('bg-soft-warning ').text('In-Active');
                            } else {
                                products_table_filter
                                    .row($(e).closest('tr'))
                                    .remove()
                                    .draw();
                            }

                        } else {
                            toastr["error"]("Error", obj.message);
                        }
                    }
                });
            }
        });
    }
</script>