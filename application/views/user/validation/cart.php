<script>
    function inc_cart_qty(product_id, size) {
        let payload = {
            product_id,
            size
        }

        $.ajax({
            url: base_url + 'cart/inc_cart_qty/',
            type: "POST",
            data: payload,
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 200) {
                    window.location.reload();
                } else {
                    toast_danger(obj.message)
                }
            },
            error: function(result) {
                toast_danger(result.statusText);
            }
        });
    }


    function des_cart_qty(product_id, size) {
        let payload = {
            product_id,
            size
        }

        $.ajax({
            url: base_url + 'cart/des_cart_qty/',
            type: "POST",
            data: payload,
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 200) {
                    window.location.reload();
                } else {
                    toast_danger(obj.message)
                }
            },
            error: function(result) {
                toast_danger(result.statusText);
            }
        });
    }

    function remove_from_cart(product_id, size) {
        payload = {
            product_id,
            size
        }
        $.ajax({
            url: base_url + 'cart/remove_from_cart/',
            type: "POST",
            data: payload,
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 200) {
                    toast_success(obj.message);
                    window.location.reload();
                } else {
                    toast_danger(obj.message)
                }
            },
            error: function(result) {
                toast_danger(result.statusText);
            }
        });
    }


    function remove_from_wishlist(product_id) {
        payload = {
            product_id
        }
        $.ajax({
            url: base_url + 'cart/remove_from_wishlist/',
            type: "POST",
            data: payload,
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.status == 200) {
                    toast_success(obj.message);
                    window.location.reload();
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