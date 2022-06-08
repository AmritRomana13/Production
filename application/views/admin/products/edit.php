<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Edit Product</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form class="needs-validation" id="edit_product" name="edit_product" action="<?php echo base_url('cc_admin/products/update_product') ?>">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Data</h4>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_name">Product Name <code>*</code></label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required value="<?php echo $product_data->product_name ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="mrp">Product Mrp<code>*</code></label>
                                        <input type="text" class="form-control" id="mrp" name="mrp" placeholder="Product Mrp" required value="<?php echo $product_data->product_price ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="sale_price">Product Sale Price<code>*</code></label>
                                        <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Product Sale Price" required value="<?php echo $product_data->sale_price ?>">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="brand">Brand<code>*</code></label>
                                        <select name="brand" id="brand" class="form-control select2">
                                            <option value="">Select Brand</option>
                                            <?php
                                            $brands = get_brands();
                                            if (!empty($brands)) {
                                                foreach ($brands as $brand) {
                                                    $select = null;
                                                    if ($product_data->brand_id == $brand->id) {
                                                        $select = 'selected';
                                                    }
                                                    echo '<option value="' . $brand->id . '" ' . $select . '>' . $brand->brand_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="fetured">Premium Product</label>
                                        <select class="form-control select2" name="fetured" id="fetured">
                                            <option value="0" <?php echo ($product_data->fetured == 0) ? 'selected' : ' ' ?>>No</option>
                                            <option value="1" <?php echo ($product_data->fetured == 1) ? 'selected' : ' ' ?>>Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="product_images">Product Images <code>*</code></label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imagemediamodel">
                                            Select Image
                                        </button>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div id="image_preview"></div>
                                    <div class="additional-image-list" id="selected-images">
                                        <?php
                                        $product_images = json_decode($product_data->images);
                                        $count = 0;
                                        // print_r($product_images);
                                        foreach ($product_images as $product_image) {
                                        ?>
                                            <div class="additional-item">
                                                <input type="hidden" name="img_path[]" value="<?php echo $product_image; ?>">
                                                <img class="img-additional gimg" src="<?php echo base_url('uploads/') . 'products/' . $product_image; ?>" alt="">
                                                <a type="button" class="btn btn-sm btn-delete-additional-image pGalClose" aria-hidden="true">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>


                                        <?php
                                            $count = $count + 1;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="short_description">Short Description<code>*</code></label>
                                        <textarea required class="form-control" rows="5" id="short_description" name="short_description" placeholder="Please enter Short Description"><?php echo $product_data->short_description ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Description<code>*</code></label>
                                        <textarea required class="form-control" rows="5" id="description" name="description" placeholder="Please enter Description"><?php echo $product_data->description ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mx-auto  pt-3">
                                    <table width="100%" class="table table-bordered" id="tblData">
                                        <thead>
                                            <tr>
                                                <th>Sizes</th>
                                                <th><button type="button" class="btn btn-success" id="add_more_item"> <i class="uil uil-plus "></i> </button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="prodtable">


                                            <?php
                                            $size_array = explode(',', $product_data->sizes);
                                            if (!empty($size_array)) {
                                                foreach ($size_array as $sizes) {
                                            ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" id="size[]" name="size[]" value="<?php echo $sizes ?>" placeholder="Size"></td>
                                                        <td>
                                                            <button type="button" class="remove-item form-control btn btn-danger"><i class="uil uil-trash "></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td><input type="text" class="form-control" id="size[]" name="size[]" placeholder="Size"></td>
                                                    <td>
                                                        <button type="button" class="remove-item form-control btn btn-danger"><i class="uil uil-trash "></i></button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="<?php echo $product_data->id ?>">
                            <button class="btn btn-primary mx-auto d-block" type="submit" id="submit_button">Update Product</button>
                        </div>
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->

                <div class="col 4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Category</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="category_tree"></div>
                                    <input type="hidden" name="cat_id" id="cat_id">
                                    <input type="hidden" name="cat_id_temp" id="cat_id_temp" value="<?php echo $product_data->cat_id ?>">
                                    <input type="hidden" name="submit_type" id="submit_type">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </form>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<div class="modal fade" id="imagemediamodel" tabindex="-1" role="dialog" aria-labelledby="imagemediamodelLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagemediamodelLabel">Select Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-12 col-sm-offset-2">
                            <div class="img-zone text-center" id="img-zone">
                                <div class="img-drop">
                                    <h2><small>Drag &amp; Drop Photos Here</small></h2>
                                    Maximum upload file size: <?php echo ini_get("upload_max_filesize"); ?>.
                                    <p><em>- or -</em></p>
                                    <h2><i class="fa fa-cloud-upload" aria-hidden="true"></i></h2>

                                    <span class="btn btn-success btn-file">
                                        Click to Open File Browser<input type="file" multiple="" accept="image/*">
                                    </span>
                                </div>
                            </div>
                            <div class="progress hidden" id="progress">
                                <div style="width: 0%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar progress-bar-animated progress-bar-striped active">
                                    <span class="bold"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="file-manager-content pt-3">
                    <div class="col-sm-12">
                        <div class="row" id="media-files">
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="showImageGallery()"><i class="fa fa-check"></i>&nbsp;&nbsp;Select image</button>
            </div>
        </div>
    </div>
</div>