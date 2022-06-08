<!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper">
            <h1 class="page-width">Checkout</h1>
        </div>
    </div>
</div>
<!--End Page Title-->

<div class="container">

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
            <div id="alert_message" class="d-none alert rounded">
            </div>
        </div>


    </div>
    <form id="checkout" name="checkout">
        <div class="row billing-fields">

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
                <div class="create-ac-content bg-light-gray padding-20px-all">

                    <fieldset>
                        <h2 class="login-title mb-3">Billing details</h2>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="firstname">First Name <span class="required-f">*</span></label>
                                <input name="firstname" value="" required id="firstname" type="text">
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="lastname">Last Name <span class="required-f">*</span></label>
                                <input name="lastname" value="" required id="lastname" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="email">E-Mail <span class="required-f">*</span></label>
                                <input name="email" value="" required id="email" type="email">
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="telephone">Telephone <span class="required-f">*</span></label>
                                <input name="telephone" value="" required id="telephone" type="tel">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                <label for="company">Company</label>
                                <input name="company" value="" required id="company" type="text">
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="address_1">Address <span class="required-f">*</span></label>
                                <input name="address_1" value="" required id="address_1" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                <label for="address_2">Apartment <span class="required-f">*</span></label>
                                <input name="address_2" value="" required id="address_2" type="text">
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="city">City <span class="required-f">*</span></label>
                                <input name="city" value="" required id="city" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="postcode">Post Code <span class="required-f">*</span></label>
                                <input name="postcode" value="" required id="postcode" type="text">
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="country_id">Country <span class="required-f">*</span></label>
                                <select name="country_id" required id="country_id">
                                    <option value=""> --- Please Select --- </option>
                                    <option value="244">Aaland Islands</option>
                                    <option value="1">Afghanistan</option>
                                    <option value="2">Albania</option>
                                    <option value="3">Algeria</option>
                                    <option value="4">American Samoa</option>
                                    <option value="5">Andorra</option>
                                    <option value="6">Angola</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="zone_id">Region / State <span class="required-f">*</span></label>
                                <select name="zone_id" required id="zone_id">
                                    <option value=""> --- Please Select --- </option>
                                    <option value="3513">Aberdeen</option>
                                    <option value="3514">Aberdeenshire</option>
                                    <option value="3515">Anglesey</option>
                                    <option value="3516">Angus</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                <label for="order_note">Order Notes <span class="required-f">*</span></label>
                                <textarea id="order_note" name="order_note" class="form-control resize-both" rows="3"></textarea>
                            </div>
                        </div>
                    </fieldset>

                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $key => $product) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $key + 1 ?></th>
                                    <td><a target="_blank" href="img_forest.jpg">
                                            <img src="<?php echo base_url('uploads/products/') .  json_decode($product->images)[0] ?>" style="width: 100px;height: 100px;" alt="Forest" style="width:150px">
                                        </a></td>
                                    <td><?php echo $product->qty ?></td>
                                    <td>₹<?php echo $product->qty * $product->sale_price ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <div class="customer-box customer-coupon">
                    <input type="submit" name="place_order" id="place_order" class="btn btn--small-wide checkout w-100" value="Checkout">
                </div>
            </div>

        </div>
    </form>
</div>