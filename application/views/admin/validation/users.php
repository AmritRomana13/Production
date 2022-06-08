<script>
    $(document).ready(function() {
        // for customers
        $("#customers_data").DataTable({
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
                    filename: 'Users Data ',
                    title: '',
                    extension: '.xlsx',
                }]
            },
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "processing": true,
            "ajax": base_url + 'cc_admin/home/customers_data_ajax'
        }), $(".dataTables_length select").addClass("form-select form-select-sm");
    });
</script>