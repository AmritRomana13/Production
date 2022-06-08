<script>
    $(function() {
        $("#sliders").DataTable({}), $(".dataTables_length select").addClass("form-select form-select-sm");
    });

    function delete_banner(cat_id) {

        var ajax_payload = {
            cat_id: cat_id
        }

        var msg = 'Are you sure want to Delete this Banner';
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
                    url: base_url + 'cc_admin/sliders/delete_banner',
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

    function delete_slider(cat_id) {

        var ajax_payload = {
            cat_id: cat_id
        }

        var msg = 'Are you sure want to Delete this Slider';
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
                    url: base_url + 'cc_admin/sliders/delete_slider',
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