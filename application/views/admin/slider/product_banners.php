<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Add Product Banners</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sliders</a></li>
                            <li class="breadcrumb-item active">Add Slider</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form class="needs-validation" id="add_slider" name="add_slider" action="<?php echo base_url('cc_admin/sliders/add_product_banners') ?>">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Banner 1</h4>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="banner_title_1">Title <code>*</code></label>
                                        <input type="text" class="form-control" required id="banner_title_1" value="<?php echo @$banners_1->title ?>" name="banner_title_1" placeholder="Title" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="image_1">Image </label>
                                        <input type="file" class="form-control"  id="image_1" name="image_1">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_1_1">1St Product <code>*</code></label>
                                        <select name="product_1_1" required id="product_1_1" class="form-control select2">
                                            <option value="">Select 1St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_1->product_1 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_1_2">2St Product <code>*</code></label>
                                        <select name="product_1_2" required id="product_1_2" class="form-control select2">
                                            <option value="">Select 2St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_1->product_2 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_1_3">3St Product <code>*</code></label>
                                        <select name="product_1_3" required id="product_1_3" class="form-control select2">
                                            <option value="">Select 3St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_1->product_3 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_1_4">4St Product <code>*</code></label>
                                        <select name="product_1_4" required id="product_1_4" class="form-control select2">
                                            <option value="">Select 4St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_1->product_4 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Banner 2</h4>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="banner_title_2">Title <code>*</code></label>
                                        <input type="text" class="form-control" required id="banner_title_2" name="banner_title_2" placeholder="Title" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="image_2">Image </label>
                                        <input type="file" class="form-control" value="<?php echo @$banners_2->title ?>" id="image_2" name="image_2">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_2_1">1St Product <code>*</code></label>
                                        <select name="product_2_1" required id="product_2_1" class="form-control select2">
                                            <option value="">Select 1St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_2->product_1 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_2_2">2St Product <code>*</code></label>
                                        <select name="product_2_2" required id="product_2_2" class="form-control select2">
                                            <option value="">Select 2St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_2->product_2 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_2_3">3St Product <code>*</code></label>
                                        <select name="product_2_3" required id="product_2_3" class="form-control select2">
                                            <option value="">Select 3St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_2->product_3 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_2_4">4St Product <code>*</code></label>
                                        <select name="product_2_4" required id="product_2_4" class="form-control select2">
                                            <option value="">Select 4St Product</option>
                                            <?php
                                            if (!empty($products)) {
                                                foreach ($products as $product) {
                                                    $selected = null;
                                                    if ($banners_2->product_4 == $product->id) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->product_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mx-auto d-block" type="submit" id="submit_button">Add Banners</button>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </form>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->