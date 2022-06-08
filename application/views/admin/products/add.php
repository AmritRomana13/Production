<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Add Product</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <form class="needs-validation" id="add_product" name="add_product" action="<?php echo base_url('cc_admin/products/add_newproduct') ?>">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Data</h4>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="product_name">Product Name <code>*</code></label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="mrp">Product Mrp<code>*</code></label>
                                        <input type="text" class="form-control" id="mrp" name="mrp" placeholder="Product Mrp" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="sale_price">Product Sale Price<code>*</code></label>
                                        <input type="text" class="form-control" id="sale_price" name="sale_price" placeholder="Product Sale Price" required>
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
                                                    echo '<option value="' . $brand->id . '">' . $brand->brand_name . '</option>';
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
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
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

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="short_description">Short Description<code>*</code></label>
                                        <textarea required class="form-control" rows="5" id="short_description" name="short_description" placeholder="Please enter Short Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Description<code>*</code></label>
                                        <textarea required class="form-control" rows="5" id="description" name="description" placeholder="Please enter Description"></textarea>
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
                                            <tr>
                                                <td><input type="text" class="form-control" id="size[]" name="size[]" placeholder="Size"></td>
                                                <td>
                                                    <button type="button" class="remove-item form-control btn btn-danger"><i class="uil uil-trash "></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button class="btn btn-primary mx-auto d-block" type="submit" id="submit_button">Add Product</button>
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
                                    <input type="hidden" name="cat_id_temp" id="cat_id_temp" value="">
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