<!--Collection Tab slider-->
<div class="tab-slider-product section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="section-header text-center">
                    <h2 class="h2">Featured</h2>

                </div>
                <div class="tabs-listing">
                    <ul class="tabs clearfix">
                        <!-- <li class="active" rel="tab1">Sneakers</li>
                        <li rel="tab2">Clothing</li>
                        <li rel="tab3">Jewellery</li> -->

                        <?php
                        if (!empty($featured_categories)) {
                            foreach ($featured_categories as $row => $featured_categorie) {
                                $active = null;
                                if ($row == 0) {
                                    $active = 'active';
                                }
                        ?>
                                <li class="<?php echo $active ?>" rel="featured_categorie_<?php echo $featured_categorie->id ?>"><?php echo $featured_categorie->category_name ?></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    <div class="tab_container">
                        <?php
                        if (!empty($featured_categories)) {
                            foreach ($featured_categories as $row => $featured_categorie) {
                                $active = null;
                                if ($row == 0) {
                                    $active = 'active';
                                }

                                $products = getproductsincaat($featured_categorie->id);

                        ?>

                                <div id="featured_categorie_<?php echo $featured_categorie->id ?>" class="tab_content grid-products">
                                    <div class="productSlider">

                                        <?php
                                        if (!empty($products)) {
                                            foreach ($products as $key => $product) {
                                        ?>
                                                <div class="col">
                                                    <div class="product-image">
                                                        <a href="<?php echo base_url('view_product/') . $product->slug ?>" class="grid-view-item__link">
                                                            <img class="primary blur-up lazyload" data-src="<?php echo base_url('uploads/products/') .  json_decode($product->images)[0] ?>" style="object-fit: contain;height: 250px;" alt="image" title="product">
                                                    </div>
                                                    <div class="product-details">
                                                        <div class="product-name">
                                                            <a href="<?php echo base_url('view_product/') . $product->slug ?>" style="color: black;font-size:small;"><?php echo $product->product_name ?></a>
                                                        </div>
                                                        <!-- <div class="product-name">
                                                            <a href="<?php echo base_url('view_product/') . $product->slug ?>" style="font-size: x-small;">NIKE</a>
                                                        </div> -->
                                                        <div class="product-price">
                                                            <span class="price" style="font-size: small;">₹<?php echo $product->sale_price ?></span>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Collection Tab slider-->