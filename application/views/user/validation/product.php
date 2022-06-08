<script>
    function add_to_cart() {
        let product_id = $('#product_id').val();
        let selected_sizes = $('input[name="size"]:checked').val();

        let payload = {
            product_id,
            selected_sizes
        }

        $.ajax({
            url: base_url + 'cart/add_to_cart/',
            type: "POST",
            data: payload,
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 200) {
                    toast_success(obj.message);
                    $('#add_to_cart').text('Added to cart');
                } else {
                    toast_danger(obj.message)
                }
            },
            error: function(result) {
                toast_danger(result.statusText);
            }
        });
    }

    function add_to_wishlist() {
        let product_id = $('#product_id').val();
        let payload = {
            product_id
        }

        $.ajax({
            url: base_url + 'cart/add_to_wishlist/',
            type: "POST",
            data: payload,
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 200) {
                    toast_success(obj.message);
                    $('#addtowishlist').text(obj.btn_text);
                } else {
                    toast_danger(obj.message)
                }
            },
            error: function(result) {
                toast_danger(result.statusText);
            }
        });
    }
</script>