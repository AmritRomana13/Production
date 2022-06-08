<?php
$total = array();
?>

<!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper">
            <h1 class="page-width">Your cart</h1>
        </div>
    </div>
</div>
<!--End Page Title-->

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
            <form action="#" method="post" class="cart style2">
                <table class="table">
                    <thead class="cart_row cart_header">
                        <tr>
                            <th colspan="2" class="text-center">Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-right">Total</th>
                            <th class="action">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                $total[] = $product->sale_price * round($product->qty);
                        ?>
                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                    <td class="cart__image-wrapper cart-flex-item">
                                        <a href="#"><img class="cart__image" src="<?php echo base_url('uploads/products/') .  json_decode($product->images)[0] ?>" alt="<?php echo $product->product_name ?>"></a>
                                    </td>
                                    <td class="cart__meta small--text-left cart-flex-item">
                                        <div class="list-view-item__title">
                                            <a href="#"><?php echo $product->product_name ?> </a>
                                        </div>

                                        <div class="cart__meta-text">
                                            Size: <?php echo $product->size ?><br>
                                        </div>
                                    </td>
                                    <td class="cart__price-wrapper cart-flex-item">
                                        <span class="money">₹<?php echo $product->sale_price ?></span>
                                    </td>
                                    <td class="cart__update-wrapper cart-flex-item text-right">
                                        <div class="cart__qty text-center">
                                            <div class="qtyField">
                                                <a class="qtyBtn minus" onclick="des_cart_qty(<?php echo $product->id ?>,'<?php echo $product->size ?>')" href="javascript:void(0);"><i class="icon icon-minus"></i></a>
                                                <input class="cart__qty-input qty" type="text" name="updates[]" id="qty" value="<?php echo round($product->qty) ?>" pattern="[0-9]*" readonly>
                                                <a class="qtyBtn plus" onclick="inc_cart_qty(<?php echo $product->id ?>,'<?php echo $product->size ?>')" href="javascript:void(0);"><i class="icon icon-plus"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right small--hide cart-price">
                                        <div><span class="money">₹<?php echo $product->sale_price * round($product->qty) ?></span></div>
                                    </td>
                                    <td class="text-center small--hide"><a href="#" onclick="remove_from_cart(<?php echo $product->id ?>,'<?php echo $product->size ?>')" class="btn btn--secondary cart__remove" title="Remove tem"><i class="icon icon anm anm-times-l"></i></a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>


                <hr>


            </form>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
            <div class="solid-border">
                <div class="row">
                    <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Subtotal</strong></span>
                    <span class="col-12 col-sm-6 cart_subtotal-title cart_subtotal text-right"><span class="money">₹<?php echo array_sum($total); ?></span></span>
                </div>
                <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                <!-- <p class="cart_tearm">
                    <label>
                        <input type="checkbox" name="tearm" id="cartTearm" class="checkbox" value="tearm" required="">
                        I agree with the terms and conditions</label>
                </p> -->
                <!-- <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout" value="Checkout" disabled="disabled"> -->
                <a href="<?php echo base_url('checkout/') ?>" id="cartCheckout" class="btn btn--small-wide checkout">Checkout</a>
                <div class="paymnet-img"><img src="<?php echo base_url('assets/') ?>images/payment-img.jpg" alt="Payment"></div>
            </div>

        </div>
    </div>
</div>