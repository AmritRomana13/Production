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
                                <label for="telephone">Mobile no. <span class="required-f">*</span></label>
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
                                    <option value="244">India</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="zone_id">Region / State <span class="required-f">*</span></label>
                                <select name="zone_id" required id="zone_id">
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                <label for="order_note">Order Notes <span >*</span></label>
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