<script>
    const max_value = <?php echo get_max_amount() ?>;
    let selected_max = max_value;

    function price_slider() {

        let minamount = 0;
        <?php
        if (!empty($minamount)) {
        ?>
            minamount = <?php echo $minamount ?>;
        <?php
        }
        ?>

        <?php
        if (!empty($maxamount)) {
        ?>
            selected_max = <?php echo $maxamount ?>;
        <?php
        }
        ?>

        $("#slider-range").slider({
            range: true,
            min: 0,
            max: max_value,
            values: [minamount, selected_max],
            slide: function(event, ui) {
                $("#amount").val("₹" + ui.values[0] + " - ₹" + ui.values[1]);
                $('#min_amount').val(ui.values[0]);
                $('#max_amount').val(ui.values[1]);
            },
            change: function(event, ui) {
                update_filter_parms();
            }
        });
        $("#amount").val("₹" + $("#slider-range").slider("values", 0) + " - ₹" + $("#slider-range").slider("values", 1));
        $('#min_amount').val($("#slider-range").slider("values", 0));
        $('#max_amount').val($("#slider-range").slider("values", 1));
    }

    function update_filter_parms() {
        var brand_name = new Array();
        var brandnames = '';

        var size_names = new Array();
        var sizes = '';


        $('[name="size[]"]:checked').each(function() {
            size_names.push($(this).val());
        });

        $('[name="brand[]"]:checked').each(function() {
            brand_name.push($(this).val());
        });

        sizes = size_names.join(",");
        brandnames = brand_name.join(",");

        minamount = $('#min_amount').val();
        maxamount = $('#max_amount').val();


        finalUrl = "<?php echo base_url(); ?>search/Filter_search/?keyword=<?php echo @$_GET['keyword'] ?>&brand_name=" + brandnames + "&sizes=" + sizes + "&minamount=" + minamount + "&maxamount=" + maxamount;
        window.location.href = encodeURI(finalUrl);
        // console.log(finalUrl);
    }
    price_slider();
</script>