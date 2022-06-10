<div class="section imgBanners pt-0">
    <div class="container">
        <div class="row">

            <div class="col-12 col-sm-12 col-md-6 col-lg-6 pl-0" style="margin-top: 5vh;">
                <ul style="list-style-type:square;margin-left: 5vh;font-size: 18px;color: black;letter-spacing: 0.1em;">
                    <li><?php echo @$banners->title ?></li>
                </ul>

                <div class="imgBnrOuter" style="object-fit: contain;margin-top: 5vh;">
                    <div class="inner btmright">
                        <img data-src="assets/images/product-images/9.jpg" src="assets/images/home3-small-banner9.jpg" alt="" class="blur-up lazyload" />

                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 pr-0" style="margin-top:13vh">
                <div class="container">
                    <div class="row">


                        <?php
                        $product_1_data = getproductdata($banners->product_1);
                        if (!empty($product_1_data)) {
                        ?>
                            <div class="col">
                                <div class="product-image">
                                    <a href="<?php echo base_url('view_product/') . $product_1_data->slug ?>" class="grid-view-item__link">
                                        <img class="primary blur-up lazyload" data-src="<?php echo base_url('uploads/products/') .  json_decode($product_1_data->images)[0] ?>" style="max-height: 250px;object-fit: contain;" alt="image" title="product">
                                </div>
                                <div class="product-details">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_1_data->slug ?>" style="color: black;font-size:small;"><?php echo $product_1_data->product_name ?></a>
                                    </div>
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_1_data->slug ?>" style="font-size: x-small;"><?php echo $product_1_data->brand_name ?></a>
                                    </div>
                                    <div class="product-price">
                                        <span class="price" style="font-size: small;">₹<?php echo $product_1_data->sale_price ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <?php
                        $product_2_data = getproductdata($banners->product_2);
                        if (!empty($product_2_data)) {
                        ?>
                            <div class="col">
                                <div class="product-image">
                                    <a href="<?php echo base_url('view_product/') . $product_2_data->slug ?>" class="grid-view-item__link">
                                        <img class="primary blur-up lazyload" data-src="<?php echo base_url('uploads/products/') .  json_decode($product_2_data->images)[0] ?>" style="max-height: 250px;object-fit: contain;" alt="image" title="product">
                                </div>
                                <div class="product-details">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_2_data->slug ?>" style="color: black;font-size:small;"><?php echo $product_2_data->product_name ?></a>
                                    </div>
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_2_data->slug ?>" style="font-size: x-small;"><?php echo $product_2_data->brand_name ?></a>
                                    </div>
                                    <div class="product-price">
                                        <span class="price" style="font-size: small;">₹<?php echo $product_2_data->sale_price ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="w-100"></div>
                        <?php
                        $product_3_data = getproductdata($banners->product_3);
                        if (!empty($product_3_data)) {
                        ?>
                            <div class="col">
                                <div class="product-image">
                                    <a href="<?php echo base_url('view_product/') . $product_3_data->slug ?>" class="grid-view-item__link">
                                        <img class="primary blur-up lazyload" data-src="<?php echo base_url('uploads/products/') .  json_decode($product_3_data->images)[0] ?>" style="max-height: 250px;object-fit: contain;" alt="image" title="product">
                                </div>
                                <div class="product-details">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_3_data->slug ?>" style="color: black;font-size:small;"><?php echo $product_3_data->product_name ?></a>
                                    </div>
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_3_data->slug ?>" style="font-size: x-small;"><?php echo $product_3_data->brand_name ?></a>
                                    </div>
                                    <div class="product-price">
                                        <span class="price" style="font-size: small;">₹<?php echo $product_3_data->sale_price ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        $product_4_data = getproductdata($banners->product_4);
                        if (!empty($product_4_data)) {
                        ?>
                            <div class="col">
                                <div class="product-image">
                                    <a href="<?php echo base_url('view_product/') . $product_4_data->slug ?>" class="grid-view-item__link">
                                        <img class="primary blur-up lazyload" data-src="<?php echo base_url('uploads/products/') .  json_decode($product_4_data->images)[0] ?>" style="max-height: 250px;object-fit: contain;" alt="image" title="product">
                                </div>
                                <div class="product-details">
                                    <!-- product name -->
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_4_data->slug ?>" style="color: black;font-size:small;"><?php echo $product_4_data->product_name ?></a>
                                    </div>
                                    <div class="product-name">
                                        <a href="<?php echo base_url('view_product/') . $product_4_data->slug ?>" style="font-size: x-small;"><?php echo $product_4_data->brand_name ?></a>
                                    </div>
                                    <div class="product-price">
                                        <span class="price" style="font-size: small;">₹<?php echo $product_4_data->sale_price ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>