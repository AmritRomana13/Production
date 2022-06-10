<!--MainContent-->
<div id="MainContent" class="main-content" role="main">
    <!--Breadcrumb-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="<?php echo base_url() ?>" title="Back to the home page">Home</a><span aria-hidden="true">›</span><span>Product</span>
        </div>
    </div>
    <!--End Breadcrumb-->

    <div id="ProductSection-product-template" class="product-template__container prstyle1 container">
        <!--product-single-->
        <div class="product-single">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="product-details-img">
                        <div class="product-thumb">
                            <div id="gallery" class="product-dec-slider-2 product-tab-left">
                                <?php
                                $images = json_decode($product_data->images);
                                foreach ($images as $image_row => $image) {
                                ?>
                                    <a style="height:80px ;" data-image="<?php echo base_url('uploads/products/') . $image ?>" data-zoom-image="<?php echo base_url('uploads/products/') . $image ?>" class="slick-slide slick-cloned" data-slick-index="<?php echo $image_row ?>" aria-hidden="true" tabindex="-1">
                                        <img class="blur-up lazyload" data-src="<?php echo base_url('uploads/products/') . $image ?>" src="<?php echo base_url('uploads/products/') . $image ?>" alt="" />
                                    </a>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                        <div class="zoompro-wrap product-zoom-right pl-20">
                            <div class="zoompro-span">
                                <img class="blur-up lazyload zoompro" data-zoom-image="<?php echo base_url('uploads/products/') . $images[0] ?>" alt="" src="<?php echo base_url('uploads/products/') . $images[0] ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <center>
                        <div>
                            <h1 style="font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-weight: 600;letter-spacing: 0.1em;"><?php echo $product_data->product_name ?></h1>
                        </div>
                        <div class="product colour"><?php echo $product_data->short_description ?></div>
                        <div class="product price" style="margin-top: 2vh;font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color: black;font-size: 25px;">₹<?php echo $product_data->sale_price ?></div>
                        <!-- <span style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Note: This is condition 9 shoes</span> -->
                        <form method="post" action="#" id="product_form_10508262282" style="margin-top: 3vh;" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">


                            <input type="hidden" id="product_id" name=" product_id" value="<?php echo $product_data->id ?>">
                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                <div class="product-form__item">

                                    <?php
                                    $sizes = explode(',', $product_data->sizes);
                                    foreach ($sizes as $key => $size) {
                                        if ($key == 0) {
                                            $checked = 'checked';
                                        } else {
                                            $checked = null;
                                        }
                                    ?>
                                        <div data-value="<?php echo $size ?>" class="swatch-element xl available">
                                            <input <?php echo $checked ?> class="swatchInput" id="swatch-1-<?php echo $size ?>" type="radio" name="size" value="<?php echo $size ?>">
                                            <label class="swatchLbl medium" for="swatch-1-<?php echo $size ?>" title="<?php echo $size ?>"><?php echo $size ?></label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </form>
                        <p class="infolinks" style="margin-top: 4vh;">
                            <a href="#sizechart" class="sizelink btn"> Size Guide</a>
                            <!-- <a href="#productInquiry" class="emaillink btn"> Ask About this Product</a> -->
                        </p>
                        <div><button id="add_to_cart" onclick="add_to_cart()" style="background-color: black;color: white;height: 8vh;width:200px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: larger;font-weight: 800;letter-spacing: 0.1em;">ADD TO CART</button></div>
                        <?php
                        $check_wishlist = checkwishlistb2c($product_data->id);
                        // $check_wishlist = true;
                        if ($check_wishlist) {
                            $text = 'Wishlisted';
                        } else {
                            $text = 'Add To Wishlist';
                        }
                        ?>
                        <div style="margin-top: 1vh;"><button onclick="add_to_wishlist()" style="background-color: grey;color: white;height: 8vh;width:200px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size: larger;font-weight: 800;letter-spacing: 0.1em;" id="addtowishlist"><?php echo $text ?></button></div>

                    </center>

                </div>
            </div>
        </div>
        <!--End-product-single-->
        <!--Product Tabs-->
        <div class="tabs-listing">
            <ul class="product-tabs">
                <li rel="tab1"><a class="tablink">Product Details</a></li>
                <li rel="tab3"><a class="tablink">Size Chart</a></li>
                <li rel="tab4"><a class="tablink">Shipping &amp; Returns</a></li>
            </ul>
            <div class="tab-container">
                <div id="tab1" class="tab-content">
                    <div class="product-description rte">
                        <?php
                        echo $product_data->description;
                        ?>
                    </div>
                </div>


                <div id="tab3" class="tab-content">
                    <h3>WOMEN'S BODY SIZING CHART</h3>
                    <table>
                        <tbody>
                            <tr>
                                <th>Size</th>
                                <th>XS</th>
                                <th>S</th>
                                <th>M</th>
                                <th>L</th>
                                <th>XL</th>
                            </tr>
                            <tr>
                                <td>Chest</td>
                                <td>31" - 33"</td>
                                <td>33" - 35"</td>
                                <td>35" - 37"</td>
                                <td>37" - 39"</td>
                                <td>39" - 42"</td>
                            </tr>
                            <tr>
                                <td>Waist</td>
                                <td>24" - 26"</td>
                                <td>26" - 28"</td>
                                <td>28" - 30"</td>
                                <td>30" - 32"</td>
                                <td>32" - 35"</td>
                            </tr>
                            <tr>
                                <td>Hip</td>
                                <td>34" - 36"</td>
                                <td>36" - 38"</td>
                                <td>38" - 40"</td>
                                <td>40" - 42"</td>
                                <td>42" - 44"</td>
                            </tr>
                            <tr>
                                <td>Regular inseam</td>
                                <td>30"</td>
                                <td>30½"</td>
                                <td>31"</td>
                                <td>31½"</td>
                                <td>32"</td>
                            </tr>
                            <tr>
                                <td>Long (Tall) Inseam</td>
                                <td>31½"</td>
                                <td>32"</td>
                                <td>32½"</td>
                                <td>33"</td>
                                <td>33½"</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>MEN'S BODY SIZING CHART</h3>
                    <table>
                        <tbody>
                            <tr>
                                <th>Size</th>
                                <th>XS</th>
                                <th>S</th>
                                <th>M</th>
                                <th>L</th>
                                <th>XL</th>
                                <th>XXL</th>
                            </tr>
                            <tr>
                                <td>Chest</td>
                                <td>33" - 36"</td>
                                <td>36" - 39"</td>
                                <td>39" - 41"</td>
                                <td>41" - 43"</td>
                                <td>43" - 46"</td>
                                <td>46" - 49"</td>
                            </tr>
                            <tr>
                                <td>Waist</td>
                                <td>27" - 30"</td>
                                <td>30" - 33"</td>
                                <td>33" - 35"</td>
                                <td>36" - 38"</td>
                                <td>38" - 42"</td>
                                <td>42" - 45"</td>
                            </tr>
                            <tr>
                                <td>Hip</td>
                                <td>33" - 36"</td>
                                <td>36" - 39"</td>
                                <td>39" - 41"</td>
                                <td>41" - 43"</td>
                                <td>43" - 46"</td>
                                <td>46" - 49"</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <img src="<?php echo base_url('assets/') ?>images/size.jpg" alt="" />
                    </div>
                </div>

                <div id="tab4" class="tab-content">
                    <h4>Returns Policy</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eros justo, accumsan non dui sit amet. Phasellus semper volutpat mi sed imperdiet. Ut odio lectus, vulputate non ex non, mattis sollicitudin purus. Mauris consequat justo a enim interdum, in consequat dolor accumsan. Nulla iaculis diam purus, ut vehicula leo efficitur at.</p>
                    <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. In blandit nunc enim, sit amet pharetra erat aliquet ac.</p>
                    <h4>Shipping</h4>
                    <p>Pellentesque ultrices ut sem sit amet lacinia. Sed nisi dui, ultrices ut turpis pulvinar. Sed fringilla ex eget lorem consectetur, consectetur blandit lacus varius. Duis vel scelerisque elit, et vestibulum metus. Integer sit amet tincidunt tortor. Ut lacinia ullamcorper massa, a fermentum arcu vehicula ut. Ut efficitur faucibus dui Nullam tristique dolor eget turpis consequat varius. Quisque a interdum augue. Nam ut nibh mauris.</p>
                </div>
            </div>
        </div>
        <!--End Product Tabs-->

        <!--Related Product Slider-->
        <div class="related-product grid-products">
            <header class="section-header">
                <h2 class="section-header__title text-center h2"><span>Related Products</span></h2>
            </header>
            <div class="productPageSlider">
                <?php
                if (!empty($related_products)) {
                    foreach ($related_products as $related_product) {
                ?>
                        <div class="col-12 item">
                            <div class="product-image">
                                <a href="<?php echo base_url('view_product/') . $related_product->slug ?>">
                                    <img class="primary blur-up lazyload" data-src="<?php echo base_url('uploads/products/') .  json_decode($related_product->images)[0] ?>" src="<?php echo base_url('uploads/products/') .  json_decode($related_product->images)[0] ?>" alt="image" title="<?php echo $related_product->product_name ?>">
                                </a>
                            </div>
                            <div class="product-details text-center">
                                <div class="product-name">
                                    <a href="<?php echo base_url('view_product/') . $related_product->slug ?>"><?php echo $related_product->product_name ?></a>
                                </div>
                                <div class="product-price">
                                    <span class="price">₹ <?php echo $related_product->sale_price ?></span>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <!--End Related Product Slider-->

    </div>
    <!--#ProductSection-product-template-->
</div>
<!--MainContent-->

<div class="hide">
    <div id="sizechart">
        <h3>WOMEN'S BODY SIZING CHART</h3>
        <table>
            <tbody>
                <tr>
                    <th>Size</th>
                    <th>XS</th>
                    <th>S</th>
                    <th>M</th>
                    <th>L</th>
                    <th>XL</th>
                </tr>
                <tr>
                    <td>Chest</td>
                    <td>31" - 33"</td>
                    <td>33" - 35"</td>
                    <td>35" - 37"</td>
                    <td>37" - 39"</td>
                    <td>39" - 42"</td>
                </tr>
                <tr>
                    <td>Waist</td>
                    <td>24" - 26"</td>
                    <td>26" - 28"</td>
                    <td>28" - 30"</td>
                    <td>30" - 32"</td>
                    <td>32" - 35"</td>
                </tr>
                <tr>
                    <td>Hip</td>
                    <td>34" - 36"</td>
                    <td>36" - 38"</td>
                    <td>38" - 40"</td>
                    <td>40" - 42"</td>
                    <td>42" - 44"</td>
                </tr>
                <tr>
                    <td>Regular inseam</td>
                    <td>30"</td>
                    <td>30½"</td>
                    <td>31"</td>
                    <td>31½"</td>
                    <td>32"</td>
                </tr>
                <tr>
                    <td>Long (Tall) Inseam</td>
                    <td>31½"</td>
                    <td>32"</td>
                    <td>32½"</td>
                    <td>33"</td>
                    <td>33½"</td>
                </tr>
            </tbody>
        </table>
        <h3>MEN'S BODY SIZING CHART</h3>
        <table>
            <tbody>
                <tr>
                    <th>Size</th>
                    <th>XS</th>
                    <th>S</th>
                    <th>M</th>
                    <th>L</th>
                    <th>XL</th>
                    <th>XXL</th>
                </tr>
                <tr>
                    <td>Chest</td>
                    <td>33" - 36"</td>
                    <td>36" - 39"</td>
                    <td>39" - 41"</td>
                    <td>41" - 43"</td>
                    <td>43" - 46"</td>
                    <td>46" - 49"</td>
                </tr>
                <tr>
                    <td>Waist</td>
                    <td>27" - 30"</td>
                    <td>30" - 33"</td>
                    <td>33" - 35"</td>
                    <td>36" - 38"</td>
                    <td>38" - 42"</td>
                    <td>42" - 45"</td>
                </tr>
                <tr>
                    <td>Hip</td>
                    <td>33" - 36"</td>
                    <td>36" - 39"</td>
                    <td>39" - 41"</td>
                    <td>41" - 43"</td>
                    <td>43" - 46"</td>
                    <td>46" - 49"</td>
                </tr>
            </tbody>
        </table>
        <div style="padding-left: 30px;"><img src="<?php echo base_url('assets/images/size.jpg') ?>" alt=""></div>
    </div>
</div>