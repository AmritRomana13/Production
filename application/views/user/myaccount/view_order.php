<!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper">
            <h1 class="page-width">Order Details</h1>
        </div>
    </div>
</div>
<!--End Page Title-->

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
            <form action="#">
                <div class="wishlist-table table-content table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-price text-center alt-font">Image</th>
                                <th class="product-name alt-font">Product</th>
                                <th class="stock-status text-center alt-font">Brand</th>
                                <th class="product-price text-center alt-font">Qty</th>
                                <th class="product-subtotal text-center alt-font">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($order_products)) {
                                foreach ($order_products as $product) {
                            ?>
                                    <tr>
                                        <td class="product-thumbnail text-center">
                                            <a href="<?php echo base_url('view_product/') . $product->slug ?>"><img src="<?php echo base_url('uploads/products/') .  json_decode($product->images)[0] ?>" alt="" title="" /></a>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="no-margin"><a href="<?php echo base_url('view_product/') . $product->slug ?>"><?php echo $product->product_name ?></a></h4>
                                        </td>
                                        <td class="stock text-center">
                                            <span class="in-stock"><?php echo $product->brand_name ?></span>
                                        </td>
                                        <td class="product-price text-center"><span class="amount"><?php echo $product->qty ?></span></td>
                                        <td class="product-price text-center"><span class="amount">₹<?php echo $product->total_price ?></span></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="product-price text-center alt-font" colspan="6">
                                        No products Found
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>