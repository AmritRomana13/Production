<script>
    $(document).ready(function() {
        $("#datatable-buttons").DataTable({
            lengthChange: !1,
            buttons: ["excel"]
        }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");


        $('.dataselct').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: "true"
        });
    });
</script>

<script>
    $(function() {
        $('#sales_report').formValidation({
            message: 'This value is not valid',
            icon: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                from_date: {
                    validators: {
                        notEmpty: {
                            message: 'Please select an From Date'
                        }
                    }
                },
                to_date: {
                    validators: {
                        notEmpty: {
                            message: 'Please select an To Date'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();

            $("#sales_data").dataTable().fnDestroy();

            $('#sales_data').DataTable({
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
                        filename: 'Sales report' + $("#from_date").val() + ' to ' + $("#to_date").val(),
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
                    "url": base_url + 'cc_admin/orders/sales_report_data',
                    "type": 'POST',
                    "data": function(d) {
                        return $('#sales_report').serialize();
                    },
                    "dataSrc": function(json) {
                        $('#total_sale').text(json.meta.total_sale);
                        $('#total_royality').text(json.meta.total_royality);
                        return json.data;
                    }
                }
            });

            $('#submit_button').removeAttr('disabled').removeClass('disabled');

        });
    });


    function print_invoice(oid) {
        window.open('<?php echo base_url('cc_admin/orders/print_invoice/') ?>' + oid, '_blank').focus();
    }
</script>