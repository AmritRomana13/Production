<style>
    .product-form .swatch .swatchInput+.swatchLbl {
        text-transform: uppercase
    }

    .price-filter input[type="text"] {
        font-family: 'Courier New', Courier, monospace;
        font-weight: bold;
    }
</style>
<!--Sidebar-->
<div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
    <div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
    <div class="sidebar_tags">
        <div class="sidebar_widget filterBox filter-widget">
            <b> PRODUCT FILTERS</b>
        </div>
        <!--Price Filter-->
        <div class="sidebar_widget filterBox filter-widget">
            <div class="widget-title">
                <h2>Price</h2>
            </div>
            <form action="#" method="post" class="price-filter">
                <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="no-margin"><input readonly id="amount" type="text"></p>
                        <input type="hidden" id="min_amount">
                        <input type="hidden" id="max_amount">
                    </div>
                    <!-- <div class="col-6 text-right margin-25px-top">
                        <button class="btn btn-secondary btn--small" type="button" onclick="update_filter_parms()">filter</button>
                    </div> -->
                </div>
            </form>
        </div>
        <!--End Price Filter-->
        <!--Size Swatches-->
        <div class="sidebar_widget filterBox filter-widget size-swacthes">
            <div class="widget-title">
                <h2>Size</h2>
            </div>
            <div class="filter-color swacth-list product-form ">
                <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                    <div class="product-form__item">

                        <?php
                        if (!empty($availabe_sizes)) {
                            foreach ($availabe_sizes as $key => $size) {
                                if (!empty($_GET['sizes'])) {
                                    $getSizes = explode(",", $_GET['sizes']);
                                    if (in_array($size, $getSizes)) {
                                        $checked = "checked";
                                    } else {
                                        $checked = "";
                                    }
                                } else {
                                    $checked = null;
                                }
                        ?>
                                <div data-value="<?php echo $size ?>" class="swatch-element xl available">
                                    <input <?php echo $checked ?> class="swatchInput" id="swatch-1-<?php echo $size ?>" type="checkbox" name="size[]" value="<?php echo $size ?>" onchange="update_filter_parms()">
                                    <label class="swatchLbl medium" for="swatch-1-<?php echo $size ?>" title="<?php echo $size ?>"><?php echo $size ?></label>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <!--End Size Swatches-->

        <!--Brand-->
        <div class="sidebar_widget filterBox filter-widget">
            <div class="widget-title">
                <h2>Brands</h2>
            </div>
            <ul>
                <?php
                $brands = get_brands();
                if (!empty($brands)) {
                    foreach ($brands as $brand) {

                        if (!empty($_GET['brand_name'])) {
                            $getBrands = explode(",", $_GET['brand_name']);
                            if (in_array($brand->id, $getBrands)) {
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }
                        } else {
                            $checked = null;
                        }
                ?>
                        <li>
                            <input <?php echo $checked ?> type="checkbox" name="brand[]" value="<?php echo $brand->id ?>" id="brand_<?php echo $brand->id ?>" onchange="update_filter_parms()">
                            <label for="brand_<?php echo $brand->id ?>"><span><span></span></span><?php echo $brand->brand_name ?></label>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
        <!--End Brand-->

    </div>
</div>
<!--End Sidebar-->