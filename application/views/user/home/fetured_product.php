<div class="section product-single product-template__container" style="margin-bottom:2vh">
    <div class="container">
        <div class="product-single-wrap">
            <div class="row display-table">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 display-table-cell">
                    <img src="<?php echo base_url('uploads/products/') .  json_decode($product->images)[0] ?>" style="width: 500px;height: 500px;" alt="" class="product-featured-img" />
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 display-table-cell">
                    <div class="product-single__meta">
                        <h2 class="grid_item-title h2">Steal The Deal</h2>
                        <h3 style="color:grey" class="product-single__title h4">
                            <a href="<?php echo base_url('view_product/') . $product->slug ?>"> <?php echo $product->product_name ?></a>
                        </h3>
                        <p class="product-single__price">
                            
                            <span class="product-price__price product-price__sale product-price__sale--single">
                                <span class="money" style="color:black  ;">₹<?php echo $product->sale_price ?></span>
                            </span>
                        </p>
                        <div class="product-single__description rte" style="font-family: Arial, Helvetica, sans-serif; color: black;font-weight: 400;">
                            <?php echo $product->short_description ?>
                        </div>
                        <!-- Product Action -->
                        <div class="product-action clearfix">

                            <div class="product-form__item--submit">
                                <a href="<?php echo base_url('view_product/') . $product->slug ?>" type="button" name="add" class="btn product-form__cart-submit">
                                    <span>Add to cart</span>
                                </a>
                            </div>
                            <div class="display-table shareRow">
                                <div class="display-table-cell">
                                    
                                </div>
                            </div>
                        </div>
                        <!-- End Product Action -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>