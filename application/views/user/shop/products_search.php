<div id="page-content" style="margin-top: 5vh;">


    <div class="container">
        <div class="row">
            <?php $this->load->view('user/common/product_sidebar.php'); ?>
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">


                <div class="productList product-load-more">
                    <!--Toolbar-->
                    <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <div class="row">
                                <div class="col-6 col-md-6 col-lg-6 text-center filters-toolbar__item filters-toolbar__item--count d-flex justify-content-center align-items-center">
                                    <span class="filters-toolbar__product-count">Showing <?php echo $x ?>–<?php echo $y ?> of <?php echo $z ?> results</span>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6 text-right">
                                    <div class="filters-toolbar__item">

                                        <!-- <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort" style="background-color: black;color: aliceblue;">
                                            <option value="title-ascending" selected="selected">Sort </option>
                                            <option>Best Selling</option>
                                            <option>Alphabetically, A-Z</option>
                                            <option>Alphabetically, Z-A</option>
                                            <option>Price, low to high</option>
                                            <option>Price, high to low</option>
                                            <option>Date, new to old</option>
                                            <option>Date, old to new</option>
                                        </select> -->
                                        <input class="collection-header__default-sort" type="hidden" value="manual">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--End Toolbar-->
                    <div class="grid-products grid--view-items">
                        <div class="row">

                            <?php
                            if (!empty($products)) {
                                foreach ($products as $product) {
                            ?>
                                    <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                        <div class="product-image">
                                            <a href="<?php echo base_url('view_product/') . $product->slug ?>" class="grid-view-item__link">
                                                <img class="primary blur-up lazyload" data-src="<?php echo base_url('uploads/products/') .  json_decode($product->images)[0] ?>" style="height: 300px;object-fit: contain;" alt="image" title="product">
                                            </a>
                                        </div>
                                        <div class="product-details text-center">
                                            <div class="product-name">
                                                <a href="<?php echo base_url('view_product/') . $product->slug ?>"><?php echo $product->product_name ?></a>
                                            </div>
                                            <div class="product-price">

                                                <?php
                                                if ($product->sale_price == $product->product_price) {
                                                ?>
                                                    <span class="priced">₹ <?php echo $product->sale_price ?></span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="old-price">₹ <?php echo $product->product_price ?></span>
                                                    <span class="priced">₹ <?php echo $product->sale_price ?></span>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="infinitpaginOuter d-block">
                    <div class="infinitpagin d-block">
                        <!-- <ul id="siteNav" class="site-nav medium center hidearrow d-block">

                            <li class="lvl1 parent megamenu"><a href="#" style="background-color: black;color: aliceblue;">1<i class="anm anm-angle-down-l"></i></a>

                            </li>
                            <li class="lvl1 parent megamenu"><a href="#" style="background-color: black;color: aliceblue;">2 <i class="anm anm-angle-down-l"></i></a>

                            </li>
                            <li class="lvl1 parent megamenu"><a href="#" style="background-color: black;color: aliceblue;">3 <i class="anm anm-angle-down-l"></i></a>

                            </li>
                            <li class="lvl1 parent megamenu"><a href="#" style="background-color: black;color: aliceblue;">4<i class="anm anm-angle-down-l"></i></a>

                            </li>
                        </ul> -->
                        <?php
                        echo $pagination
                        ?>
                    </div>
                </div>
            </div>
            <!--End Main Content-->
        </div>
    </div>

</div>