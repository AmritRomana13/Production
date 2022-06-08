<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">All Products</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                            <li class="breadcrumb-item active">All Products</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-md-4">
                <div>
                    <a type="button" href="<?php echo base_url('cc_admin/products/add') ?>" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Product</a>
                    <a type="button" href="<?php echo base_url('cc_admin/products/import') ?>" class="btn btn-dark waves-effect waves-light mb-3"><i class="mdi mdi-file-excel me-1"></i> Bulk Import</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" id="products_list" name="products_list" action="">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="top_category">Top Category <code>*</code></label>
                                        <select class="form-control select2" name="top_category" id="top_category">
                                            <option value="">Select Top Category</option>
                                            <option value="all">All</option>
                                            <?php
                                            $categorys = getallparentcats();
                                            if (!empty($categorys)) {
                                                foreach ($categorys as $key => $category) {
                                                    echo '<option value="' . $category->id . '">' . $category->category_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="sub_category">Sub Category</label>
                                        <select class="form-control select2" name="sub_category" id="sub_category">
                                            <option value="">Select Top Category First</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mx-auto d-block" type="submit" id="submit_button"> <i class="uil-search-alt"></i> Get Products</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;" id="products_table_filter">
                                <thead>
                                    <tr class="bg-transparent">

                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th style="width: 120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->